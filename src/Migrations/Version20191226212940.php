<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191226212940 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE hosting_request (id INT AUTO_INCREMENT NOT NULL, sender_id INT NOT NULL, hosting_id INT NOT NULL, date DATE NOT NULL, start_date DATE NOT NULL, end_date DATE NOT NULL, number_of_persons INT NOT NULL, description LONGTEXT DEFAULT NULL, treatment VARCHAR(255) DEFAULT NULL, sender_status TINYINT(1) DEFAULT NULL, hosting_status TINYINT(1) DEFAULT NULL, INDEX IDX_5617DA05F624B39D (sender_id), INDEX IDX_5617DA05AE9044EA (hosting_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE hosting_request ADD CONSTRAINT FK_5617DA05F624B39D FOREIGN KEY (sender_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE hosting_request ADD CONSTRAINT FK_5617DA05AE9044EA FOREIGN KEY (hosting_id) REFERENCES user (id)');
        $this->addSql('DROP TABLE sessions');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE sessions (sess_id VARCHAR(128) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_bin`, sess_data BLOB NOT NULL, sess_time INT UNSIGNED NOT NULL, sess_lifetime INT NOT NULL, PRIMARY KEY(sess_id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('DROP TABLE hosting_request');
    }
}
