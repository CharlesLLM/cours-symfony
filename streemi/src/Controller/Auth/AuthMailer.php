<?php

declare(strict_types=1);

namespace App\Controller\Auth;

use App\Entity\User;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Twig\Environment;

class AuthMailer
{
    public function __construct(
        protected Environment $twig,
        protected MailerInterface $mailer,
    )
    {
    }

    public function sendForgotEmail(User $user): void
    {
        $email = (new Email())
            ->from('contact@streemi.fr')
            ->to($user->getEmail())
            ->subject('Mot de passe oublié')
            ->html($this->twig->render('emails/forgot.html.twig', ['user' => $user]));

        $this->mailer->send($email);
    }

    public function sendResetEmail(User $user): void
    {
        $email = (new Email())
            ->from('contact@streemi.fr')
            ->to($user->getEmail())
            ->subject('Votre mot de passe a été réinitialisé')
            ->html($this->twig->render('emails/reset.html.twig', ['user' => $user]));

        $this->mailer->send($email);
    }
}
