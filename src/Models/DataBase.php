<?php

namespace BoxberryListPoints\Models;

use BoxberryListPoints\Configuration\Constants;
use PDO;
use PDOException;

class DataBase
{
    private PDO $dataBaseHost;

    public function __construct()
    {
        try {
            $this->dataBaseHost = new PDO(
                Constants::DATA_BASE_CONNECTION['driver'] . ':' .
                'host=' . Constants::DATA_BASE_CONNECTION['host'] . ';' .
                'dbname=' . Constants::DATA_BASE_CONNECTION['database'],
                Constants::DATA_BASE_CONNECTION['username'],
                Constants::DATA_BASE_CONNECTION['password']
            );
        } catch (PDOException $e) {
            print "Error connection with Data Base!: " . $e->getMessage();
            die();
        }
    }

    /**
     * @return \PDO
     */
    public function getDataBaseHost(): PDO
    {
        return $this->dataBaseHost;
    }

    public function addEntry(string $table, array $fields, ?string $PrimaryKey)
    {
        if (empty($table) || empty($fields))
            throw new \Exception('Не указанна таблица или пустые поля!');

        $query = 'INSERT INTO';
        $query .= '"'.$table.'"';
        $query .= '(';

        $tableFields = '';
        $valueFields = '';
        $executeArray = [];
        foreach ($fields as $nameField => $field) {
            $tableFields .= '"'.$nameField.'"';
            $valueFields .= ':'.$nameField;
            $executeArray[':'.$nameField] = $this->valueToSQL($field);
            if ($nameField !== array_key_last($fields)) {
                $tableFields .= ', ';
                $valueFields .= ', ';
            }
        }
        $query .= $tableFields;
        $query .= ') VALUES (';
        $query .= $valueFields;
        $query .= ')';

        $statement = $this->dataBaseHost->prepare($query);
        $statement->execute($executeArray);

        if ($PrimaryKey)
            return (int)$this->dataBaseHost->lastInsertId('"'.$table.'_'.$PrimaryKey.'_seq"');

        return true;
    }

    private function valueToSQL($value)
    {
        if (is_bool($value)) $value = $value ? 1 : 0;

        return $value;
    }

    public function getEntryById(string $table, int $id, ?array $fields = null)
    {
        if (empty($table) || empty($id))
            throw new \Exception('Не указанна таблица или идентификатор записи!');

        $query = 'SELECT';
        $tableFields = '';
        if (!empty($fields))
            foreach ($fields as $nameField => $field) {
                $tableFields .= '"'.$nameField.'"';
                if ($nameField !== array_key_last($fields))
                    $tableFields .= ', ';
            };

        $query .= empty($tableFields) ? ' * ' : $tableFields;
        $query .= ' FROM ';
        $query .= ' "'.$table.'" ';
        $query .= ' WHERE ';
        $query .= ' "id" = ?';

        $statement = $this->dataBaseHost->prepare($query);
        $statement->execute([$id]);

        return $statement->fetch(PDO::FETCH_ASSOC);
    }
}