<?php

class Camels extends Packs
{
    public int $kind;

    public function __construct($name, $date_of_birth)
    {
        parent::__construct($name, $date_of_birth);
        $this->kind = 1;
    }

    public function getInfo()
    {
        echo "\nИмя: ".$this->name." Дата рождения: ".$this->date_of_birth." Возраст: ".$this->age.
            " Тип: ".$this->type." Вид: ".$this->kind;
    }
}