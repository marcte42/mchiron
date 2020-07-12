<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProjectController extends AbstractController
{
    /**
     * @Route("/")
     */
    public function homepage()
    {
        return new Response('Homepage');
    }

    /**
     * @Route("/projects/{project_id}")
     */
    public function show($project_id)
    {
        $title = "Mon premier projet";
        $description = "Ceci est mon premier projet que j'ai réalisé lors de ma denrière année chez doudou et compagnie.";
        $project_date = "07/09/2019";
        $client = "Doudou";

        return $this->render('project/show.html.twig',[
            'project' => $project_id,
            'title' => $title,
            'description' => $description,
            'project_date' => $project_date,
            'client' => $client
        ]);
    }
}