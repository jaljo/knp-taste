<?php

namespace App\Command\Handler;

use App\Command\Handler\CommandHandler;
use App\Command\Command;
use App\Entity\User;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use App\Repository\UserRepository;

class RegisterUserCommandHandler implements CommandHandler
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
     * @param UserRepository $userRepository
     */
    public function __construct(UserPasswordEncoderInterface $encoder, UserRepository $userRepository)
    {
        $this->encoder = $encoder;
        $this->userRepository = $userRepository;
    }

    /**
     * Encode password then persist user to database.
     *
     * @param Command $command
     */
    public function handle(Command $command)
    {
        $user = User::register($command->email, $command->username, $command->password, ["ROLE_USER"]);

        $password = $this->encoder->encodePassword($user, $command->password);
        $user->setPassword($password);

        $this->userRepository->save($user);
    }
}
