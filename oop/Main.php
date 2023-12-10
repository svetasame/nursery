<?php require_once 'function.php';

$registry = new AnimalRegistry();
$view = new View();
choice ($registry,$view);

function choice ($registry,$view){
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
                $registry->addCommand($registry->findAnimals($name), $command);
                break;
            case "4":
                $registry->listAnimalsByDob();
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
