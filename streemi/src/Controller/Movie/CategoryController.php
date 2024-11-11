<?php

declare(strict_types=1);

namespace App\Controller\Movie;

use App\Entity\Category;
use App\Repository\CategoryRepository;
use App\Repository\MediaRepository;
use Symfony\Bridge\Doctrine\Attribute\MapEntity;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class CategoryController extends AbstractController
{
    #[Route(path: '/category/{nom}', name: 'page_category', )]
    public function category(
        #[MapEntity(mapping: ['nom' => 'nom'])]
        Category $currentCategory,
        CategoryRepository $categoryRepository,
        MediaRepository $mediaRepository,
    ): Response
    {
        $otherCategories = $categoryRepository->findOtherCategories($currentCategory, limit: 5);
        $medias = $mediaRepository->findMediasByCategory($currentCategory);

        return $this->render(view: 'movie/category.html.twig', parameters: [
            'currentCategory' => $currentCategory,
            'otherCategories' => $otherCategories,
            'medias' => $medias,
        ]);
    }

    #[Route(path: '/discover', name: 'page_discover')]
    public function discover(
        MediaRepository $mediaRepository,
        CategoryRepository $categoryRepository
    ): Response
    {
        $popularMedias = $mediaRepository->findPopular(limit: 3);
        $categories = $categoryRepository->findAll();

        return $this->render(view: 'movie/discover.html.twig', parameters: [
            'popularMedias' => $popularMedias,
            'categories' => $categories,
        ]);
    }
}
