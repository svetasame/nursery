<?php

class Commands
{
    private array $commands = ["name", "near", "sit", "lay", "up", "faster"];

    public function getCommands(): array
    {
        return $this->commands;
    }

}