<?php

namespace App\Command\Handler;

use App\Command\Handler\ICommandHandler;
use App\Command\ICommand;
use App\Entity\User;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use App\Repository\IUserRepository;

class RegisterUserCommandHandler implements ICommandHandler
{
    /***
     * @var UserPasswordEncoderInterface
     */
    private $encoder;
    
    /**
     * @var IUserRepository 
     */
    private $userRepository;
    
    /**
     * @param UserPasswordEncoderInterface $encoder
     * @param IUserRepository $userRepository
     */
    public function __construct(UserPasswordEncoderInterface $encoder, IUserRepository $userRepository)
    {
        $this->encoder = $encoder;
        $this->userRepository = $userRepository;
    }
    
    /**
     * Encode password then persist user to database.
     * 
     * @param ICommand $command
     */
    public function handle(ICommand $command)
    {
        $user = User::register($command->email, $command->username, $command->password);

        $password = $this->encoder->encodePassword($user, $command->password);
        $user->setPassword($password);
        
        $this->userRepository->save($user);
    }
}
