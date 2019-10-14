<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190928233836 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE done_deal (id INT AUTO_INCREMENT NOT NULL, offer_user_id INT NOT NULL, demand_user_id INT NOT NULL, category_id INT NOT NULL, date DATETIME NOT NULL, INDEX IDX_15049950666159C (offer_user_id), INDEX IDX_150499508143D4C (demand_user_id), INDEX IDX_1504995012469DE2 (category_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE done_deal ADD CONSTRAINT FK_15049950666159C FOREIGN KEY (offer_user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE done_deal ADD CONSTRAINT FK_150499508143D4C FOREIGN KEY (demand_user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE done_deal ADD CONSTRAINT FK_1504995012469DE2 FOREIGN KEY (category_id) REFERENCES category (id)');
        $this->addSql('ALTER TABLE deal ADD driver_user_id INT NOT NULL, DROP offer_user_date, DROP demand_user_date, DROP driver_date, DROP deal_status');
        $this->addSql('ALTER TABLE deal ADD CONSTRAINT FK_E3FEC1166291B7F5 FOREIGN KEY (driver_user_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_E3FEC1166291B7F5 ON deal (driver_user_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE done_deal');
        $this->addSql('ALTER TABLE deal DROP FOREIGN KEY FK_E3FEC1166291B7F5');
        $this->addSql('DROP INDEX IDX_E3FEC1166291B7F5 ON deal');
        $this->addSql('ALTER TABLE deal ADD offer_user_date DATETIME DEFAULT NULL, ADD demand_user_date DATETIME DEFAULT NULL, ADD driver_date DATETIME DEFAULT NULL, ADD deal_status TINYINT(1) DEFAULT NULL, DROP driver_user_id');
    }
}
