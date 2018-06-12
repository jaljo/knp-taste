<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Course;
use App\Command\ViewCourseCommand;
use App\Command\Handler\ViewCourseCommandHandler;
use Exception;

class CourseController extends Controller
{
    /**
     * @param Request $request
     * @return Response
     */
    public function index(Request $request): Response
    {        
        try{
            $courses = $this->getDoctrine()->getManager()->getRepository(Course::class)
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
            // in all case, we have to get the course details
            $course = $this->getDoctrine()->getManager()->getRepository(Course::class)
                ->find($request->get("course_id"));      
            
            // ensure business rules for video visualization are respected
            $viewCourse = new ViewCourseCommand(
                $this->getUser()->getId(),
                $request->get("course_id")
            );                        
            $this->get(ViewCourseCommandHandler::class)->handle($viewCourse);
            
            return $this->render("course/view.html.twig", [
                "course" => $course,
                "displayVideo" => true
            ]);    
        }
        catch(Exception $exception) {
            $request->getSession()->getFlashBag() ->add("error", $exception->getMessage());
        }
        
        return $this->render("course/view.html.twig", [
            "course" => $course,
            "displayVideo" => false
        ]);
    }
}
