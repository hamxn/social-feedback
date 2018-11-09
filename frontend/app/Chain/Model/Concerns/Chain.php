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
    protected $resolved = false;

    protected $whereArray = [];

    public function where($where)
    {
        $this->whereArray = array_merge($where, $this->whereArray);
    }

    /**
     * Get id for private information
     * This id can be available after record is published.
     *
     * @return Chain\Entity
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set id for private information
     *
     * @return Chain\Entity
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * Obtain private information from API
     *
     * @return Chain\Entity
     */
    public function getPrivateInfo()
    {
        if (!$this->resolved) {
            $data = $this->callGetApi($this->getId());
            $this->resolve($data);
        }

        return $this->entity;
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

    public static function setPath($path)
    {
        return \Chain::setPath($path);
    }

    /**
     * Call POST API
     *
     * @param string $id
     * @param array $data
     * @param string $who who paramater
     * @return boolean
     */
    public function callPostApi($id, $data)
    {
        return \Chain::post($id, $data);
    }

    /**
     * Save pvrivate information to Chain API with trigger for saved event
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

        if (!$this->id) {
            $this->publishId();
            $success = $this->callPostApi($this->toArray());
        } else {
            $success = $this->callPostApi($this->toArray(), $this->id);
        }

        
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
    public static function all($columns = ['*'])
    {
        self::setPath(self::getPath());
        return \Chain::get();
    }

    protected function publishPid()
    {
        if (!$id = $this->getId()) {
            $id = $this->createId();
            $this->setId($id);
        }
    }

    /**
     * Create id for associating database and API
     *
     * @return Fsboss\Entity
     */
    protected function createId()
    {
        if (!$this->issuer_id) {
            throw new \Exception('Id could not created.');
        }

        $class = strtolower(Arr::last(explode('\\', static::class)));

        return sprintf('%s-%s-%s', $class, $this->issuer_id, time());
    }

    protected function assignDate()
    {
        $this->updated_at = date('Y-m-d H:i:s');
        if (!$this->created_at) {
            $this->created_at = $this->updated_at;
        }
    }
}
