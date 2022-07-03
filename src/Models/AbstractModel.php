<?php

namespace BoxberryListPoints\Models;

abstract class AbstractModel
{
    protected DataBase $dataBase;
    public function __construct(?int $id = null)
    {
        if ($id) {
            $this->dataBase = new DataBase();

            $this->setFields(
                $this->dataBase->getEntryById($this->baseName(), $id)
            );
        }
    }

    public function addEntryInDataBase(?array $notFields = null, ?string $PrimaryKey = 'id')
    {
        $param = $this->getFields();

        if ($notFields) foreach ($notFields as $keyField => $valField)
            unset($param[$keyField]);

        $result = $this->dataBase->addEntry($this->baseName(), $param, $PrimaryKey);

        if (is_int($result)) $this->id = $result;
        if (is_bool($result)) return $result;

        return $this;
    }

    public function deleted()
    {

    }

    public function save()
    {

    }

    protected function baseName()
    {
        return basename(str_replace('\\', '/', $this::class));
    }

    public function setDataBase(DataBase $dataBase): AbstractModel
    {
        $this->dataBase = $dataBase;
        return $this;
    }

    public function getFields(): array
    {
        $vars = array_filter(get_object_vars($this), function ($a) {
            return ($a !== null);
        });
        unset($vars['dataBase']);
        unset($vars['id']);

        return $this->parseFields($vars);
    }

    public function getAllFields(): array
    {
        $vars = get_object_vars($this);
        unset($vars['dataBase']);
        unset($vars['id']);

        return $this->parseFields($vars);
    }

    public function parseFields($fields): array
    {
        $retFieldsArr = [];
        foreach ($fields as $key => $val) {
            $name = ucfirst($key);
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

    protected function parseField($val)
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
     * Ставит значения в параметры из массива
     * @param array $fields
     * @return $this
     */
    public function setFields(array $fields): AbstractModel
    {
        if (!empty($fields)) {
            foreach ($fields as $field => $value) {
                if (is_object($value))
                    $value = (array)$value;

                if (!is_object($value)) {
                    $method = 'set' . ucfirst($field);

                    if (method_exists($this, $method))
                        $this->$method($this->getValueField($value));
                }
            }
        }
        return $this;
    }

    /**
     * @param $value
     * @return mixed
     */
    public function getValueField($value): mixed
    {
        return $value;
    }

}