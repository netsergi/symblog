<?php
// src/Blogger/BlogBundle/Controller/DefaultController.php

namespace Blogger\BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
       	
        return $this->render('BloggerBlogBundle:Default:index.html.twig', array('name' => $name));
    }
}