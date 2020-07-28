<?php

namespace App\Controller;

use App\Entity\Project;
use App\Entity\Image;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class AdminController extends AbstractController
{
    /**
     * @Route("/admin", name="app_admin")
     */
    public function index()
    {
        $repository = $this->getDoctrine()->getRepository(Project::class);
        $projects = $repository->findAll();

        $image = new Image();

        return $this->render('admin/index.html.twig', [
            'projects' => $projects,
        ]);
    }
}
