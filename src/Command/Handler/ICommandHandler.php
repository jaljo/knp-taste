<?php

namespace App\Command\Handler;

use App\Command\ICommand;

interface ICommandHandler
{
    public function handle(ICommand $command);
}
