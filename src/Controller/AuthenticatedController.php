<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class AuthenticatedController extends AbstractController
{
    /**
     * @Route("/signup", name="signup")
     */
    public function signup()
    {
        return $this->render('authenticated/register.html.twig');
    }
    /**
     * @Route("/signin", name="signin")
     */
    public function signin()
    {
        return $this->render('authenticated/signin.html.twig');
    }
}
