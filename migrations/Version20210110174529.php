<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210110174529 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE cours_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE cursus_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE cursus_content_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE cursus_followed_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE "group_id_seq" INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE profil_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE reset_password_request_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE "user_id_seq" INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE cours (id INT NOT NULL, title VARCHAR(255) NOT NULL, subtitle VARCHAR(255) DEFAULT NULL, level INT NOT NULL, theme VARCHAR(255) DEFAULT NULL, type INT NOT NULL, content JSON NOT NULL, lastupdate TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, description VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('COMMENT ON COLUMN cours.lastupdate IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('CREATE TABLE cursus (id INT NOT NULL, title VARCHAR(100) NOT NULL, description VARCHAR(255) NOT NULL, level INT NOT NULL, rights INT NOT NULL, points INT NOT NULL, lastupdate TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, theme VARCHAR(255) DEFAULT NULL, subtitle VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('COMMENT ON COLUMN cursus.lastupdate IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('CREATE TABLE cursus_content (id INT NOT NULL, cursus_id INT NOT NULL, cours_id INT NOT NULL, position INT DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_1F8C884A40AEF4B9 ON cursus_content (cursus_id)');
        $this->addSql('CREATE INDEX IDX_1F8C884A7ECF78B0 ON cursus_content (cours_id)');
        $this->addSql('CREATE TABLE cursus_followed (id INT NOT NULL, profil_id INT NOT NULL, cursus_id INT NOT NULL, start_date TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, end_date TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_74E0466D275ED078 ON cursus_followed (profil_id)');
        $this->addSql('CREATE INDEX IDX_74E0466D40AEF4B9 ON cursus_followed (cursus_id)');
        $this->addSql('COMMENT ON COLUMN cursus_followed.start_date IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('COMMENT ON COLUMN cursus_followed.end_date IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('CREATE TABLE "group" (id INT NOT NULL, name VARCHAR(255) NOT NULL, theme VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE profil (id INT NOT NULL, owner_id INT NOT NULL, pseudo VARCHAR(60) DEFAULT NULL, level INT DEFAULT NULL, postal_code VARCHAR(8) DEFAULT NULL, equipment TEXT DEFAULT NULL, description TEXT DEFAULT NULL, objectif TEXT DEFAULT NULL, objectif_list TEXT DEFAULT NULL, lastupdate TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_E6D6B2977E3C61F9 ON profil (owner_id)');
        $this->addSql('COMMENT ON COLUMN profil.objectif_list IS \'(DC2Type:simple_array)\'');
        $this->addSql('COMMENT ON COLUMN profil.lastupdate IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('CREATE TABLE reset_password_request (id INT NOT NULL, user_id INT NOT NULL, selector VARCHAR(20) NOT NULL, hashed_token VARCHAR(100) NOT NULL, requested_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, expires_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_7CE748AA76ED395 ON reset_password_request (user_id)');
        $this->addSql('COMMENT ON COLUMN reset_password_request.requested_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('COMMENT ON COLUMN reset_password_request.expires_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('CREATE TABLE "user" (id INT NOT NULL, username VARCHAR(25) NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, is_verified BOOLEAN NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649F85E0677 ON "user" (username)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649E7927C74 ON "user" (email)');
        $this->addSql('ALTER TABLE cursus_content ADD CONSTRAINT FK_1F8C884A40AEF4B9 FOREIGN KEY (cursus_id) REFERENCES cursus (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE cursus_content ADD CONSTRAINT FK_1F8C884A7ECF78B0 FOREIGN KEY (cours_id) REFERENCES cours (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE cursus_followed ADD CONSTRAINT FK_74E0466D275ED078 FOREIGN KEY (profil_id) REFERENCES profil (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE cursus_followed ADD CONSTRAINT FK_74E0466D40AEF4B9 FOREIGN KEY (cursus_id) REFERENCES cursus (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE profil ADD CONSTRAINT FK_E6D6B2977E3C61F9 FOREIGN KEY (owner_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE reset_password_request ADD CONSTRAINT FK_7CE748AA76ED395 FOREIGN KEY (user_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE cursus_content DROP CONSTRAINT FK_1F8C884A7ECF78B0');
        $this->addSql('ALTER TABLE cursus_content DROP CONSTRAINT FK_1F8C884A40AEF4B9');
        $this->addSql('ALTER TABLE cursus_followed DROP CONSTRAINT FK_74E0466D40AEF4B9');
        $this->addSql('ALTER TABLE cursus_followed DROP CONSTRAINT FK_74E0466D275ED078');
        $this->addSql('ALTER TABLE profil DROP CONSTRAINT FK_E6D6B2977E3C61F9');
        $this->addSql('ALTER TABLE reset_password_request DROP CONSTRAINT FK_7CE748AA76ED395');
        $this->addSql('DROP SEQUENCE cours_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE cursus_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE cursus_content_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE cursus_followed_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE "group_id_seq" CASCADE');
        $this->addSql('DROP SEQUENCE profil_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE reset_password_request_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE "user_id_seq" CASCADE');
        $this->addSql('DROP TABLE cours');
        $this->addSql('DROP TABLE cursus');
        $this->addSql('DROP TABLE cursus_content');
        $this->addSql('DROP TABLE cursus_followed');
        $this->addSql('DROP TABLE "group"');
        $this->addSql('DROP TABLE profil');
        $this->addSql('DROP TABLE reset_password_request');
        $this->addSql('DROP TABLE "user"');
    }
}
