<?php

class AnimalRegistry
{
    // создать животное
    public function newAnimal(): ?Animals
    {
        echo "\nВведите имя: ";
        $name = readline();
        echo "\nВведите дату рождения (YYYY-MM-DD): ";
        $date_of_birth = readline();
        if (empty($name) || empty($date_of_birth)) {
            echo "\nВы не ввели имя и (или) дату рождения";
            return null;
        }
        echo "\nВведите тип (dog, cat, hamster, camel, horse, donkey): ";
        $kind = readline();
        switch ($kind) {
            case "dog":
                return new Dogs ($name, $date_of_birth);
            case "cat":
                return new Cats($name, $date_of_birth);
            case "hamster":
                return new Hamsters($name, $date_of_birth);
            case "camel":
                return new Camels($name, $date_of_birth);
            case "horse":
                return new Horses($name, $date_of_birth);
            case "donkey":
                return new Donkeys($name, $date_of_birth);
            default:
                echo "Таких животных нет.";
                return null;
        }
    }

    //1 - добавить животное в реестр
    public function addAnimal(Animals $animal)
    {
        $result = q('INSERT INTO animals.animals (name, date_of_birth, kinds_id) VALUES ("' . $animal->name . '", "' . $animal->date_of_birth . '", ' . $animal->kind . ');');
        if ($result) {
            echo $animal->name . " - животное добавлено в регистр\n";
        }
    }

    //2 - показать команды, которые знает животные
    public function showCommands($idAnimal)
    {
        $result = q('SELECT animal_name, animal_commands FROM itogo WHERE animal_id = "' .$idAnimal. '";');
        while ($row = $result->fetch_assoc()) {
            if (empty($row['animal_commands'])) {
                echo "\nЖивотное " . $row['animal_name'] . " не знает комманд \n";
            }
            else {
                echo "\nЖивотное " . $row['animal_name'] . " знает команды " . $row['animal_commands'] . "\n";
            }
        }
    }

    //3 - обучить новым коммандам
    public function addCommand(int $idAnimal, string $command)
    {
        $result = q('SELECT id FROM animals.commands WHERE command = "' . $command . '";');
        while ($row = $result->fetch_assoc()) {
            $idCommand = intval($row['id']);
        }
        if (empty($idCommand)) {
            echo "\nДанной комманды не существует";
        }
        else {
            $checkCom = q('SELECT * FROM animals.animal_command WHERE animals_id = "' .$idAnimal. '" AND commands_id = "' .$idCommand. '";');
            while ($row = $checkCom->fetch_assoc()) {
                $checkId = intval($row['id']);
            }
            if (empty($checkId)) {
                $addCom = q('INSERT INTO animals.animal_command (animals_id, commands_id) VALUES ("' .$idAnimal. '", "' .$idCommand. '");');
                if ($addCom) {
                    echo "\nЖивотное изучило новую комманду ".$command;
                }
            }
            else echo "\nЖивотное уже знает такую команду";
        }
    }

    //4 - вывести список животных по дате рождения
    public function listAnimalsByDob()
    {
        $result = q('SELECT animals.name, kinds.kind, animals.date_of_birth FROM animals LEFT JOIN kinds ON animals.kinds_id = kinds.id ORDER BY animals.date_of_birth;');
        if ($result) {
            echo "\nСписок животных, отсортированный по дате рождения: \n";
        }
        while ($row = $result->fetch_assoc()) {
            echo "Имя: " . $row['name'] . ", Дата рождения: " . $row['date_of_birth'] . ", Вид: "
                . $row['kind'] . "\n";
        }
    }

    //5 - вывести количество животных
    public function countAnimals()
    {
        $result = q('SELECT COUNT(*) FROM animals.animals;');
        while ($row = $result->fetch_assoc()) {
            echo "Количесто животных в питомнике: " . $row['COUNT(*)'] . "\n";
        }
    }

    //6 - вывести список животных
    public function printAnimals()
    {
        $result = q('SELECT animals.name, kinds.kind, animals.date_of_birth FROM animals LEFT JOIN kinds ON animals.kinds_id = kinds.id;');
        if ($result) {
            echo "\nСписок животных в питомнике: \n";
        }
        while ($row = $result->fetch_assoc()) {
            echo "Имя: " . $row['name'] . ", Дата рождения: " . $row['date_of_birth'] . ", Вид: "
                . $row['kind'] . "\n";
        }
    }

    // поиск животного в массиве по имени
    public function findAnimals(string $name): ?int
    {
        $result = q('SELECT id FROM animals.animals WHERE name = "' . $name . '";');
        if (empty($result)) {
            return null;
        }
        else {
            while ($row = $result->fetch_assoc()) {
                $id = intval($row['id']);
                echo $id;
                return $id;
            }
        }
        echo "\nЖивотное ".$name." не найдено.";
        return null;
    }
}

