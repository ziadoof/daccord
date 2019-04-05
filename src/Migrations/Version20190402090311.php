<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190402090311 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE sdspecification (id INT AUTO_INCREMENT NOT NULL, category_id INT NOT NULL, name VARCHAR(255) NOT NULL, label VARCHAR(255) NOT NULL, type VARCHAR(255) NOT NULL, text_options LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:array)\', numeric_options LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:array)\', type_of_choice VARCHAR(255) DEFAULT NULL, min_option INT DEFAULT NULL, max_option INT DEFAULT NULL, INDEX IDX_54C8EF1812469DE2 (category_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE sospecification (id INT AUTO_INCREMENT NOT NULL, category_id INT NOT NULL, name VARCHAR(255) NOT NULL, label VARCHAR(255) NOT NULL, type VARCHAR(255) NOT NULL, text_options LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:array)\', numeric_options LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:array)\', type_of_choice VARCHAR(255) DEFAULT NULL, min_option INT DEFAULT NULL, max_option INT DEFAULT NULL, INDEX IDX_1BF0D4F512469DE2 (category_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE sdspecification ADD CONSTRAINT FK_54C8EF1812469DE2 FOREIGN KEY (category_id) REFERENCES category (id)');
        $this->addSql('ALTER TABLE sospecification ADD CONSTRAINT FK_1BF0D4F512469DE2 FOREIGN KEY (category_id) REFERENCES category (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE sdspecification');
        $this->addSql('DROP TABLE sospecification');
    }
}
