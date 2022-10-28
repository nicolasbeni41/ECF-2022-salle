<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221028212446 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE contact_form (id INT AUTO_INCREMENT NOT NULL, structure_id_id INT DEFAULT NULL, partner_id_id INT DEFAULT NULL, technical_team_id_id INT DEFAULT NULL, title VARCHAR(100) NOT NULL, content LONGTEXT NOT NULL, INDEX IDX_7A777FB0AA95C5C1 (structure_id_id), INDEX IDX_7A777FB06C783232 (partner_id_id), INDEX IDX_7A777FB0D0C4064B (technical_team_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE partner (id INT AUTO_INCREMENT NOT NULL, technical_team_id_id INT NOT NULL, name VARCHAR(100) NOT NULL, email VARCHAR(100) NOT NULL, password VARCHAR(255) NOT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', address VARCHAR(255) NOT NULL, active TINYINT(1) NOT NULL, description LONGTEXT NOT NULL, sell_food TINYINT(1) NOT NULL, sell_drink TINYINT(1) NOT NULL, send_newsletter TINYINT(1) NOT NULL, schedule_management TINYINT(1) NOT NULL, private_lesson TINYINT(1) NOT NULL, INDEX IDX_312B3E16D0C4064B (technical_team_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE structure (id INT AUTO_INCREMENT NOT NULL, technical_team_id_id INT NOT NULL, partner_id_id INT NOT NULL, name VARCHAR(100) NOT NULL, manager_firstname VARCHAR(20) NOT NULL, manager_lastname VARCHAR(20) NOT NULL, email VARCHAR(100) NOT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', password VARCHAR(255) NOT NULL, address VARCHAR(255) NOT NULL, active TINYINT(1) NOT NULL, sell_food TINYINT(1) NOT NULL, sell_drink TINYINT(1) NOT NULL, send_newsletter TINYINT(1) NOT NULL, schedule_management TINYINT(1) NOT NULL, private_lesson TINYINT(1) NOT NULL, INDEX IDX_6F0137EAD0C4064B (technical_team_id_id), INDEX IDX_6F0137EA6C783232 (partner_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE technical_team (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', password VARCHAR(255) NOT NULL, firstname VARCHAR(20) DEFAULT NULL, lastname VARCHAR(20) DEFAULT NULL, UNIQUE INDEX UNIQ_E8E5E85CE7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE contact_form ADD CONSTRAINT FK_7A777FB0AA95C5C1 FOREIGN KEY (structure_id_id) REFERENCES structure (id)');
        $this->addSql('ALTER TABLE contact_form ADD CONSTRAINT FK_7A777FB06C783232 FOREIGN KEY (partner_id_id) REFERENCES partner (id)');
        $this->addSql('ALTER TABLE contact_form ADD CONSTRAINT FK_7A777FB0D0C4064B FOREIGN KEY (technical_team_id_id) REFERENCES technical_team (id)');
        $this->addSql('ALTER TABLE partner ADD CONSTRAINT FK_312B3E16D0C4064B FOREIGN KEY (technical_team_id_id) REFERENCES technical_team (id)');
        $this->addSql('ALTER TABLE structure ADD CONSTRAINT FK_6F0137EAD0C4064B FOREIGN KEY (technical_team_id_id) REFERENCES technical_team (id)');
        $this->addSql('ALTER TABLE structure ADD CONSTRAINT FK_6F0137EA6C783232 FOREIGN KEY (partner_id_id) REFERENCES partner (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE contact_form DROP FOREIGN KEY FK_7A777FB0AA95C5C1');
        $this->addSql('ALTER TABLE contact_form DROP FOREIGN KEY FK_7A777FB06C783232');
        $this->addSql('ALTER TABLE contact_form DROP FOREIGN KEY FK_7A777FB0D0C4064B');
        $this->addSql('ALTER TABLE partner DROP FOREIGN KEY FK_312B3E16D0C4064B');
        $this->addSql('ALTER TABLE structure DROP FOREIGN KEY FK_6F0137EAD0C4064B');
        $this->addSql('ALTER TABLE structure DROP FOREIGN KEY FK_6F0137EA6C783232');
        $this->addSql('DROP TABLE contact_form');
        $this->addSql('DROP TABLE partner');
        $this->addSql('DROP TABLE structure');
        $this->addSql('DROP TABLE technical_team');
    }
}
