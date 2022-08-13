<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220813131539 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE photo (id INT AUTO_INCREMENT NOT NULL, play_id INT DEFAULT NULL, url VARCHAR(255) NOT NULL, credits VARCHAR(255) NOT NULL, INDEX IDX_14B7841825576DBD (play_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE photo ADD CONSTRAINT FK_14B7841825576DBD FOREIGN KEY (play_id) REFERENCES play (id)');
        $this->addSql('ALTER TABLE date DROP FOREIGN KEY FK_AA9E377A8E9B79EB');
        $this->addSql('DROP INDEX IDX_AA9E377A8E9B79EB ON date');
        $this->addSql('ALTER TABLE date DROP play_id_id');
        $this->addSql('ALTER TABLE play DROP FOREIGN KEY FK_5E89DEBA32A85379');
        $this->addSql('DROP INDEX IDX_5E89DEBA32A85379 ON play');
        $this->addSql('ALTER TABLE play DROP collectif_id_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE photo');
        $this->addSql('ALTER TABLE date ADD play_id_id INT NOT NULL');
        $this->addSql('ALTER TABLE date ADD CONSTRAINT FK_AA9E377A8E9B79EB FOREIGN KEY (play_id_id) REFERENCES play (id)');
        $this->addSql('CREATE INDEX IDX_AA9E377A8E9B79EB ON date (play_id_id)');
        $this->addSql('ALTER TABLE play ADD collectif_id_id INT NOT NULL');
        $this->addSql('ALTER TABLE play ADD CONSTRAINT FK_5E89DEBA32A85379 FOREIGN KEY (collectif_id_id) REFERENCES collectif (id)');
        $this->addSql('CREATE INDEX IDX_5E89DEBA32A85379 ON play (collectif_id_id)');
    }
}
