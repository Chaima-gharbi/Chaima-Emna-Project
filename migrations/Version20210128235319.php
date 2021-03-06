<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210128235319 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE emprunte_livre');
        $this->addSql('DROP TABLE emprunte_user');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE emprunte_livre (emprunte_id INT NOT NULL, livre_id INT NOT NULL, INDEX IDX_F0D2A20165CF9DD4 (emprunte_id), INDEX IDX_F0D2A20137D925CB (livre_id), PRIMARY KEY(emprunte_id, livre_id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE emprunte_user (emprunte_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_8F144AF265CF9DD4 (emprunte_id), INDEX IDX_8F144AF2A76ED395 (user_id), PRIMARY KEY(emprunte_id, user_id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE emprunte_livre ADD CONSTRAINT FK_F0D2A20137D925CB FOREIGN KEY (livre_id) REFERENCES livre (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE emprunte_livre ADD CONSTRAINT FK_F0D2A20165CF9DD4 FOREIGN KEY (emprunte_id) REFERENCES emprunte (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE emprunte_user ADD CONSTRAINT FK_8F144AF265CF9DD4 FOREIGN KEY (emprunte_id) REFERENCES emprunte (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE emprunte_user ADD CONSTRAINT FK_8F144AF2A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
    }
}
