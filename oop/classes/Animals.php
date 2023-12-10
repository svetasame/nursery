<?php

abstract class Animals
{
    public string $name;
    public string $date_of_birth;
    public int $age;
    public array $learnedCommands=[];

    /**
     * @throws Exception
     */
    public function __construct($name, $date_of_birth) {
        $this->name = $name;
        $this->date_of_birth = $date_of_birth;
        $this->age = $this->getAge($date_of_birth);
    }

    abstract public function getInfo();

    /**
     * @throws Exception
     */
    public function getAge($date_of_birth): int
    {
        $dob = new DateTime ($date_of_birth);
        $now = new DateTime();
        $diff = $now->diff($dob);
        $ageMonth = $diff->y * 12 + $diff->m;
        return $this->age=$ageMonth;
    }

}

