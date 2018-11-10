<?php

namespace App\Chain\Model\Concerns;

use Chain\Model\Relations\Chain as ChainRelation;
use Chain\Entity;
use Illuminate\Support\Arr;

/**
 * Chain Trait
 * This trait makes Model possible to connect to Chain API.
 */
trait Chain
{
    /**
     * @var array where
     */
    protected $whereArray = [];

    /**
     * Add to where array
     *
     * @param array $where
     */
    public function where($where)
    {
        if (empty($this->whereArray)) {
            $this->whereArray = $where;
        } else {
            $this->whereArray = ['and' => [$this->whereArray, $where]];
        }
    }

    /**
     * Get id for private information
     * This id can be available after record is published.
     *
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }


    /**
     * Call GET API
     *
     * @param string $id
     * @param string $who who paramater
     * @return array
     */
    public function callGetApi($id = null, $who = null)
    {
        return \Chain::get($id, compact('who'));
    }

    /**
     * Set path
     */
    public static function setPath($path)
    {
        \Chain::setPath($path);
    }

    /**
     * Call POST API
     *
     * @param array $data
     * @param string|null $id
     * @return boolean
     */
    public function callPostApi($data, $id = null)
    {
        return \Chain::post($data, $id);
    }

    /**
     * Save information to Chain API
     *
     * @throws Exception if saving data to API fails, exeption will be thrown
     * @return boolean true
     */
    public function save($options = [])
    {
        if ($this->fireModelEvent('saving') === false) {
            return false;
        }

        $this->assignDate();

        $isCreate = false;
        if (!$this->id) {
            $id = $this->publishId();
            $isCreate = true;
        }

        self::setPath(self::getPath());

        $data = $this->toArray();
        $data['id'] = $id ?? $this->id;
        $data['$class'] = $this->getChainClass();

        $success = $isCreate ? $this->callPostApi($data)
            : $this->callPostApi($data, $this->id);


        if (!$success) {
            throw new \Exception('Could not save data.');
        }

        $this->finishSave($options);

        return true;
    }

    /**
     * Get all of the models from the database.
     *
     * @param  array|mixed  $columns
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function get($columns = ['*'])
    {
        self::setPath(self::getPath());
        $res = \Chain::get(null, $this->whereArray);
        $list = [];
        if ($res) {
            foreach ($res as $item) {
                $item['created_at'] = isset($item['created_at'])
                    ? $this->transDate($item['created_at'])
                    : '1970-01-01 00:00:00';
                $item['updated_at'] = isset($item['updated_at'])
                    ? $this->transDate($item['updated_at'])
                    : '1970-01-01 00:00:00';

                $object = clone $this;
                $object->fill($item);
                $list[] = $object;
            }
        }
        return $this->newCollection($list);
    }

    /**
     * Trans chain date
     *
     * @param string $string chain date
     * @return string
     */
    protected function transDate($string)
    {
        return date('Y-m-d H:i:s', strtotime($string));
    }

    /**
     * Publish id
     *
     * @return string $id
     */
    protected function publishId()
    {
        if (!$id = $this->getId()) {
            $id = $this->createId();
        }
        return $id;
    }

    /**
     * Create id for associating database and API
     *
     * @return string
     */
    protected function createId()
    {
        if (!$this->issuer_id) {
            throw new \Exception('Id could not created.');
        }

        $class = strtolower(Arr::last(explode('\\', static::class)));

        return sprintf('%s-%s-%s', $class, $this->issuer_id, time());
    }

    /**
     * Assign date
     */
    protected function assignDate()
    {
        $this->updated_at = date('Y-m-d H:i:s');
        if (!$this->created_at) {
            $this->created_at = $this->updated_at;
        }
    }

    /**
     * Find a model by its primary key or throw an exception.
     *
     * @param  mixed  $id
     * @param  array  $columns
     * @return \Illuminate\Database\Eloquent\Model|\Illuminate\Database\Eloquent\Collection|static|static[]
     *
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException
     */
    public function findOrFail($id, $columns = ['*'])
    {
        $result = $this->find($id, $columns);

        if (! is_null($result)) {
            return $result;
        }

        throw (new \Illuminate\Database\Eloquent\ModelNotFoundException)
            ->setModel(get_class($this), $id);
    }

    /**
     * Find a model by its primary key.
     *
     * @param  mixed  $id
     * @param  array  $columns
     * @return \Illuminate\Database\Eloquent\Model|\Illuminate\Database\Eloquent\Collection|static[]|static|null
     */
    public function find($id, $columns = ['*'])
    {
        self::setPath(self::getPath());
        $item = \Chain::get($id, $this->whereArray);
        if ($item) {
            $item['created_at'] = isset($item['created_at'])
                ? $this->transDate($item['created_at'])
                : '1970-01-01 00:00:00';
            $item['updated_at'] = isset($item['updated_at'])
                ? $this->transDate($item['updated_at'])
                : '1970-01-01 00:00:00';

            $object = clone $this;
            $object->fill($item);
            return $object;
        }
        return null;
    }
}
