<?php

declare(strict_types=1);

namespace App\Controller\Auth;

use App\Entity\User;
use App\Form\PasswordResetType;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Exception;
use Symfony\Bridge\Doctrine\Attribute\MapEntity;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\Uid\Uuid;
use Twig\Environment;

class AuthController extends AbstractController
{
    #[Route(path: '/login', name: 'page_login')]
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        $error = $authenticationUtils->getLastAuthenticationError();
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('auth/login.html.twig', [
            'error' => $error,
            'lastUsername' => $lastUsername,
        ]);
    }

    #[Route(path: '/logout', name: 'page_logout')]
    public function logout(): void
    {
        throw new \LogicException('This method can be blank - it will be intercepted by the logout key on your firewall.');
    }

    #[Route(path: '/forgot', name: 'page_forgot')]
    public function forgot(
        Request $request,
        UserRepository $userRepository,
        AuthMailer $authMailer,
        EntityManagerInterface $entityManager,
    ): Response {
        $username = $request->get('username');
        if ($username) {
            try {
                $user = $userRepository->findOneBy(['email' => $username]);
                if ($user) {
                    $this->addFlash('error', 'Aucun utilisateur trouvé avec cet email');
                } else {
                    $resetPasswordToken = Uuid::v4()->toRfc4122();
                    $user->setResetPasswordToken($resetPasswordToken);
                    $entityManager->flush();
                    $authMailer->sendForgotEmail($user);

                    $this->addFlash('success', 'Email envoyé !');
                }

            } catch (Exception $e) {
                $this->addFlash('error', $e->getMessage());
            }
        }

        return $this->render(view: 'auth/forgot.html.twig');
    }

    #[Route(path: '/reset/{uid}', name: 'page_reset')]
    public function reset(
        string $uid,
        UserRepository $userRepository,
        Request $request,
        EntityManagerInterface $entityManager,
    ): Response
    {
        $user = $userRepository->findOneBy(['resetPasswordToken' => $uid]);

        if (!$user) {
            $this->addFlash('error', 'Token de réinitialisation invalide');
            return $this->redirectToRoute('page_forgot');
        }

        $form = $this->createForm(PasswordResetType::class);
        $form->handleRequest($request);
        $form->setData(['email' => $user->getEmail()]);

        if ($form->isSubmitted() && $form->isValid()) {
            $user->setResetPasswordToken(null);
            $entityManager->flush();

            $this->addFlash('success', 'Mot de passe réinitialisé');
            return $this->redirectToRoute('page_login');
        }

        return $this->render(view: 'auth/reset.html.twig', parameters: [
            'user' => $user,
            'form' => $form->createView(),
        ]);
    }






    #[Route(path: '/register', name: 'page_register')]
    public function register(): Response
    {
        return $this->render(view: 'auth/register.html.twig');
    }


    #[Route(path: '/confirm', name: 'page_confirm')]
    public function confirm(): Response
    {
        return $this->render(view: 'auth/confirm.html.twig');
    }
}
