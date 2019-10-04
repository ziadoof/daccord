<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190927091622 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE driver (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, city_id INT NOT NULL, car_brand VARCHAR(255) NOT NULL, car_color VARCHAR(255) NOT NULL, car_image VARCHAR(255) NOT NULL, max_distance INT NOT NULL, point INT NOT NULL, active TINYINT(1) NOT NULL, gps_lat DOUBLE PRECISION NOT NULL, gps_lng DOUBLE PRECISION NOT NULL, feedback DOUBLE PRECISION DEFAULT NULL, UNIQUE INDEX UNIQ_11667CD9A76ED395 (user_id), INDEX IDX_11667CD98BAC62AF (city_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE driver ADD CONSTRAINT FK_11667CD9A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE driver ADD CONSTRAINT FK_11667CD98BAC62AF FOREIGN KEY (city_id) REFERENCES city (id)');
        $this->addSql('ALTER TABLE user DROP driver, DROP car, DROP color, DROP car_image');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE driver');
        $this->addSql('ALTER TABLE user ADD driver TINYINT(1) DEFAULT NULL, ADD car VARCHAR(40) DEFAULT NULL COLLATE utf8mb4_unicode_ci, ADD color VARCHAR(20) DEFAULT NULL COLLATE utf8mb4_unicode_ci, ADD car_image VARCHAR(255) DEFAULT NULL COLLATE utf8mb4_unicode_ci');
    }
}
