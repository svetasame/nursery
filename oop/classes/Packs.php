<?php

abstract class Packs extends Animals
{
    public int $type;
    public function __construct($name, $date_of_birth) {
        parent::__construct($name, $date_of_birth);
        $this->type = 2;
    }
}