<?php

namespace App\Command;

use App\Command\ICommand;

class RegisterUserCommand implements ICommand
{
    /**
     * @var string 
     */
    public $username;
    
    /**
     * @var string 
     */    
    public $password;
    
    /**
     * @var string 
     */    
    public $email;
    
    /**
     * @param string $email
     * @param string $username
     * @param string $password
     */
    public function __construct(string $email, string $username, string $password)
    {
        $this->username = $username;
        $this->password = $password;
        $this->email = $email;
    }
}
