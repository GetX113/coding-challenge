<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ShopsController extends AbstractController
{
    /**
     * @Route("/nearby", name="nearby")
     */
    public function nearby()
    {
        return $this->render('shops/nearby.html.twig');
    }

    /**
     * @Route("/preferred", name="preferred")
     */
    public function preferred()
    {
        return $this->render('shops/preferred.html.twig');
    }
}
