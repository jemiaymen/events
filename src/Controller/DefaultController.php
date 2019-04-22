<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;


class DefaultController extends AbstractController
{

    public function index()
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        

        return $this->render('default/index.html.twig', [
            'controller_name' => 'DefaultController',
            'name' => 'Hello Jemix'
        ]);
    }
}
