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
     * @param Request $request
     * @return Response
     */
    public function registerUser(Request $request): Response
    {
        // create form and bind request data to it
        $userForm = $this->createForm(UserType::class);        
        $userForm->handleRequest($request);
                
        // handle user form registration data
        if($userForm->isSubmitted() && $userForm->isValid()) {
            try{
                    $userData = $userForm->getData();                

                    // form data processing is delegated to a handler using the command pattern
                    $registerUser = new RegisterUserCommand(
                        $userData["email"], $userData["username"], $userData["password"]
                    );
                    $this->get(RegisterUserCommandHandler::class)->handle($registerUser);   

                    $request->getSession()->getFlashBag() ->add("message", "Successful registration !");
            }
            catch(Exception $exception) {
                $request->getSession()->getFlashBag() ->add("message", $exception->getMessage());
            }
            
            // redirect to login page
            return $this->redirect($this->generateUrl("login"));
        }
        
        // redirect to registration form and display errors with flashbag messages
        return $this->render("security/register.html.twig", ["userform" => $userForm->createView()]);
    }
}
