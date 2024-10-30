<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20241030115633 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Ajout aeâoeapzeo';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('ALTER TABLE movie ADD duration INT NOT NULL');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE movie DROP duration');
    }
}
