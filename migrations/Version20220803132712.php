<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220803132712 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE artist ADD collectif_id_id INT NOT NULL, ADD is_former TINYINT(1) NOT NULL');
        $this->addSql('ALTER TABLE artist ADD CONSTRAINT FK_159968732A85379 FOREIGN KEY (collectif_id_id) REFERENCES collectif (id)');
        $this->addSql('CREATE INDEX IDX_159968732A85379 ON artist (collectif_id_id)');
        $this->addSql('ALTER TABLE date ADD play_id_id INT NOT NULL');
        $this->addSql('ALTER TABLE date ADD CONSTRAINT FK_AA9E377A8E9B79EB FOREIGN KEY (play_id_id) REFERENCES play (id)');
        $this->addSql('CREATE INDEX IDX_AA9E377A8E9B79EB ON date (play_id_id)');
        $this->addSql('ALTER TABLE play ADD collectif_id_id INT NOT NULL, ADD image_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE play ADD CONSTRAINT FK_5E89DEBA32A85379 FOREIGN KEY (collectif_id_id) REFERENCES collectif (id)');
        $this->addSql('ALTER TABLE play ADD CONSTRAINT FK_5E89DEBA3DA5256D FOREIGN KEY (image_id) REFERENCES picture (id)');
        $this->addSql('CREATE INDEX IDX_5E89DEBA32A85379 ON play (collectif_id_id)');
        $this->addSql('CREATE INDEX IDX_5E89DEBA3DA5256D ON play (image_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE artist DROP FOREIGN KEY FK_159968732A85379');
        $this->addSql('DROP INDEX IDX_159968732A85379 ON artist');
        $this->addSql('ALTER TABLE artist DROP collectif_id_id, DROP is_former');
        $this->addSql('ALTER TABLE date DROP FOREIGN KEY FK_AA9E377A8E9B79EB');
        $this->addSql('DROP INDEX IDX_AA9E377A8E9B79EB ON date');
        $this->addSql('ALTER TABLE date DROP play_id_id');
        $this->addSql('ALTER TABLE play DROP FOREIGN KEY FK_5E89DEBA32A85379');
        $this->addSql('ALTER TABLE play DROP FOREIGN KEY FK_5E89DEBA3DA5256D');
        $this->addSql('DROP INDEX IDX_5E89DEBA32A85379 ON play');
        $this->addSql('DROP INDEX IDX_5E89DEBA3DA5256D ON play');
        $this->addSql('ALTER TABLE play DROP collectif_id_id, DROP image_id');
    }
}
