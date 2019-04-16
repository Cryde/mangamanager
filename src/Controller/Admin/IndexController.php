<?php

namespace App\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class IndexController extends AbstractController
{
    /**
     * @Route("/admin/", name="app_admin")
     *
     * @return Response
     */
    public function index()
    {
        return $this->render('admin/index.html.twig');
    }
}
