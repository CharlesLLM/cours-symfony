<?php

namespace App\DataFixtures;

use App\Entity\Category;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class CategoryFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $langues = [
            ['action', 'Action'],
            ['aventure', 'Aventure'],
            ['comedie', 'Comédie'],
            ['drame', 'Drame'],
            ['fantastique', 'Fantastique'],
            ['horreur', 'Horreur'],
            ['policier', 'Policier'],
            ['science-fiction', 'Science-fiction'],
            ['thriller', 'Thriller'],
            ['western', 'Western'],
            ['animation', 'Animation'],
            ['biopic', 'Biopic'],
            ['documentaire', 'Documentaire'],
            ['guerre', 'Guerre'],
            ['historique', 'Historique'],
            ['musical', 'Musical'],
            ['romance', 'Romance'],
            ['sport', 'Sport'],
            ['comedie-musicale', 'Comédie musicale']
        ];

        foreach ($langues as $langue) {
            $entity = new Category();
            $entity->setNom($langue[0]);
            $entity->setLabel($langue[1]);
            $manager->persist($entity);
        }

        $manager->flush();
    }
}
