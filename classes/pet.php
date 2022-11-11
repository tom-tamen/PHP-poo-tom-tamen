<?php

class Pet
{
    public function __construct(
        public string $name,
        public string $type,
        public int $owner
    ){
    }

    public function verify():bool
    {
        return $this->type ==='' || $this->name ==='';
    }
}