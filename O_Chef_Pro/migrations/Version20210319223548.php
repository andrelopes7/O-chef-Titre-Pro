<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210319223548 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE utilisateur_ingredient (utilisateur_id INT NOT NULL, ingredient_id INT NOT NULL, INDEX IDX_5917BA66FB88E14F (utilisateur_id), INDEX IDX_5917BA66933FE08C (ingredient_id), PRIMARY KEY(utilisateur_id, ingredient_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE utilisateur_diet (utilisateur_id INT NOT NULL, diet_id INT NOT NULL, INDEX IDX_5465091AFB88E14F (utilisateur_id), INDEX IDX_5465091AE1E13ACE (diet_id), PRIMARY KEY(utilisateur_id, diet_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE utilisateur_ingredient ADD CONSTRAINT FK_5917BA66FB88E14F FOREIGN KEY (utilisateur_id) REFERENCES utilisateur (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE utilisateur_ingredient ADD CONSTRAINT FK_5917BA66933FE08C FOREIGN KEY (ingredient_id) REFERENCES ingredient (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE utilisateur_diet ADD CONSTRAINT FK_5465091AFB88E14F FOREIGN KEY (utilisateur_id) REFERENCES utilisateur (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE utilisateur_diet ADD CONSTRAINT FK_5465091AE1E13ACE FOREIGN KEY (diet_id) REFERENCES diet (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE blog ADD utilisateur_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE blog ADD CONSTRAINT FK_C0155143FB88E14F FOREIGN KEY (utilisateur_id) REFERENCES utilisateur (id)');
        $this->addSql('CREATE INDEX IDX_C0155143FB88E14F ON blog (utilisateur_id)');
        $this->addSql('ALTER TABLE post ADD utilisateur_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE post ADD CONSTRAINT FK_5A8A6C8DFB88E14F FOREIGN KEY (utilisateur_id) REFERENCES utilisateur (id)');
        $this->addSql('CREATE INDEX IDX_5A8A6C8DFB88E14F ON post (utilisateur_id)');
        $this->addSql('ALTER TABLE recipe ADD utilisateur_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE recipe ADD CONSTRAINT FK_DA88B137FB88E14F FOREIGN KEY (utilisateur_id) REFERENCES utilisateur (id)');
        $this->addSql('CREATE INDEX IDX_DA88B137FB88E14F ON recipe (utilisateur_id)');
        $this->addSql('ALTER TABLE utilisateur ADD picture VARCHAR(255) NOT NULL, ADD friend VARCHAR(255) DEFAULT NULL, ADD last_login DATETIME DEFAULT NULL, ADD created_at DATETIME NOT NULL, ADD updated_at DATETIME NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE utilisateur_ingredient');
        $this->addSql('DROP TABLE utilisateur_diet');
        $this->addSql('ALTER TABLE blog DROP FOREIGN KEY FK_C0155143FB88E14F');
        $this->addSql('DROP INDEX IDX_C0155143FB88E14F ON blog');
        $this->addSql('ALTER TABLE blog DROP utilisateur_id');
        $this->addSql('ALTER TABLE post DROP FOREIGN KEY FK_5A8A6C8DFB88E14F');
        $this->addSql('DROP INDEX IDX_5A8A6C8DFB88E14F ON post');
        $this->addSql('ALTER TABLE post DROP utilisateur_id');
        $this->addSql('ALTER TABLE recipe DROP FOREIGN KEY FK_DA88B137FB88E14F');
        $this->addSql('DROP INDEX IDX_DA88B137FB88E14F ON recipe');
        $this->addSql('ALTER TABLE recipe DROP utilisateur_id');
        $this->addSql('ALTER TABLE utilisateur DROP picture, DROP friend, DROP last_login, DROP created_at, DROP updated_at');
    }
}
