<?php

class Pet
{
    public function __construct(//pet object that has a name, a type and an owner(id from user)
        public string $name,
        public string $type,
        public int $owner
    ){
    }

    public function verify():bool
    {
        return $this->type ==='' || $this->name ==='';//check if the fields are not empty
    }
}