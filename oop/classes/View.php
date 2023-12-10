<?php

class View
{
    public string $menu = "\nДействия:
            \n1 - Добавить новое животное;
            \n2 - Вывести список команд, которые умеет животное;
            \n3 - Обучить животное новой команде;
            \n4 - Вывести список животных с сортировкой по дате рождения;
            \n5 - Вывести общее количество животных;
            \n6 - Показать реестр животных;
            \n7 - Выйти.";
    public string $inputNumber = "\nВведите номер действия: ";
    public string $inputCommand = "\nВведите комманду: ";
    public string $inputNameForFind = "\nВведите имя животного: ";

    public string $commandsMenu = "\nКоманды:
                          \n1 - Имя (name);
                          \n2 - Рядом (near);
                          \n3 - Сидеть (sit);
                          \n4 - Лежать (lay);
                          \n5 - Вверх (up);
                          \n6 - Быстрее (faster).";
    public string $mistake = "Таких животных нет.";
}