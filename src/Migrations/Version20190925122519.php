<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190925122519 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE deal DROP INDEX UNIQ_E3FEC1168143D4C, ADD INDEX IDX_E3FEC1168143D4C (demand_user_id)');
        $this->addSql('ALTER TABLE deal DROP INDEX UNIQ_E3FEC11653C674EE, ADD INDEX IDX_E3FEC11653C674EE (offer_id)');
        $this->addSql('ALTER TABLE deal DROP INDEX UNIQ_E3FEC116666159C, ADD INDEX IDX_E3FEC116666159C (offer_user_id)');
        $this->addSql('ALTER TABLE deal DROP INDEX UNIQ_E3FEC11612469DE2, ADD INDEX IDX_E3FEC11612469DE2 (category_id)');
        $this->addSql('ALTER TABLE deal DROP INDEX UNIQ_E3FEC1165D022E59, ADD INDEX IDX_E3FEC1165D022E59 (demand_id)');
        $this->addSql('ALTER TABLE deal DROP deal_number');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE deal DROP INDEX IDX_E3FEC116666159C, ADD UNIQUE INDEX UNIQ_E3FEC116666159C (offer_user_id)');
        $this->addSql('ALTER TABLE deal DROP INDEX IDX_E3FEC1168143D4C, ADD UNIQUE INDEX UNIQ_E3FEC1168143D4C (demand_user_id)');
        $this->addSql('ALTER TABLE deal DROP INDEX IDX_E3FEC11612469DE2, ADD UNIQUE INDEX UNIQ_E3FEC11612469DE2 (category_id)');
        $this->addSql('ALTER TABLE deal DROP INDEX IDX_E3FEC11653C674EE, ADD UNIQUE INDEX UNIQ_E3FEC11653C674EE (offer_id)');
        $this->addSql('ALTER TABLE deal DROP INDEX IDX_E3FEC1165D022E59, ADD UNIQUE INDEX UNIQ_E3FEC1165D022E59 (demand_id)');
        $this->addSql('ALTER TABLE deal ADD deal_number INT NOT NULL');
    }
}
