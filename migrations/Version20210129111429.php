<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210129111429 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE emprunte (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, date_retour DATE NOT NULL, date_emprunte DATE NOT NULL, INDEX IDX_F75B7D5CA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE emprunte_livre (emprunte_id INT NOT NULL, livre_id INT NOT NULL, INDEX IDX_F0D2A20165CF9DD4 (emprunte_id), INDEX IDX_F0D2A20137D925CB (livre_id), PRIMARY KEY(emprunte_id, livre_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE emprunte ADD CONSTRAINT FK_F75B7D5CA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE emprunte_livre ADD CONSTRAINT FK_F0D2A20165CF9DD4 FOREIGN KEY (emprunte_id) REFERENCES emprunte (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE emprunte_livre ADD CONSTRAINT FK_F0D2A20137D925CB FOREIGN KEY (livre_id) REFERENCES livre (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE emprunte_livre DROP FOREIGN KEY FK_F0D2A20165CF9DD4');
        $this->addSql('DROP TABLE emprunte');
        $this->addSql('DROP TABLE emprunte_livre');
    }
}
