<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220804154034 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE play DROP FOREIGN KEY FK_5E89DEBA3DA5256D');
        $this->addSql('DROP INDEX IDX_5E89DEBA3DA5256D ON play');
        $this->addSql('ALTER TABLE play DROP image_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE play ADD image_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE play ADD CONSTRAINT FK_5E89DEBA3DA5256D FOREIGN KEY (image_id) REFERENCES picture (id)');
        $this->addSql('CREATE INDEX IDX_5E89DEBA3DA5256D ON play (image_id)');
    }
}
