<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190417132722 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE events (id INT AUTO_INCREMENT NOT NULL, user_event_id INT NOT NULL, name VARCHAR(200) NOT NULL, start_date DATETIME NOT NULL, end_date DATETIME NOT NULL, country LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:array)\', logo VARCHAR(255) DEFAULT NULL, banner VARCHAR(255) DEFAULT NULL, language LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:array)\', location VARCHAR(500) DEFAULT NULL, description VARCHAR(1000) DEFAULT NULL, budget DOUBLE PRECISION DEFAULT NULL, owner_name VARCHAR(255) NOT NULL, owner_mail VARCHAR(255) NOT NULL, active TINYINT(1) NOT NULL, currency VARCHAR(255) DEFAULT NULL, INDEX IDX_5387574A917A0C8B (user_event_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE events ADD CONSTRAINT FK_5387574A917A0C8B FOREIGN KEY (user_event_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE user CHANGE roles roles JSON NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE events');
        $this->addSql('ALTER TABLE user CHANGE roles roles LONGTEXT NOT NULL COLLATE utf8mb4_bin');
    }
}
