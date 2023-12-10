<?php

//namespace oop\classes;
abstract class Pets extends Animals
{
    public int $type;
    public function __construct($name, $date_of_birth) {
        parent::__construct($name, $date_of_birth);
        $this->type = 2;
    }
}