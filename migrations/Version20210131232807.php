<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210131232807 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE emprunte_livre (emprunte_id INT NOT NULL, livre_id INT NOT NULL, INDEX IDX_F0D2A20165CF9DD4 (emprunte_id), INDEX IDX_F0D2A20137D925CB (livre_id), PRIMARY KEY(emprunte_id, livre_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE emprunte_livre ADD CONSTRAINT FK_F0D2A20165CF9DD4 FOREIGN KEY (emprunte_id) REFERENCES emprunte (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE emprunte_livre ADD CONSTRAINT FK_F0D2A20137D925CB FOREIGN KEY (livre_id) REFERENCES livre (id) ON DELETE CASCADE');
        $this->addSql('DROP TABLE livre_emprunte');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE livre_emprunte (livre_id INT NOT NULL, emprunte_id INT NOT NULL, INDEX IDX_9B909BF537D925CB (livre_id), INDEX IDX_9B909BF565CF9DD4 (emprunte_id), PRIMARY KEY(livre_id, emprunte_id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE livre_emprunte ADD CONSTRAINT FK_9B909BF537D925CB FOREIGN KEY (livre_id) REFERENCES livre (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE livre_emprunte ADD CONSTRAINT FK_9B909BF565CF9DD4 FOREIGN KEY (emprunte_id) REFERENCES emprunte (id) ON DELETE CASCADE');
        $this->addSql('DROP TABLE emprunte_livre');
    }
}
