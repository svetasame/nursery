<?php require_once 'function.php';


$commands = new Commands();
$registry = new AnimalRegistry();
$view = new View();

$registry->addAnimal($dog = new Dogs('Funny', "2013-01-01"));
$registry->addAnimal($dog2 = new Dogs('Tiffy', "2007-11-01"));
$registry->addAnimal($cat = new Cats('Dana', "2020-04-11"));
$registry->addAnimal($cat1 = new Cats('Ira', "2019-08-12"));
$registry->addAnimal($hams = new Hamsters('Huha', "2017-06-14"));
$registry->addAnimal($donkey = new Donkeys('Mark', "2006-10-15"));
$registry->addAnimal($horse = new Horses('Ilon', "2016-02-25"));
$registry->addAnimal($horse2 = new Horses('Griff', "2018-07-31"));
$registry->addAnimal($camel = new Camels('Oliver', "2015-10-10"));
$registry->addAnimal($camel1 = new Camels('Kris', "2021-09-05"));


//choice ($registry,$view,$commands);

function choice ($registry,$view,$commands){
    while (true) {
        echo $view->menu;
        echo $view->inputNumber;
        $choice = readline();
        switch ($choice) {
            case "1":
                $animal = $registry->newAnimal();
                if (empty($animal)) {break;}
                $registry->addAnimal($animal);
                break;
            case "2":
                echo $view->inputNameForFind;
                $name = readline();
                if (empty($name)){break;}
                $registry->showCommands($registry->findAnimals($name));
                break;
            case "3":
                echo $view->commandsMenu;
                echo $view->inputNameForFind;
                $name = readline();
                if (empty($name)){break;}
                echo $view->inputCommand;
                $command = readline();
                $registry->addCommand($commands, $registry->findAnimals($name), $command);
                break;
            case "4":
                $registry->listAnimalsByDob();
                $registry->printAnimals();
                break;
            case "5":
                $registry->countAnimals();
                break;
            case "6":
                $registry->printAnimals();
                break;
            case "7":
                exit;
            default:
                echo $view->mistake;
        }
    }
}
