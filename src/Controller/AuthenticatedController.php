<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;
use App\Entity\Users;

class AuthenticatedController extends AbstractController
{
	/**
     * @Route("/signin", name="signin")
     */
    public function signin()
    {

		return $this->render('authenticated/signin.html.twig');
    }


	/**
     * @Route("/signup", name="signup")
     */
    public function signup()
    {
		return $this->render('authenticated/register.html.twig');
    }

    /**
     * @Route("/signup-error", name="signup-error", methods="POST")
     */
    public function signup_error(request $request)
    {
		$username = $request->get("email");
        $password = $request->get("password");
        $name = $request->get("name");

    	$nbr = $this->getDoctrine()->getRepository(Users::class)
                         ->count(['email' => $username]);
        if ($nbr === 0) {
        	$session = new Session();
			$session->start();

			$admin = new Users();
			$admin->setName($name);
			$admin->setEmail($username);
			$admin->setPassword($password);

			$session->set('name', $admin->getName());
			$session->set('password', $admin->getPassword());
			$session->set('username', $admin->getEmail());
			$session->set('id', $admin->getId());

			$entityManager = $this->getDoctrine()->getManager();
	        $entityManager->persist($admin);
	        $entityManager->flush();

        	if ($session->get('name')) {
        		return $this->redirectToRoute('nearby');
        	}
        } else {
        	return $this->render('authenticated/register.html.twig', ['echec' => 'echec']);
        }
		return $this->render('authenticated/register.html.twig');
    	
    }

    /**
     * @Route("/signin-error", name="signin-error", methods="POST")
     */
    public function signin_error(request $request)
    {
    	$username = $request->get("email");
        $password = $request->get("password");

    	$nbr = $this->getDoctrine()->getRepository(Users::class)
                         ->count(['email' => $username, 'password' => $password]);
        $admin = $this->getDoctrine()->getRepository(Users::class)
                         ->findOneBy(['email' => $username, 'password' => $password]);
        if ($nbr === 1) {
        	$session = new Session();
			$session->start();
			$session->set('name', $admin->getName());
			$session->set('password', $admin->getPassword());
			$session->set('username', $admin->getEmail());
			$session->set('id', $admin->getId());


        	if ($session->get('name')) {
        		return $this->redirectToRoute('nearby');
        	}
        } else {
        	return $this->render('authenticated/signin.html.twig', ['echec' => 'echec']);
        }

    }

    /**
     * @Route("/Logout", name="logout")
     */
    public function logout()
    {   
        $session = new Session();
        if ($session->get('name')) {
            $session->clear();

            return $this->redirectToRoute('signin');
        } else {
            return $this->redirectToRoute('signin');
        }   
    }
}
