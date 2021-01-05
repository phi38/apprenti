<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210105161037 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE cursus_content_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE cursus_content (id INT NOT NULL, cursus_id_id INT NOT NULL, cours_id_id INT NOT NULL, position INT DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_1F8C884AED70AAB9 ON cursus_content (cursus_id_id)');
        $this->addSql('CREATE INDEX IDX_1F8C884A4F221781 ON cursus_content (cours_id_id)');
        $this->addSql('ALTER TABLE cursus_content ADD CONSTRAINT FK_1F8C884AED70AAB9 FOREIGN KEY (cursus_id_id) REFERENCES cursus (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE cursus_content ADD CONSTRAINT FK_1F8C884A4F221781 FOREIGN KEY (cours_id_id) REFERENCES cours (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE cursus_content_id_seq CASCADE');
        $this->addSql('DROP TABLE cursus_content');
    }
}
