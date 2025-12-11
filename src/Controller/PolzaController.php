<?php

namespace App\Controller;


use App\Entity\Project;
use App\Entity\User;
use App\Form\ProjectForm;
use Doctrine\ORM\EntityManagerInterface;
use Proxies\__CG__\App\Entity\User as EntityUser;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Repository\ProjectRepository;
use App\Form\ProjectFormType;
use Symfony\Component\HttpFoundation\Request;
use App\Service\ProjectService;


class PolzaController extends AbstractController
{
    public function __construct(
        private ProjectService $projectService
    ) {}

   #[Route('/projects', name: 'app_projects')]
public function index(): Response
{
    $projects = $this->projectService->getAllProjects();
    
    return $this->render('polza/index.html.twig', [
        'projects' => $projects,
    ]);
}

    #[Route('/polza/project/new', name: 'app_project_new')]
    public function new(Request $request): Response
    {
        $project = new Project();
        $form = $this->createForm(ProjectFormType::class, $project);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->projectService->createProject($project);
            
            $this->addFlash('success', 'Проект успешно создан!');
            return $this->redirectToRoute('app_project_show', ['id' => $project->getId()]);
        }

        return $this->render('polza/project_new.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/polza/project/{id}', name: 'app_project_show')]
    public function show(Project $project, Request $request): Response
    {
        $form = $this->createForm(ProjectFormType::class, $project);
        $form->handleRequest($request);

        if ($this->projectService->handleProjectForm($form, $project)) {
            $this->addFlash('success', 'Проект успешно обновлен!');
            return $this->redirectToRoute('app_project_show', ['id' => $project->getId()]);
        }

        return $this->render('polza/project_show.html.twig', [
            'project' => $project,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/', name: 'app_homepage')]
    public function homepage(): Response
    {
        return $this->redirectToRoute('app_projects');
    }

}



