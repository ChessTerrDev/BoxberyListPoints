<?php

namespace BoxberryListPoints\Models;

abstract class AbstractModel
{
    protected DataBase $dataBase;
    public function __construct(?int $id = null)
    {
        if ($id)
            $this->setFields(
                $this->initDataBase()->getEntryById($this->baseName(), $id)
            );
    }

    public function addEntryInDataBase(?array $notFields = null, ?string $PrimaryKey = 'id')
    {
        $param = $this->getFields();

        $this->removeUnnecessaryFields($param, $notFields);

        $result = $this
            ->initDataBase()
            ->addEntry($this->baseName(), $param, $PrimaryKey);

        if (is_int($result)) $this->id = $result;
        if (is_bool($result)) return $result;

        return $this;
    }

    /**
     * @throws \Exception
     */
    public function find(?array $notFields = null)
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

    private function removeUnnecessaryFields(array $param, ?array $notFields)
    {
        if (!empty($notFields))
            foreach ($notFields as $keyField => $valField)
                unset($param[$keyField]);
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
                    $name = explode('_', $field);
                    $name = implode(array_map('ucfirst', $name));
                    $method = 'set' . ucfirst($name);

                    if (method_exists($this, $method))
                        $this->$method($this->getValueField($value));
                }
            }
        }
        return $this;
    }

    private function initDataBase(): ?DataBase
    {
        if (empty($this->dataBase)) $this->dataBase = new DataBase();

        return $this->dataBase;
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