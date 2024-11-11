<?php

declare(strict_types=1);

namespace App\Controller;

use App\Enum\MediaTypeEnum;
use App\Repository\MediaRepository;
use App\Repository\MovieRepository;
use App\Repository\SerieRepository;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class HomeController extends AbstractController
{
    #[Route(path: '/', name: 'page_homepage')]
    public function home(
        Request $request,
        MovieRepository $movieRepository,
        SerieRepository $serieRepository,
    ): Response{
        $category = $request->query->get('category', MediaTypeEnum::MOVIE->value);

        if ($category === MediaTypeEnum::MOVIE->value) {
            $popularMedias = $movieRepository->findPopular();
        } else {
            $popularMedias = $serieRepository->findPopular();
        }

        return $this->render(view: 'index.html.twig', parameters: [
            'popularMedias' => $popularMedias,
            'category' => $category,
        ]);
    }
}
