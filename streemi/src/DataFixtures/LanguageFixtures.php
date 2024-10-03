<?php

namespace App\DataFixtures;

use App\Entity\Language;
use App\Enum\UserStatusEnum;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class LanguageFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $langues = [
            ['label' => 'Français', 'code' => 'FR'],
            ['label' => 'Anglais', 'code' => 'EN'],
            ['label' => 'Italien', 'code' => 'IT'],
            ['label' => 'Espagnol', 'code' => 'ES'],
            ['label' => 'Allemand', 'code' => 'DE'],
            ['label' => 'Portugais', 'code' => 'PT'],
            ['label' => 'Néerlandais', 'code' => 'NL'],
            ['label' => 'Russe', 'code' => 'RU'],
            ['label' => 'Chinois', 'code' => 'ZH'],
            ['label' => 'Japonais', 'code' => 'JA'],
            ['label' => 'Coréen', 'code' => 'KO'],
            ['label' => 'Arabe', 'code' => 'AR'],
            ['label' => 'Hindi', 'code' => 'HI'],
            ['label' => 'Turc', 'code' => 'TR'],
            ['label' => 'Vietnamien', 'code' => 'VI'],
            ['label' => 'Thaïlandais', 'code' => 'TH'],
            ['label' => 'Grec', 'code' => 'EL'],
            ['label' => 'Polonais', 'code' => 'PL'],
            ['label' => 'Tchèque', 'code' => 'CS'],
            ['label' => 'Slovaque', 'code' => 'SK'],
            ['label' => 'Hongrois', 'code' => 'HU'],
            ['label' => 'Bulgare', 'code' => 'BG'],
            ['label' => 'Roumain', 'code' => 'RO'],
            ['label' => 'Danois', 'code' => 'DA'],
            ['label' => 'Suédois', 'code' => 'SV'],
            ['label' => 'Norvégien', 'code' => 'NO'],
            ['label' => 'Finnois', 'code' => 'FI'],
            ['label' => 'Islandais', 'code' => 'IS'],
            ['label' => 'Estonien', 'code' => 'ET'],
            ['label' => 'Letton', 'code' => 'LV'],
            ['label' => 'Lituanien', 'code' => 'LT'],
            ['label' => 'Croate', 'code' => 'HR'],
            ['label' => 'Serbe', 'code' => 'SR'],
            ['label' => 'Slovain', 'code' => 'SL'],
            ['label' => 'Slovène', 'code' => 'SL'],
            ['label' => 'Macédonien', 'code' => 'MK'],
            ['label' => 'Albanais', 'code' => 'SQ'],
            ['label' => 'Bosniaque', 'code' => 'BS'],
            ['label' => 'Monténégrin', 'code' => 'ME'],
            ['label' => 'Kosovar', 'code' => 'SQ'],
            ['label' => 'Catalan', 'code' => 'CA'],
            ['label' => 'Basque', 'code' => 'EU'],
            ['label' => 'Galicien', 'code' => 'GL'],
            ['label' => 'Occitan', 'code' => 'OC'],
            ['label' => 'Breton', 'code' => 'BR'],
            ['label' => 'Cantonais', 'code' => 'ZH'],
            ['label' => 'Shanghaïen', 'code' => 'ZH'],
            ['label' => 'Hakka', 'code' => 'ZH'],
            ['label' => 'Min Nan', 'code' => 'ZH'],
            ['label' => 'Wu', 'code' => 'ZH'],
            ['label' => 'Cantonais', 'code' => 'ZH'],
            ['label' => 'Shanghaïen', 'code' => 'ZH'],
            ['label' => 'Hakka', 'code' => 'ZH'],
            ['label' => 'Min Nan', 'code' => 'ZH'],
            ['label' => 'Wu', 'code' => 'ZH'],
            ['label' => 'Cantonais', 'code' => 'ZH'],
            ['label' => 'Shanghaïen', 'code' => 'ZH'],
            ['label' => 'Hakka', 'code' => 'ZH'],
            ['label' => 'Min Nan', 'code' => 'ZH'],
            ['label' => 'Wu', 'code' => 'ZH'],
            ['label' => 'Cantonais', 'code' => 'ZH'],
            ['label' => 'Shanghaïen', 'code' => 'ZH'],
        ];

        foreach ($langues as $langue) {
            $entity = new Language();
            $entity->setCode($langue['code']);
            $entity->setNom($langue['label']);
            $manager->persist($entity);
        }

        $manager->flush();
    }
}
