<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191008111014 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE driver_request (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, driver_id INT NOT NULL, deal_id INT NOT NULL, date DATETIME NOT NULL, status VARCHAR(255) NOT NULL, price DOUBLE PRECISION DEFAULT NULL, INDEX IDX_FE68EBFFA76ED395 (user_id), INDEX IDX_FE68EBFFC3423909 (driver_id), INDEX IDX_FE68EBFFF60E2305 (deal_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE driver_request ADD CONSTRAINT FK_FE68EBFFA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE driver_request ADD CONSTRAINT FK_FE68EBFFC3423909 FOREIGN KEY (driver_id) REFERENCES driver (id)');
        $this->addSql('ALTER TABLE driver_request ADD CONSTRAINT FK_FE68EBFFF60E2305 FOREIGN KEY (deal_id) REFERENCES deal (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE driver_request');
    }
}
