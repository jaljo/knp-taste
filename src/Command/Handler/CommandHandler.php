<?php

namespace App\Command\Handler;

use App\Command\Command;

interface CommandHandler
{
    public function handle(Command $command);
}
