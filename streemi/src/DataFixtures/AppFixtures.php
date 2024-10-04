<?php

namespace App\DataFixtures;

use App\Entity\Category;
use App\Entity\Movie;
use App\Entity\User;
use App\Entity\WatchHistory;
use App\Enum\UserAccountStatusEnum;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        for ($i = 0; $i < 50; $i++) {
            $film1 = new Movie();
            $film1->setTitle('Film ' . $i);
            $film1->setCoverImage('image' . $i . '.png');
            $film1->setShortDescription('description courte : ' . $i);
            $film1->setLongDescription('description longue : ' . $i);
            $film1->setReleaseDate(new \DateTime());
            $manager->persist($film1);
        }

        $film2 = new Movie();
        $film2->setTitle('Avatar');
        $film2->setCoverImage('avatar.png');
        $film2->setShortDescription('ça parle de mec en bleu écolo');
        $film2->setLongDescription('description longue de avatar');
        $film2->setReleaseDate(new \DateTime('+1 day'));
        $manager->persist($film2);

        $user = new User();
        $user->setUsername('baptiste');
        $user->setEmail('bvasseur77@example.com');
        $user->setPassword('motdepasse');
        $user->setAccountStatus(UserAccountStatusEnum::ACTIVE);
        $manager->persist($user);

        $history1 = new WatchHistory();
        $history1->setMedia($film1);
        $history1->setWatcher($user);
        $history1->setLastWatchedAt(new \DateTimeImmutable());
        $history1->setNumberOfViews(5);
        $manager->persist($history1);

        $history2 = new WatchHistory();
        $history2->setMedia($film2);
        $history2->setWatcher($user);
        $history2->setLastWatchedAt(new \DateTimeImmutable());
        $history2->setNumberOfViews(5);
        $manager->persist($history2);

        $tableau = [
            ['Action', 'action'],
            ['Aventure', 'aventure'],
        ];

        foreach ($tableau as $element) {
            $category = new Category();
            $category->setLabel($element[1]);
            $category->setNom($element[0]);
            $manager->persist($category);
        }

        $manager->flush();
    }
}
