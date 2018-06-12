<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Course;
use App\Command\ViewCourseCommand;
use App\Command\Handler\ViewCourseCommandHandler;

class CourseController extends Controller
{
    /**
     * @param Request $request
     * @return Response
     */
    public function index(Request $request): Response
    {        
        try{
            $courses = $this->getDoctrine()
                ->getManager()
                ->getRepository(Course::class)
                ->findAll();            
        }
        catch(Exception $exception) {
            $request->getSession()->getFlashBag() ->add("error", $exception->getMessage());
        }
        
        return $this->render("course/index.html.twig", ["courses" => $courses]);
    }
    
    /**
     * @param Request $request
     * @return Response
     */
    public function view(Request $request): Response
    {
        try{
            $viewCourse = new ViewCourseCommand(
                $this->getUser()->getId(),
                $request->get("course_id")
            );
            
            $course = $this->get(ViewCourseCommandHandler::class)->handle($viewCourse);
        }
        catch(Exception $exception) {
            $request->getSession()->getFlashBag() ->add("error", $exception->getMessage());
        }
        
        return $this->render("course/index.html.twig", ["course" => $course]);        
    }
}
