<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210106134521 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE cursus_content DROP CONSTRAINT fk_1f8c884aed70aab9');
        $this->addSql('ALTER TABLE cursus_content DROP CONSTRAINT fk_1f8c884a4f221781');
        $this->addSql('DROP INDEX idx_1f8c884a4f221781');
        $this->addSql('DROP INDEX idx_1f8c884aed70aab9');
        $this->addSql('ALTER TABLE cursus_content ADD cursus_id INT NOT NULL');
        $this->addSql('ALTER TABLE cursus_content ADD cours_id INT NOT NULL');
        $this->addSql('ALTER TABLE cursus_content DROP cursus_id_id');
        $this->addSql('ALTER TABLE cursus_content DROP cours_id_id');
        $this->addSql('ALTER TABLE cursus_content ADD CONSTRAINT FK_1F8C884A40AEF4B9 FOREIGN KEY (cursus_id) REFERENCES cursus (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE cursus_content ADD CONSTRAINT FK_1F8C884A7ECF78B0 FOREIGN KEY (cours_id) REFERENCES cours (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_1F8C884A40AEF4B9 ON cursus_content (cursus_id)');
        $this->addSql('CREATE INDEX IDX_1F8C884A7ECF78B0 ON cursus_content (cours_id)');
        $this->addSql('ALTER TABLE cursus_followed DROP CONSTRAINT fk_74e0466d9d86650f');
        $this->addSql('ALTER TABLE cursus_followed DROP CONSTRAINT fk_74e0466ded70aab9');
        $this->addSql('DROP INDEX idx_74e0466d9d86650f');
        $this->addSql('DROP INDEX idx_74e0466ded70aab9');
        $this->addSql('ALTER TABLE cursus_followed ADD user_id INT NOT NULL');
        $this->addSql('ALTER TABLE cursus_followed ADD cursus_id INT NOT NULL');
        $this->addSql('ALTER TABLE cursus_followed DROP user_id_id');
        $this->addSql('ALTER TABLE cursus_followed DROP cursus_id_id');
        $this->addSql('ALTER TABLE cursus_followed ADD CONSTRAINT FK_74E0466DA76ED395 FOREIGN KEY (user_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE cursus_followed ADD CONSTRAINT FK_74E0466D40AEF4B9 FOREIGN KEY (cursus_id) REFERENCES cursus (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_74E0466DA76ED395 ON cursus_followed (user_id)');
        $this->addSql('CREATE INDEX IDX_74E0466D40AEF4B9 ON cursus_followed (cursus_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE cursus_followed DROP CONSTRAINT FK_74E0466DA76ED395');
        $this->addSql('ALTER TABLE cursus_followed DROP CONSTRAINT FK_74E0466D40AEF4B9');
        $this->addSql('DROP INDEX IDX_74E0466DA76ED395');
        $this->addSql('DROP INDEX IDX_74E0466D40AEF4B9');
        $this->addSql('ALTER TABLE cursus_followed ADD user_id_id INT NOT NULL');
        $this->addSql('ALTER TABLE cursus_followed ADD cursus_id_id INT NOT NULL');
        $this->addSql('ALTER TABLE cursus_followed DROP user_id');
        $this->addSql('ALTER TABLE cursus_followed DROP cursus_id');
        $this->addSql('ALTER TABLE cursus_followed ADD CONSTRAINT fk_74e0466d9d86650f FOREIGN KEY (user_id_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE cursus_followed ADD CONSTRAINT fk_74e0466ded70aab9 FOREIGN KEY (cursus_id_id) REFERENCES cursus (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX idx_74e0466d9d86650f ON cursus_followed (user_id_id)');
        $this->addSql('CREATE INDEX idx_74e0466ded70aab9 ON cursus_followed (cursus_id_id)');
        $this->addSql('ALTER TABLE cursus_content DROP CONSTRAINT FK_1F8C884A40AEF4B9');
        $this->addSql('ALTER TABLE cursus_content DROP CONSTRAINT FK_1F8C884A7ECF78B0');
        $this->addSql('DROP INDEX IDX_1F8C884A40AEF4B9');
        $this->addSql('DROP INDEX IDX_1F8C884A7ECF78B0');
        $this->addSql('ALTER TABLE cursus_content ADD cursus_id_id INT NOT NULL');
        $this->addSql('ALTER TABLE cursus_content ADD cours_id_id INT NOT NULL');
        $this->addSql('ALTER TABLE cursus_content DROP cursus_id');
        $this->addSql('ALTER TABLE cursus_content DROP cours_id');
        $this->addSql('ALTER TABLE cursus_content ADD CONSTRAINT fk_1f8c884aed70aab9 FOREIGN KEY (cursus_id_id) REFERENCES cursus (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE cursus_content ADD CONSTRAINT fk_1f8c884a4f221781 FOREIGN KEY (cours_id_id) REFERENCES cours (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX idx_1f8c884a4f221781 ON cursus_content (cours_id_id)');
        $this->addSql('CREATE INDEX idx_1f8c884aed70aab9 ON cursus_content (cursus_id_id)');
    }
}
