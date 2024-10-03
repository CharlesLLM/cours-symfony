<?php

namespace App\DataFixtures;

use App\Entity\Episode;
use App\Entity\Movie;
use App\Entity\Season;
use App\Entity\Serie;
use App\Entity\Subscription;
use App\Entity\SubscriptionHistory;
use App\Entity\User;
use App\Enum\UserStatusEnum;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $this->createSeries($manager);
        $this->createMovies($manager);
        $users = $this->createUsers($manager);

//        $subscription = new Subscription();
//        $subscription->setName('Abonnement 6 mois');
//        $subscription->setDuration(6);
//        $subscription->setPrice(60);
//        $user->setCurrentSubscription($subscription);
//        $manager->persist($subscription);
//
//        $history1 = new SubscriptionHistory();
//        $history1->setStartAt(new \DateTimeImmutable('-6 months'));
//        $history1->setEndAt(new \DateTimeImmutable('-1 hour'));
//        $history1->setSubscriber($user);
//        $history1->setSubscription($subscription);
//        $manager->persist($history1);

        $manager->flush();
    }

    protected function createSeries(ObjectManager $manager): void
    {
        for ($i = 0; $i < 10; $i++) {
            $serie = new Serie();
            $serie->setTitle('Serie #1');
            $serie->setReleaseDate(new \DateTime('2008-01-20'));
            $serie->setShortDescription("Courte Description {$i}");
            $serie->setLongDescription("Longue Description {$i}");
            $serie->setCoverImage("image_{$i}.jpg");
            $serie->setStaff([]);
            $manager->persist($serie);

            $nbDeSaisonAGenerer = random_int(1, 5);
            for ($j = 0; $j < $nbDeSaisonAGenerer; $j++) {
                $season = new Season();
                $season->setNumber($j);
                $season->setSerie($serie);
                $manager->persist($season);

                $nbDEpisodesAGenerer = random_int(1, 10);
                for ($k = 0; $k < $nbDEpisodesAGenerer; $k++) {
                    $episode = new Episode();
                    $episode->setTitle("Episode {$k}");
                    $episode->setDuration(50);
                    $episode->setReleasedAt(new \DateTimeImmutable());
                    $season->addEpisode($episode);
                    $manager->persist($episode);
                }
            }
        }
    }

    protected function createMovies(ObjectManager $manager): void
    {
        for ($i = 0; $i < 10; $i++) {
            $serie = new Movie();
            $serie->setTitle('Serie #1');
            $serie->setReleaseDate(new \DateTime('2008-01-20'));
            $serie->setShortDescription("Courte Description {$i}");
            $serie->setLongDescription("Longue Description {$i}");
            $serie->setCoverImage("image_{$i}.jpg");
            $serie->setStaff([]);
            $manager->persist($serie);
        }
    }

    protected function createUsers(ObjectManager $manager): array
    {
        $users = [];

        for ($i = 0; $i < 10; $i++) {
            $user = new User();
            $user->setUsername('admin');
            $user->setEmail('admin@example.com');
            $user->setAccountStatus(UserStatusEnum::ACTIVE);
            $user->setPassword('motdepasse');
            $manager->persist($user);
            $users[] = $user;
        }

        return $users;
    }
}
