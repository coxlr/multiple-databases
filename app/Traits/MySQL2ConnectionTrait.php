<?php

namespace App\Traits;

trait MySQL2ConnectionTrait
{
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->connection = app()->environment(['testing']) ? 'mysql' : 'mysql2';

        $this->table = 'testing_b.'.$this->getTable();
    }
}