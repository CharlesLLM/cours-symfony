<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20241004095041 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('ALTER TABLE media DROP nb_likes');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE media ADD nb_likes INT NOT NULL');
    }
}
