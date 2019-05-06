<?php

namespace App\Controller;

use App\Entity\Tome;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TomeController extends AbstractController
{
    /**
     * @Route("/tome/{slug}", name="app_tome_show")
     *
     * @param Tome $tome
     *
     * @return Response
     */
    public function show(Tome $tome)
    {
        return $this->render('tome/show.html.twig', ['tome' => $tome]);
    }
}
