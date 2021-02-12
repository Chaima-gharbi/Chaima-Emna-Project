<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201209144521 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE emprunte_livre (emprunte_id INT NOT NULL, livre_id INT NOT NULL, INDEX IDX_F0D2A20165CF9DD4 (emprunte_id), INDEX IDX_F0D2A20137D925CB (livre_id), PRIMARY KEY(emprunte_id, livre_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE emprunte_livre ADD CONSTRAINT FK_F0D2A20165CF9DD4 FOREIGN KEY (emprunte_id) REFERENCES emprunte (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE emprunte_livre ADD CONSTRAINT FK_F0D2A20137D925CB FOREIGN KEY (livre_id) REFERENCES livre (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE emprunte DROP FOREIGN KEY FK_F75B7D5C37D925CB');
        $this->addSql('DROP INDEX IDX_F75B7D5C37D925CB ON emprunte');
        $this->addSql('ALTER TABLE emprunte DROP livre_id');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE emprunte_livre');
        $this->addSql('DROP TABLE user');
        $this->addSql('ALTER TABLE emprunte ADD livre_id INT NOT NULL');
        $this->addSql('ALTER TABLE emprunte ADD CONSTRAINT FK_F75B7D5C37D925CB FOREIGN KEY (livre_id) REFERENCES livre (id)');
        $this->addSql('CREATE INDEX IDX_F75B7D5C37D925CB ON emprunte (livre_id)');
    }
}
