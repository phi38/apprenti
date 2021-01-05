<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210105145413 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE cursus_followed_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE cursus_followed (id INT NOT NULL, user_id_id INT NOT NULL, cursus_id_id INT NOT NULL, start_date TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, end_date TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_74E0466D9D86650F ON cursus_followed (user_id_id)');
        $this->addSql('CREATE INDEX IDX_74E0466DED70AAB9 ON cursus_followed (cursus_id_id)');
        $this->addSql('COMMENT ON COLUMN cursus_followed.start_date IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('COMMENT ON COLUMN cursus_followed.end_date IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('ALTER TABLE cursus_followed ADD CONSTRAINT FK_74E0466D9D86650F FOREIGN KEY (user_id_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE cursus_followed ADD CONSTRAINT FK_74E0466DED70AAB9 FOREIGN KEY (cursus_id_id) REFERENCES cursus (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('DROP TABLE user_cursus');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE cursus_followed_id_seq CASCADE');
        $this->addSql('CREATE TABLE user_cursus (user_id INT NOT NULL, cursus_id INT NOT NULL, PRIMARY KEY(user_id, cursus_id))');
        $this->addSql('CREATE INDEX idx_6707bbfea76ed395 ON user_cursus (user_id)');
        $this->addSql('CREATE INDEX idx_6707bbfe40aef4b9 ON user_cursus (cursus_id)');
        $this->addSql('ALTER TABLE user_cursus ADD CONSTRAINT fk_6707bbfea76ed395 FOREIGN KEY (user_id) REFERENCES "user" (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE user_cursus ADD CONSTRAINT fk_6707bbfe40aef4b9 FOREIGN KEY (cursus_id) REFERENCES cursus (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('DROP TABLE cursus_followed');
    }
}
