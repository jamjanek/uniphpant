<?php

namespace App\Shrt\Domain;

class Uuid
{
    protected $uuidGenerator;

    public function __construct()
    {
        $this->setUuidGenerator();
    }

    public function setUuidGenerator($uuidGenerator=null)
    {
        if(is_null($uuidGenerator)) {
            $this->uuidGenerator = \Ramsey\Uuid\Uuid::uuid4();
        } elseif(null!==$uuidGenerator) {
            $this->uuidGenerator = $uuidGenerator;
        }

        return $this;
    }

    public function generateUuid()
    {
        try {
            $newUuid = $this->uuidGenerator->toString();
        } catch (\Ramsey\Uuid\Exception\UnsatisfiedDependencyException $e) {
            echo 'Caught exception: ' . $e->getMessage() . "\n";
        }

        return $newUuid;
    }

}
