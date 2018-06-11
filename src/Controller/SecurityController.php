<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\HttpFoundation\Response;
use App\Form\UserType;
use App\Command\RegisterUserCommand;
use App\Command\Handler\RegisterUserCommandHandler;
use Exception;

class SecurityController extends Controller
{
    /**
     * @param Request $request
     * @param AuthenticationUtils $authenticationUtils
     * @return Response
     */
    public function login(Request $request, AuthenticationUtils $authenticationUtils): Response
    {
        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();

        // last username entered by the user
        $lastEmail = $authenticationUtils->getLastUsername();

        return $this->render('security/login.html.twig', array(
            'last_email' => $lastEmail,
            'error' => $error,
        ));        
    }
    
    /**
     * @todo redirect to course index instead of test page
     * 
     * @param Request $request
     * @return Response
     */
    public function registerUser(Request $request): Response
    {
        $userForm = $this->createForm(UserType::class);        
        $userForm->handleRequest($request);
        
        if($userForm->isSubmitted() && $userForm->isValid()) {
            try{
                $userData = $userForm->getData();                
                
                $registerUser = new RegisterUserCommand(
                    $userData["email"], $userData["username"], $userData["password"]
                );
                
                $this->get(RegisterUserCommandHandler::class)->handle($registerUser);   
                
                $request->getSession()->getFlashBag() ->add("message", "Enregistrement réussi !");
            }
            catch(Exception $exception) {
                $request->getSession()->getFlashBag() ->add("message", $exception->getMessage());
            }
            
            return $this->redirect($this->generateUrl("test"));
        }
        
        return $this->render("security/register.html.twig", ["userform" => $userForm->createView()]);
    }
}
