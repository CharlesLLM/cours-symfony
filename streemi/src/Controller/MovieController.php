<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\Movie;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class MovieController extends AbstractController
{
    #[Route('/movie/{id}', name: 'movie_list')]
    public function index(Movie $movie): Response
    {
        return $this->render('movie/detail.html.twig', [
            'movie' => $movie
        ]);
    }

}
