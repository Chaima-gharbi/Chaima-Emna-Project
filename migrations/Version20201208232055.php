<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201208232055 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE abonnee (id INT AUTO_INCREMENT NOT NULL, prenom VARCHAR(50) NOT NULL, nom VARCHAR(50) NOT NULL, email VARCHAR(200) NOT NULL, mot_de_passe VARCHAR(200) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE emprunte (id INT AUTO_INCREMENT NOT NULL, abonne_id INT NOT NULL, livre_id INT NOT NULL, INDEX IDX_F75B7D5CC325A696 (abonne_id), INDEX IDX_F75B7D5C37D925CB (livre_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE emprunte ADD CONSTRAINT FK_F75B7D5CC325A696 FOREIGN KEY (abonne_id) REFERENCES abonnee (id)');
        $this->addSql('ALTER TABLE emprunte ADD CONSTRAINT FK_F75B7D5C37D925CB FOREIGN KEY (livre_id) REFERENCES livre (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE emprunte DROP FOREIGN KEY FK_F75B7D5CC325A696');
        $this->addSql('DROP TABLE abonnee');
        $this->addSql('DROP TABLE emprunte');
    }
}
