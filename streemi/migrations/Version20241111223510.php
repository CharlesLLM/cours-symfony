<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241111223510 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE media_subtitle (media_id INT NOT NULL, language_id INT NOT NULL, INDEX IDX_5EE4B903EA9FDD75 (media_id), INDEX IDX_5EE4B90382F1BAF4 (language_id), PRIMARY KEY(media_id, language_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE media_subtitle ADD CONSTRAINT FK_5EE4B903EA9FDD75 FOREIGN KEY (media_id) REFERENCES media (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE media_subtitle ADD CONSTRAINT FK_5EE4B90382F1BAF4 FOREIGN KEY (language_id) REFERENCES language (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE media_subtitle DROP FOREIGN KEY FK_5EE4B903EA9FDD75');
        $this->addSql('ALTER TABLE media_subtitle DROP FOREIGN KEY FK_5EE4B90382F1BAF4');
        $this->addSql('DROP TABLE media_subtitle');
    }
}
