<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20241112084748 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Add description to subscription';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('ALTER TABLE subscription ADD description LONGTEXT NOT NULL');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE subscription DROP description');
    }
}
