<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190418102725 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE attendee_types (id INT AUTO_INCREMENT NOT NULL, type_event_id INT NOT NULL, name VARCHAR(255) NOT NULL, price DOUBLE PRECISION NOT NULL, attendee_limit SMALLINT NOT NULL, min_workshops SMALLINT DEFAULT NULL, max_workshops SMALLINT DEFAULT NULL, description VARCHAR(1000) DEFAULT NULL, allow_edit TINYINT(1) NOT NULL, allow_public_registration TINYINT(1) DEFAULT NULL, INDEX IDX_51056C82BC08CF77 (type_event_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE attendee_types ADD CONSTRAINT FK_51056C82BC08CF77 FOREIGN KEY (type_event_id) REFERENCES events (id)');
        $this->addSql('ALTER TABLE events CHANGE country country VARCHAR(255) DEFAULT NULL, CHANGE logo logo VARCHAR(500) DEFAULT NULL, CHANGE banner banner VARCHAR(500) DEFAULT NULL, CHANGE language language VARCHAR(255) DEFAULT NULL, CHANGE location location VARCHAR(500) DEFAULT NULL, CHANGE description description VARCHAR(1000) DEFAULT NULL, CHANGE budget budget DOUBLE PRECISION DEFAULT NULL, CHANGE currency currency VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE user CHANGE roles roles JSON NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE attendee_types');
        $this->addSql('ALTER TABLE events CHANGE country country VARCHAR(255) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci, CHANGE logo logo VARCHAR(255) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci, CHANGE banner banner VARCHAR(255) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci, CHANGE language language VARCHAR(255) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci, CHANGE location location VARCHAR(500) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci, CHANGE description description VARCHAR(1000) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci, CHANGE budget budget DOUBLE PRECISION DEFAULT \'NULL\', CHANGE currency currency VARCHAR(255) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci');
        $this->addSql('ALTER TABLE user CHANGE roles roles LONGTEXT NOT NULL COLLATE utf8mb4_bin');
    }
}
