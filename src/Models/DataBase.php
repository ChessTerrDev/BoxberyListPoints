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
     * INSERT INTO
     * @param string $table
     * @param array $fields
     * @param string|null $PrimaryKey
     * @return bool|int
     * @throws \Exception
     */
    public function addEntry(string $table, array $fields, ?string $PrimaryKey): bool|int
    {
        if (empty($table) || empty($fields))
            throw new \Exception('Не указанна таблица или пустые поля!');

        $query = 'INSERT INTO';
        $query .= '"' . $table . '"';
        $query .= '(';

        $tableFields = '';
        $valueFields = '';
        $executeArray = [];
        foreach ($fields as $nameField => $field) {
            $tableFields .= '"' . $nameField . '"';
            $valueFields .= ':' . $nameField;
            $executeArray[':' . $nameField] = $this->valueToSQL($field);
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
            return (int)$this->dataBaseHost->lastInsertId('"' . $table . '_' . $PrimaryKey . '_seq"');

        return true;
    }

    /**
     * Formats values for SQL
     * @param $value
     * @return mixed
     */
    private function valueToSQL($value): mixed
    {
        if (is_bool($value)) return $value ? 1 : 0;

        return $value;
    }

    /**
     * SELECT table fields by primary key
     * @param string $table table name
     * @param int $id primary key
     * @param array|null $fields names of fields that are included in the selection
     * @return mixed
     * @throws \Exception
     */
    public function getEntryById(string $table, int $id, ?array $fields = null): mixed
    {
        if (empty($table) || empty($id))
            throw new \Exception('Не указанна таблица или идентификатор записи!');

        list($query, $tableFields) = $this->extracted($fields, $table);

        $query .= ' "id" = ?';

        $statement = $this->dataBaseHost->prepare($query);
        $statement->execute([$id]);

        return $statement->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * SELECT of table fields according to the set parameters (WHERE ... AND ... AND ... AND ... )
     * @param string $table
     * @param array $params selection parameters: field name => value
     * @param array|null $fields names of fields that are included in the selection
     * @return bool|array
     * @throws \Exception
     */
    public function findByParams(string $table, array $params, ?array $fields = null): bool|array
    {
        if (empty($table) || empty($params))
            throw new \Exception('Не указанна таблица или параметры поиска!');

        list($query, $tableFields) = $this->extracted($fields, $table);

        $bindValues = [];
        foreach ($params as $paramName => $param) {
            $query .= ' "' . $paramName . '" = :' . $paramName;

            $bindValues[$paramName] = $this->valueToSQL($param);
            if ($paramName !== array_key_last($params))
                $query .= ' AND ';
        }

        $statement = $this->dataBaseHost->prepare($query);
        $statement->execute($bindValues);

        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public function fundAll(string $table, ?array $fields = null): bool|array
    {
        if (empty($table))
            throw new \Exception('Не указанна таблица!');

        list($query, $tableFields) = $this->extracted($fields ? array_flip($fields) : null, $table);

        $statement = $this->dataBaseHost->prepare(str_replace(' WHERE ', '', $query));
        $statement->execute();

        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * UPDATE BY ID
     * @param string $table
     * @param int $id
     * @param array $fields
     * @return mixed
     * @throws \Exception
     */
    public function updateEntryById(string $table, int $id, array $fields): mixed
    {
        if (empty($table) || empty($id))
            throw new \Exception('Не указанна таблица или идентификатор записи!');

        $query = 'UPDATE "' . $table . '" SET';
        $tableFields = '(';
        $bindValues = ['id' => $id];
        $tableValue = '';
        foreach ($fields as $nameField => $field) {
            if ($nameField == 'id') continue;
            $tableFields .= '"' . $nameField . '"';
            $tableValue .= ':' . $nameField;
            if ($nameField !== array_key_last($fields)) {
                $tableFields .= ', ';
                $tableValue .= ', ';
            }
            $bindValues[$nameField] = $this->valueToSQL($field);;
        }
        $query .= $tableFields . ') = (';
        $query .= $tableValue;
        $query .= ') WHERE id = :id';

        $statement = $this->dataBaseHost->prepare($query);
        //echo $query;
        //var_dump($bindValues);
        return $statement->execute($bindValues);
    }


    /**
     * @return void
     */
    public function beginTransaction(): void
    {
        $this->dataBaseHost->beginTransaction();
    }

    /**
     * @return void
     */
    public function commit(): void
    {
        $this->dataBaseHost->commit();
    }

    /**
     * @return void
     */
    public function rollback(): void
    {
        $this->dataBaseHost->rollBack();
    }

    /**
     * @param array|null $fields
     * @param string $table
     * @return string[]
     */
    private function extracted(?array $fields, string $table): array
    {
        $query = 'SELECT ';
        $tableFields = '';
        if (!empty($fields))
            foreach ($fields as $nameField => $field) {
                $tableFields .= '"' . $nameField . '"';
                if ($nameField !== array_key_last($fields))
                    $tableFields .= ', ';
            };

        $query .= empty($tableFields) ? ' * ' : $tableFields;
        $query .= ' FROM ';
        $query .= ' "' . $table . '" ';
        $query .= ' WHERE ';
        return array($query, $tableFields);
    }

}