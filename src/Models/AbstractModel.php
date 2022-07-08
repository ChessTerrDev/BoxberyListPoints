<?php

namespace BoxberryListPoints\Models;

use function PHPUnit\Framework\returnArgument;

abstract class AbstractModel
{
    protected DataBase $dataBase;


    /**
     * @param int|null $id
     * @throws \Exception
     */
    public function __construct(?int $id = null)
    {
        if ($id) {
            $arrayModel = $this->initDataBase()->getEntryById($this->baseName(), $id);
            if (empty($arrayModel))
                throw new \Exception('Нет записи с таким идентификатором');
            $this->setFields($arrayModel);
        }
    }

    /**
     * Add entry in database
     * @param array|null $notFields fields to exclude from processing
     * @param string|null $PrimaryKey if the primary key field is specified, the ID is returned after insertion
     * @return bool|$this
     * @throws \Exception
     */
    public function addEntry(?array $notFields = null, ?string $PrimaryKey = 'id'): bool|static
    {
        $param = $this->getFields();

        $param = $this->removeUnnecessaryFields($param, $notFields);
        $result = $this
            ->initDataBase()
            ->addEntry($this->baseName(), $param, $PrimaryKey);
        if (is_int($result)) $this->id = $result;
        if (is_bool($result)) return $result;

        return $this;
    }


    /**
     * Searches by the parameters available to the entity
     * @param array|null $notFields
     * @return bool|array
     * @throws \Exception
     */
    public function find(?array $notFields = null): bool|array
    {
        $param = $this->getFields();

        $this->removeUnnecessaryFields($param, $notFields);
        $results = $this
            ->initDataBase()
            ->findByParams($this->baseName(), $param);

        foreach ($results as $key => $result ) {
            $results[$key] = clone $this->setFields($result);
        }

        return $results;
    }

    public function findAll(?array $Fields = null): bool|array
    {
        return $this
            ->initDataBase()
            ->fundAll($this->baseName(), $Fields);
    }


    /**
     * saving the current state of the entity
     * @param array|null $notFields
     * @return bool
     * @throws \Exception
     */
    public function save(?array $notFields = null): bool
    {
        $param = $this->getFieldsForSave();

        $param = $this->removeUnnecessaryFields($param, $notFields);

        return $this
            ->initDataBase()
            ->updateEntryById($this->baseName(), $this->getId(), $param);
    }

    /**
     * @return string Returns a clean class name
     */
    protected function baseName(): string
    {
        return basename(str_replace('\\', '/', $this::class));
    }


    /**
     * excludes fields from processing
     * @param array $param
     * @param array|null $notFields
     * @return array
     */
    private function removeUnnecessaryFields(array $param, ?array $notFields): array
    {
        if (!empty($notFields))
            foreach ($notFields as $keyField => $valField)
                unset($param[$keyField]);
        return $param;
    }

    /**
     * Returns non-empty object fields
     * @return array
     */
    public function getFields(): array
    {
        $vars = array_filter(get_object_vars($this), function ($f)
        {
            return ($f !== null);
        });
        unset($vars['dataBase']);

        return $this->parseFields($vars);
    }

    /**
     * Returns all fields of the object
     * @return array
     */
    public function getAllFields(): array
    {
        $vars = get_object_vars($this);
        unset($vars['dataBase']);

        return $this->parseFields($vars);
    }

    /**
     * Gets the value of fields via getters
     * @param $fields
     * @return array
     */
    public function parseFields($fields): array
    {
        $retFieldsArr = [];
        foreach ($fields as $key => $val) {
            if (is_object($val) && method_exists($val, 'getId')) {
                $retFieldsArr[$key] = $val->getId();
                continue;
            }
            $name = explode('_', $key);
            $name = implode(array_map('ucfirst', $name));
            $getMethod = 'get' . $name;
            $isMethod = 'is' . $name;
            if (method_exists($this, $getMethod)) {
                $retFieldsArr[$key] = $this->parseField($this->$getMethod());
            } elseif (method_exists($this, $isMethod)) {
                $retFieldsArr[$key] = $this->parseField($this->$isMethod());
            } else {
                $retFieldsArr[$key] = $this->parseField($val);
            }
        }
        return $retFieldsArr;
    }

    /**
     * Gets the value
     * @param $val
     * @return mixed
     */
    protected function parseField($val): mixed
    {
        if (is_array($val)) {
            return $this->parseFields($val);
        } elseif (is_object($val) && method_exists($val, 'getFields')) {
            return $val->getFields();
        } else {
            return $val;
        }
    }

    /**
     * Puts values in parameters from the array
     * @param array $fields
     * @return $this
     */
    public function setFields(array $fields): AbstractModel
    {
        if (empty($fields)) return $this;

        foreach ($fields as $field => $value) {
            $name = explode('_', $field);
            $name = implode(array_map('ucfirst', $name));
            $method = 'set' . ucfirst($name);

            if (method_exists($this, $method))
                $this->$method($this->getValueField($value, $field));
        }

        return $this;
    }

    /**
     * DataBase set or DataBase init. return DataBase
     * @param \BoxberryListPoints\Models\DataBase|null $dataBase
     * @return \BoxberryListPoints\Models\DataBase|null
     */
    public function initDataBase(?DataBase $dataBase = null): ?DataBase
    {
        if ($dataBase) $this->dataBase = $dataBase;
        if (empty($this->dataBase)) $this->dataBase = new DataBase();

        return $this->dataBase;
    }

    /**
     * a method for the possibility of polymorphism
     * @param $value
     * @param null $field
     * @return mixed
     */
    public function getValueField($value, $field = null): mixed
    {
        return $value;
    }

    /**
     * a method for the possibility of polymorphism
     * @return array
     */
    protected function getFieldsForSave(): array
    {
        return $this->getFields();
    }

}