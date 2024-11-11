<?php

namespace App\EventSubscriber;

use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Attribute\AsEntityListener;
use Doctrine\ORM\Event\PrePersistEventArgs;
use Doctrine\ORM\Events;
use Doctrine\ORM\Mapping\PrePersist;
use Doctrine\ORM\Mapping\PreUpdate;
use Doctrine\Persistence\Event\PreUpdateEventArgs;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Security\Http\Event\SwitchUserEvent;

#[AsEntityListener(event: Events::preUpdate, method: 'onPreUpdate', entity: User::class)]
#[AsEntityListener(event: Events::prePersist, method: 'onPrePersist', entity: User::class)]
class UserPasswordSubscriber
{
    public function __construct(
        protected UserPasswordHasherInterface $passwordHasher
    ) {}

    public function onPrePersist(User $user): void
    {
        $this->hashPassword($user);
    }

    public function onPreUpdate(User $user): void
    {
        $this->hashPassword($user);
    }

    protected function hashPassword(User $user): void
    {
        if ($user->getPlainPassword() === null) {
            return;
        }

        $hashedPassword = $this->passwordHasher->hashPassword($user, $user->getPlainPassword());
        $user->setPassword($hashedPassword);

        $user->eraseCredentials();
    }
}
