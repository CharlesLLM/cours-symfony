<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20241004130337 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('ALTER TABLE user DROP test');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE `user` ADD test VARCHAR(255) NOT NULL');
    }
}
