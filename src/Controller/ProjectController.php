<?php

namespace App\Controller;

use App\Entity\Project;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProjectController extends AbstractController
{
    /**
     * @Route("/", name="app_homepage")
     */
    public function homepage()
    {
        $repository = $this->getDoctrine()->getRepository(Project::class);

        $projects = $repository->findAllWithCategory();
        
        return $this->render('project/homepage.html.twig',[
            'projects' => $projects
        ]);
    }

    /**
     * @Route("/project/new", name="app_project_new")
     */
    public function createProduct(): Response
    {
        return new Response('Saved new project :');
    }

    /**
     * @Route("/project/{project_id}", name="app_project_show")
     */
    public function show($project_id)
    {
        $em = $this->getDoctrine()->getManager();

        // On récupère le projet
        $project = $em->getRepository(Project::class)->find($project_id);

        if (null === $project) {
            throw $this->createNotFoundException("Le projet ".$project_id." n'existe pas.");
        }

        // On récupère la liste des images
        $images = $em->getRepository('App:Image')->findBy(['project' => $project]);

        // On récupère la catégorie
        $category = $em->getRepository('App:Category')->findOneBy(['id' => $project_id]);

        dump($category);

        return $this->render('project/show.html.twig',[
            'project' => $project,
            'category' => $category,
            'images' => $images
        ]);
    }
}