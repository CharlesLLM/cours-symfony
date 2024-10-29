<?php

declare(strict_types=1);

namespace App\Controller\Other;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ListController extends AbstractController
{
    #[Route(path: '/lists', name: 'show_my_list')]
    public function show(): Response
    {
        return $this->render('other/lists.html.twig');
    }
}
