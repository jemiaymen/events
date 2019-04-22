<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190418105337 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE attendees (id INT AUTO_INCREMENT NOT NULL, type_id INT DEFAULT NULL, event_id INT DEFAULT NULL, first_name VARCHAR(255) NOT NULL, last_name VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, company VARCHAR(255) DEFAULT NULL, tel VARCHAR(90) DEFAULT NULL, country VARCHAR(255) DEFAULT NULL, job VARCHAR(255) DEFAULT NULL, photo VARCHAR(1000) DEFAULT NULL, checked_in TINYINT(1) NOT NULL, INDEX IDX_C8C96B25C54C8C93 (type_id), INDEX IDX_C8C96B2571F7E88B (event_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE attendees ADD CONSTRAINT FK_C8C96B25C54C8C93 FOREIGN KEY (type_id) REFERENCES attendee_types (id)');
        $this->addSql('ALTER TABLE attendees ADD CONSTRAINT FK_C8C96B2571F7E88B FOREIGN KEY (event_id) REFERENCES events (id)');
        $this->addSql('ALTER TABLE events CHANGE country country VARCHAR(255) DEFAULT NULL, CHANGE logo logo VARCHAR(500) DEFAULT NULL, CHANGE banner banner VARCHAR(500) DEFAULT NULL, CHANGE language language VARCHAR(255) DEFAULT NULL, CHANGE location location VARCHAR(500) DEFAULT NULL, CHANGE description description VARCHAR(1000) DEFAULT NULL, CHANGE budget budget DOUBLE PRECISION DEFAULT NULL, CHANGE currency currency VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE user CHANGE roles roles JSON NOT NULL');
        $this->addSql('ALTER TABLE attendee_types CHANGE min_workshops min_workshops SMALLINT DEFAULT NULL, CHANGE max_workshops max_workshops SMALLINT DEFAULT NULL, CHANGE description description VARCHAR(1000) DEFAULT NULL, CHANGE allow_public_registration allow_public_registration TINYINT(1) DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE attendees');
        $this->addSql('ALTER TABLE attendee_types CHANGE min_workshops min_workshops SMALLINT DEFAULT NULL, CHANGE max_workshops max_workshops SMALLINT DEFAULT NULL, CHANGE description description VARCHAR(1000) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci, CHANGE allow_public_registration allow_public_registration TINYINT(1) DEFAULT \'NULL\'');
        $this->addSql('ALTER TABLE events CHANGE country country VARCHAR(255) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci, CHANGE logo logo VARCHAR(500) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci, CHANGE banner banner VARCHAR(500) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci, CHANGE language language VARCHAR(255) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci, CHANGE location location VARCHAR(500) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci, CHANGE description description VARCHAR(1000) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci, CHANGE budget budget DOUBLE PRECISION DEFAULT \'NULL\', CHANGE currency currency VARCHAR(255) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci');
        $this->addSql('ALTER TABLE user CHANGE roles roles LONGTEXT NOT NULL COLLATE utf8mb4_bin');
    }
}
