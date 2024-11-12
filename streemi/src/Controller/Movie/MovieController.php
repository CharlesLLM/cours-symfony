<?php

declare(strict_types=1);

namespace App\Controller\Movie;

use App\Entity\Media;
use App\Repository\WatchHistoryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class MovieController extends AbstractController
{
    #[Route(path: '/show/{id}', name: 'show_detail')]
    public function show(
        Media $media,
        WatchHistoryRepository $watchHistoryRepository,
    ): Response
    {
        $loggedUser = $this->getUser();

        if ($loggedUser) {
            $myWatchHistory = $watchHistoryRepository->findOneBy([
                'media' => $media,
                'watcher' => $this->getUser(),
            ]);
        } else {
            $myWatchHistory = null;
        }

        return $this->render('movie/detail.html.twig', [
            'media' => $media,
            'myWatchHistory' => $myWatchHistory,
        ]);
    }
}
