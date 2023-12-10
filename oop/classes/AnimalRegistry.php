<?php

class AnimalRegistry
{
    public array $animals = [];

    //0 - создать животное
    public function newAnimal(): ?Animals
    {
        echo "\nВведите имя: ";
        $name = readline();
        echo "\nВведите дату рождения (YYYY-MM-DD): ";
        $date_of_birth = readline();
        echo "\nВведите тип (dog, cat, hamster, camel, horse, donkey): ";
        $kind = readline();
        switch ($kind) {
            case "dog":
                return $animal = new Dogs ($name, $date_of_birth);
            case "cat":
                return $animal = new Cats($name, $date_of_birth);
                break;
            case "hamster":
                return $animal = new Hamsters($name, $date_of_birth);
                break;
            case "camel":
                return $animal = new Camels($name, $date_of_birth);
                break;
            case "horse":
                return $animal = new Horses($name, $date_of_birth);
                break;
            case "donkey":
                return $animal = new Donkeys($name, $date_of_birth);

            default:
               echo "Таких животных нет.";
               return null;
        }
    }

    //1 - добавить животное в реестр
    public function addAnimal(Animals $animal)
    {
        $result = q('INSERT INTO animals.animals (name, date_of_birth, kinds_id) VALUES ("'.$animal->name.'", "'.$animal->date_of_birth.'", '.$animal->kind.');');
        if ($result) {
            echo $animal->name. " Добавлено в регистр\n";
        }
    }

    //2 - показать команды, которые знает животные
    public function showCommands(Animals $animal)
    {
        echo "\n" . $animal->name . " знает команды: " . implode(", ", $animal->learnedCommands);
    }

    //3 - обучить новым коммандам
    public function addCommand(Commands $commands, Animals $animal, string $command): array
    {
        if (in_array($command, $commands->getCommands())) {
            if (in_array($command, $animal->learnedCommands)) {
                echo "\n" . $animal->name . ' уже знает такую команду';
            } else {
                $animal->learnedCommands[] = $command;
                echo "\n" . $animal->name . " изучил новую комманду " . $command;
            }
            return $animal->learnedCommands;
        } else echo "\nДанной комманды не существует";
        return $animal->learnedCommands;
    }

    //4 - вывести список животных по дате рождения
    public function listAnimalsByDob(): array
    {
        usort($this->animals, function ($a, $b) {
            return strtotime($a->date_of_birth) - strtotime($b->date_of_birth);
        });
        return $this->animals;
    }


    //5 - вывести количество животных
    public function countAnimals()
    {
        echo "\nКоличество животных в питомнике: " . count($this->animals);
    }

    //6 - вывести список животных
    public function printAnimals()
    {
//        echo "\nСписок животных в питомнике: ";
//        foreach ($this->animals as $animal) {
//            print_r($animal->getInfo());
//        }

         $result = q('SELECT animals.name, kinds.kind, animals.date_of_birth 
FROM animals LEFT JOIN kinds ON animals.kinds_id = kinds.id;');
         if ($result) {
             echo "\nСписок животных в питомнике: ";
         }
         $row = mysqli_fetch_assoc($result);
         echo "my result <a href='data/" . htmlentities($row['classtype'], ENT_QUOTES, 'UTF-8') . ".php'>My account</a>";

    }

    //7 - поиск животного в массиве по имени
    public function findAnimals(string $name): ?Animals
    {
        foreach ($this->animals as $animal) {
            if (strstr($animal->name, $name)) {
                echo "\nЖивотное " . $name . " найдено.";
                return $animal;
            }
        }
        echo "\nЖивотное " . $name . " не найдено.";
        return null;
    }
}

