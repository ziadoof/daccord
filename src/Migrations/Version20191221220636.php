<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191221220636 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE hosting (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, city_id INT NOT NULL, number_of_persons INT NOT NULL, number_of_days INT DEFAULT NULL, image VARCHAR(255) DEFAULT NULL, languages LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', age INT DEFAULT NULL, sex VARCHAR(255) DEFAULT NULL, about_me LONGTEXT NOT NULL, hosting_for LONGTEXT NOT NULL, animal TINYINT(1) DEFAULT NULL, child TINYINT(1) DEFAULT NULL, handicapped TINYINT(1) DEFAULT NULL, food TINYINT(1) DEFAULT NULL, conversation TINYINT(1) DEFAULT NULL, city_tour TINYINT(1) DEFAULT NULL, video_game TINYINT(1) DEFAULT NULL, movie TINYINT(1) DEFAULT NULL, television TINYINT(1) DEFAULT NULL, music TINYINT(1) DEFAULT NULL, UNIQUE INDEX UNIQ_E9168FDAA76ED395 (user_id), INDEX IDX_E9168FDA8BAC62AF (city_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE hosting ADD CONSTRAINT FK_E9168FDAA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE hosting ADD CONSTRAINT FK_E9168FDA8BAC62AF FOREIGN KEY (city_id) REFERENCES city (id)');
        $this->addSql('DROP TABLE sessions');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE sessions (sess_id VARCHAR(128) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_bin`, sess_data BLOB NOT NULL, sess_time INT UNSIGNED NOT NULL, sess_lifetime INT NOT NULL, PRIMARY KEY(sess_id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('DROP TABLE hosting');
    }
}
