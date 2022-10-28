<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220821074356 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE partner (id INT AUTO_INCREMENT NOT NULL, technical_team_id_id INT NOT NULL, name VARCHAR(100) NOT NULL, email VARCHAR(100) NOT NULL, password VARCHAR(255) NOT NULL, address VARCHAR(255) NOT NULL, active TINYINT(1) NOT NULL, description LONGTEXT NOT NULL, sell_food TINYINT(1) NOT NULL, sell_drink TINYINT(1) NOT NULL, send_newsletter TINYINT(1) NOT NULL, schedule_management TINYINT(1) NOT NULL, private_lesson TINYINT(1) NOT NULL, INDEX IDX_312B3E16D0C4064B (technical_team_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE structure (id INT AUTO_INCREMENT NOT NULL, technical_team_id_id INT NOT NULL, partner_id_id INT NOT NULL, name VARCHAR(100) NOT NULL, manager_firstname VARCHAR(20) NOT NULL, manager_lastname VARCHAR(20) NOT NULL, email VARCHAR(100) NOT NULL, password VARCHAR(255) NOT NULL, address VARCHAR(255) NOT NULL, active TINYINT(1) NOT NULL, sell_food TINYINT(1) NOT NULL, sell_drink TINYINT(1) NOT NULL, send_newsletter TINYINT(1) NOT NULL, schedule_management TINYINT(1) NOT NULL, private_lesson TINYINT(1) NOT NULL, INDEX IDX_6F0137EAD0C4064B (technical_team_id_id), INDEX IDX_6F0137EA6C783232 (partner_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE partner ADD CONSTRAINT FK_312B3E16D0C4064B FOREIGN KEY (technical_team_id_id) REFERENCES technical_team (id)');
        $this->addSql('ALTER TABLE structure ADD CONSTRAINT FK_6F0137EAD0C4064B FOREIGN KEY (technical_team_id_id) REFERENCES technical_team (id)');
        $this->addSql('ALTER TABLE structure ADD CONSTRAINT FK_6F0137EA6C783232 FOREIGN KEY (partner_id_id) REFERENCES partner (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE partner DROP FOREIGN KEY FK_312B3E16D0C4064B');
        $this->addSql('ALTER TABLE structure DROP FOREIGN KEY FK_6F0137EAD0C4064B');
        $this->addSql('ALTER TABLE structure DROP FOREIGN KEY FK_6F0137EA6C783232');
        $this->addSql('DROP TABLE partner');
        $this->addSql('DROP TABLE structure');
    }
}
