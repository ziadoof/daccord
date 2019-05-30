<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190408114048 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE ad DROP FOREIGN KEY FK_77E0ED582324F0B');
        $this->addSql('DROP INDEX IDX_77E0ED582324F0B ON ad');
        $this->addSql('ALTER TABLE ad DROP generalcategory_id');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE ad ADD generalcategory_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE ad ADD CONSTRAINT FK_77E0ED582324F0B FOREIGN KEY (generalcategory_id) REFERENCES category (id)');
        $this->addSql('CREATE INDEX IDX_77E0ED582324F0B ON ad (generalcategory_id)');
    }
}
