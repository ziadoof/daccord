<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200113203803 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE voyage (id INT AUTO_INCREMENT NOT NULL, creator_id INT NOT NULL, departure_id INT NOT NULL, arrival_id INT NOT NULL, date DATE NOT NULL, time TIME NOT NULL, highway TINYINT(1) DEFAULT NULL, price DOUBLE PRECISION NOT NULL, INDEX IDX_3F9D895561220EA6 (creator_id), INDEX IDX_3F9D89557704ED06 (departure_id), INDEX IDX_3F9D895562789708 (arrival_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE voyage_user (voyage_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_1D011EC768C9E5AF (voyage_id), INDEX IDX_1D011EC7A76ED395 (user_id), PRIMARY KEY(voyage_id, user_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE voyage_request (id INT AUTO_INCREMENT NOT NULL, voyage_id INT NOT NULL, sender_id INT NOT NULL, status VARCHAR(255) NOT NULL, description LONGTEXT DEFAULT NULL, INDEX IDX_CD1E16AB68C9E5AF (voyage_id), INDEX IDX_CD1E16ABF624B39D (sender_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE station (id INT AUTO_INCREMENT NOT NULL, voyage_id INT NOT NULL, city_id INT NOT NULL, duration TIME NOT NULL, sort INT NOT NULL, INDEX IDX_9F39F8B168C9E5AF (voyage_id), INDEX IDX_9F39F8B18BAC62AF (city_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE departures_city (station_id INT NOT NULL, city_id INT NOT NULL, INDEX IDX_F125D97821BDB235 (station_id), INDEX IDX_F125D9788BAC62AF (city_id), PRIMARY KEY(station_id, city_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE arrivals_city (station_id INT NOT NULL, city_id INT NOT NULL, INDEX IDX_77D8580C21BDB235 (station_id), INDEX IDX_77D8580C8BAC62AF (city_id), PRIMARY KEY(station_id, city_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE voyage ADD CONSTRAINT FK_3F9D895561220EA6 FOREIGN KEY (creator_id) REFERENCES carpool (id)');
        $this->addSql('ALTER TABLE voyage ADD CONSTRAINT FK_3F9D89557704ED06 FOREIGN KEY (departure_id) REFERENCES city (id)');
        $this->addSql('ALTER TABLE voyage ADD CONSTRAINT FK_3F9D895562789708 FOREIGN KEY (arrival_id) REFERENCES city (id)');
        $this->addSql('ALTER TABLE voyage_user ADD CONSTRAINT FK_1D011EC768C9E5AF FOREIGN KEY (voyage_id) REFERENCES voyage (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE voyage_user ADD CONSTRAINT FK_1D011EC7A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE voyage_request ADD CONSTRAINT FK_CD1E16AB68C9E5AF FOREIGN KEY (voyage_id) REFERENCES voyage (id)');
        $this->addSql('ALTER TABLE voyage_request ADD CONSTRAINT FK_CD1E16ABF624B39D FOREIGN KEY (sender_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE station ADD CONSTRAINT FK_9F39F8B168C9E5AF FOREIGN KEY (voyage_id) REFERENCES voyage (id)');
        $this->addSql('ALTER TABLE station ADD CONSTRAINT FK_9F39F8B18BAC62AF FOREIGN KEY (city_id) REFERENCES city (id)');
        $this->addSql('ALTER TABLE departures_city ADD CONSTRAINT FK_F125D97821BDB235 FOREIGN KEY (station_id) REFERENCES station (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE departures_city ADD CONSTRAINT FK_F125D9788BAC62AF FOREIGN KEY (city_id) REFERENCES city (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE arrivals_city ADD CONSTRAINT FK_77D8580C21BDB235 FOREIGN KEY (station_id) REFERENCES station (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE arrivals_city ADD CONSTRAINT FK_77D8580C8BAC62AF FOREIGN KEY (city_id) REFERENCES city (id) ON DELETE CASCADE');
        $this->addSql('DROP TABLE sessions');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE voyage_user DROP FOREIGN KEY FK_1D011EC768C9E5AF');
        $this->addSql('ALTER TABLE voyage_request DROP FOREIGN KEY FK_CD1E16AB68C9E5AF');
        $this->addSql('ALTER TABLE station DROP FOREIGN KEY FK_9F39F8B168C9E5AF');
        $this->addSql('ALTER TABLE departures_city DROP FOREIGN KEY FK_F125D97821BDB235');
        $this->addSql('ALTER TABLE arrivals_city DROP FOREIGN KEY FK_77D8580C21BDB235');
        $this->addSql('CREATE TABLE sessions (sess_id VARCHAR(128) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_bin`, sess_data BLOB NOT NULL, sess_time INT UNSIGNED NOT NULL, sess_lifetime INT NOT NULL, PRIMARY KEY(sess_id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('DROP TABLE voyage');
        $this->addSql('DROP TABLE voyage_user');
        $this->addSql('DROP TABLE voyage_request');
        $this->addSql('DROP TABLE station');
        $this->addSql('DROP TABLE departures_city');
        $this->addSql('DROP TABLE arrivals_city');
    }
}
