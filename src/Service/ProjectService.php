<?php

namespace App\Service;

use App\Entity\Project;
use App\Repository\ProjectRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\FormInterface;

class ProjectService
{
    public function __construct(
        private ProjectRepository $projectRepository,
        private EntityManagerInterface $entityManager
    ) {}

    public function getAllProjects(): array
    {
        return $this->projectRepository->findAll();
    }

    public function getProjectById(int $id): ?Project
    {
        return $this->projectRepository->find($id);
    }

    public function createProject(Project $project): void
    {
        $project->setUserPosition('Специалист');
        $project->setStatus('Новый');
        
        $this->entityManager->persist($project);
        $this->entityManager->flush();
    }

    public function updateProject(Project $project): void
    {
        $this->entityManager->flush();
    }

    public function handleProjectForm(FormInterface $form, Project $project): bool
    {
        if ($form->isSubmitted() && $form->isValid()) {
            $this->updateProject($project);
            return true;
        }
        return false;
    }
}