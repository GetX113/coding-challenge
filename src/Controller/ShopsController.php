<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\Session;
use App\Entity\Product;
use App\Entity\Preferred;
use App\Entity\Rejected;

class ShopsController extends AbstractController
{
    /**
     * @Route("/nearby", name="nearby")
     */
    public function nearby()
    {
    	$session = new Session();
        if ($session->get('name')) {
            $product = $this->getDoctrine()->getRepository(Product::class)->findAll();
            $rejected = $this->getDoctrine()->getRepository(Rejected::class)->findBy(array('id_user' => $session->get('id')));

            return $this->render('shops/nearby.html.twig', array('product' => $product, 'rejected' => $rejected));
        } else {
            return $this->redirectToRoute('signin');
        }   
        
    }

    /**
     * @Route("/preferred", name="preferred")
     */
    public function preferred()
    {
    	$session = new Session();
        if ($session->get('name')) {
        	// $preferred = new Product();
        	$preferred = array();
        	$idPreferred = array();
            $product = $this->getDoctrine()->getRepository(Preferred::class)->findBy(array('id_user' => $session->get('id')));
            foreach ($product as $item) {

            	array_push($idPreferred, intval($item->getId()));
            	$prod = $this->getDoctrine()->getRepository(Product::class)->findOneBy(['id' => $item->getIdProduct()]);
            	array_push($preferred, $prod);
            }
            return $this->render('shops/preferred.html.twig', array('preferred' => $preferred, 'idPreferred' => $idPreferred ));
        } else {
            return $this->redirectToRoute('signin');
        } 
    }

    /**
     * @Route("/preferred/add/{id}", name="add-preferred")
     */
    public function add_preferred($id)
    {
    $session = new Session();
    if ($session->get('name')) {
        $preferred = new Preferred();
        $id_user = intval($session->get('id'));
        $preferred->setIdUser($id_user);
        $preferred->setIdProduct($id);

        
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($preferred);
        $entityManager->flush();
        return $this->redirectToRoute('preferred');
    
    } else {
            return $this->redirectToRoute('signin');
        }  
    }

    /**
     * @Route("/preferred/remove/{id}", name="delete-preferred")
     */
    public function delete_preferred($id)
    {   
        $session = new Session();
        if ($session->get('name')) {
            $entityManager = $this->getDoctrine()->getManager();
            $preferred = $entityManager->getRepository(Preferred::class)->find($id);
            $entityManager->remove($preferred);
            $entityManager->flush();

            return $this->redirectToRoute('preferred');
        } else {
            return $this->redirectToRoute('signin');
        }   
    }

    /**
     * @Route("/rejected/{id}", name="rejected")
     */
    public function rejected($id)
    {   
        $session = new Session();
        if ($session->get('name')) {
        	$rejected = new Rejected();

        	$now = date("Y-m-d H:i:s");
            $rejectedTime = date('Y-m-d H:i:s',strtotime('+2 hour',strtotime($now)));

            $rejected->setIdProduct($id);
            $rejected->setIdUser($session->get('id'));
            $rejected->setRejectedDate($rejectedTime);

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($rejected);
            $entityManager->flush();

            return $this->redirectToRoute('nearby');
        } else {
            return $this->redirectToRoute('signin');
        }   
    }
}
