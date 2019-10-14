<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190924213002 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE deal (id INT AUTO_INCREMENT NOT NULL, offer_user_id INT NOT NULL, demand_user_id INT NOT NULL, category_id INT NOT NULL, offer_id INT NOT NULL, demand_id INT NOT NULL, suggestion_date DATETIME NOT NULL, deal_number INT NOT NULL, offer_user_status TINYINT(1) DEFAULT NULL, demand_user_status TINYINT(1) DEFAULT NULL, driver_status TINYINT(1) DEFAULT NULL, offer_user_date DATETIME DEFAULT NULL, demand_user_date DATETIME DEFAULT NULL, driver_date DATETIME DEFAULT NULL, UNIQUE INDEX UNIQ_E3FEC116666159C (offer_user_id), UNIQUE INDEX UNIQ_E3FEC1168143D4C (demand_user_id), UNIQUE INDEX UNIQ_E3FEC11612469DE2 (category_id), UNIQUE INDEX UNIQ_E3FEC11653C674EE (offer_id), UNIQUE INDEX UNIQ_E3FEC1165D022E59 (demand_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE deal ADD CONSTRAINT FK_E3FEC116666159C FOREIGN KEY (offer_user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE deal ADD CONSTRAINT FK_E3FEC1168143D4C FOREIGN KEY (demand_user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE deal ADD CONSTRAINT FK_E3FEC11612469DE2 FOREIGN KEY (category_id) REFERENCES category (id)');
        $this->addSql('ALTER TABLE deal ADD CONSTRAINT FK_E3FEC11653C674EE FOREIGN KEY (offer_id) REFERENCES ad (id)');
        $this->addSql('ALTER TABLE deal ADD CONSTRAINT FK_E3FEC1165D022E59 FOREIGN KEY (demand_id) REFERENCES ad (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE deal');
    }
}
