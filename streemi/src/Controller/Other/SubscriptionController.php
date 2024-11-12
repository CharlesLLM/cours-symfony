<?php

declare(strict_types=1);

namespace App\Controller\Other;

use App\Entity\Subscription;
use App\Entity\User;
use App\Repository\SubscriptionRepository;
use App\Service\Mailer\SubscriptionMailer;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

class SubscriptionController extends AbstractController
{
    #[Route('/subscriptions', name: 'page_subscription')]
    public function index(
        SubscriptionRepository $subscriptionRepository
    ): Response
    {
        /** @var User $currentUser */
        $currentUser = $this->getUser();
        $currentSubscription = $currentUser->getCurrentSubscription();

        $subscriptions = $subscriptionRepository->findAll();

        return $this->render('other/subscriptions.html.twig', [
            'subscriptions' => $subscriptions,
            'currentSubscription' => $currentSubscription,
        ]);
    }


    #[IsGranted('ROLE_USER')]
    #[Route('/subscription/{id}', name: 'page_subscription_pay')]
    public function show(
        Subscription $subscription,
        Request $request,
        EntityManagerInterface $entityManager,
        SubscriptionMailer $subscriptionMailer,
    ): Response {

        /** @var User $currentUser */
        $currentUser = $this->getUser();
        $currentSubscription = $currentUser->getCurrentSubscription();

        if ($request->isMethod('POST')) {
            $csrfToken = $request->request->get('_csrf_token');
            if ($this->isCsrfTokenValid('pay_subscription', $csrfToken)) {
                $currentUser->setCurrentSubscription($subscription);
                $entityManager->flush();
                $subscriptionMailer->sendNewSubscription($currentUser, $subscription);

                $this->addFlash('success', "Votre abonnement a bien été pris en compte.");
            } else {
                $this->addFlash('error', "Une erreur est survenue, veuillez réessayer.");
            }
        }

        return $this->render('other/pay_subscription.html.twig', [
            'subscription' => $subscription,
            'currentSubscription' => $currentSubscription,
        ]);
    }
}
