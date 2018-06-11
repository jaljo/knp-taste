<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class CourseController extends Controller
{
    /**
     * @return Response
     */
    public function index(): Response
    {        
        return $this->render("course/index.html.twig");
    }
}
