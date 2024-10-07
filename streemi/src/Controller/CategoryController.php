<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\Category;
use App\Repository\CategoryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class CategoryController extends AbstractController
{
    #[Route('/discover', name: 'movie_discover')]
    public function discover_category(CategoryRepository $repository): Response
    {
        return $this->render('discover.html.twig', [
            'categories' => $repository->findAll()
        ]);
    }

    #[Route('/category/{id}', name: 'show_category')]
    public function show_category(Category $category): Response
    {
        return $this->render('category.html.twig', [
            'category' => $category
        ]);
    }

}
