<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use App\Entity\User;

class SecurityController extends Controller
{
    /**
     * @param Request $request
     * @param AuthenticationUtils $authenticationUtils
     * @return type
     */
    public function login(Request $request, AuthenticationUtils $authenticationUtils): Response
    {
        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();

        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('security/login.html.twig', array(
            'last_username' => $lastUsername,
            'error' => $error,
        ));        
    }
    
    /**
     * @param UserPasswordEncoderInterface $encoder
     * @todo provide parameters from request instead of hardcoding them.
     */
    public function registerUser(UserPasswordEncoderInterface $encoder): void
    {
        $user = User::register("joris", "langlois");

        $password = $encoder->encodePassword($user, "langlois");
        $user->encodPassword($password);
        
        $em = $this->getDoctrine()->getManager();
        $em->persist($user);
        $em->flush();
        
        exit;
    }
}
