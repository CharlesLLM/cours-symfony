<?php

declare(strict_types=1);

namespace App\Controller\Movie;

use App\Entity\Playlist;
use App\Entity\User;
use App\Enum\UserRoleEnum;
use App\Repository\PlaylistRepository;
use App\Repository\PlaylistSubscriptionRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[IsGranted(UserRoleEnum::ROLE_USER->value)]
class ListController extends AbstractController
{
    #[Route('/lists', name: 'page_lists')]
    public function index(
        PlaylistRepository $playlistRepository,
        Request $request,
    ): Response
    {
        $playlistId = $request->query->get('playlist');

        if ($playlistId) {
            $currentPlaylist = $playlistRepository->find($playlistId);
        } else {
            $currentPlaylist = null;
        }

        /** @var User $currentUser */
        $currentUser = $this->getUser();
        $myPlaylists = $currentUser->getPlaylists();
        $myPlalistSubscriptions = $currentUser->getPlaylistSubscriptions();

        return $this->render('movie/lists.html.twig',[
            'playlists' => $myPlaylists,
            'playlistSubscriptions' => $myPlalistSubscriptions,
            'currentPlaylist' => $currentPlaylist
        ]);
    }

//    #[Route('/lists', name: 'api_playlist_add', methods: ['POST'])]
//    public function createPlaylist(Request $request, EntityManagerInterface $entityManager): JsonResponse
//    {
//        $data = json_decode($request->getContent(), true);
//
//        $playlist = new Playlist();
//        $playlist->setName($data['name']);
//        $playlist->setCreator($this->getUser());
//        $playlist->setCreatedAt(new \DateTimeImmutable());
//        $playlist->setUpdatedAt(new \DateTimeImmutable());
//        $entityManager->persist($playlist);
//        $entityManager->flush();
//
//        return new JsonResponse([
//            'id' => $playlist->getId(),
//            'name' => $playlist->getName(),
//            'uuid' => $playlist->getUuid()
//        ]);
//    }
}
