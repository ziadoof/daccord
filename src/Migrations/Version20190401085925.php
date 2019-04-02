<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190401085925 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE ad ADD ville_id INT DEFAULT NULL, ADD department_id INT DEFAULT NULL, ADD region_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE ad ADD CONSTRAINT FK_77E0ED58A73F0036 FOREIGN KEY (ville_id) REFERENCES city (id)');
        $this->addSql('ALTER TABLE ad ADD CONSTRAINT FK_77E0ED58AE80F5DF FOREIGN KEY (department_id) REFERENCES department (id)');
        $this->addSql('ALTER TABLE ad ADD CONSTRAINT FK_77E0ED5898260155 FOREIGN KEY (region_id) REFERENCES region (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_77E0ED58A73F0036 ON ad (ville_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_77E0ED58AE80F5DF ON ad (department_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_77E0ED5898260155 ON ad (region_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE ad DROP FOREIGN KEY FK_77E0ED58A73F0036');
        $this->addSql('ALTER TABLE ad DROP FOREIGN KEY FK_77E0ED58AE80F5DF');
        $this->addSql('ALTER TABLE ad DROP FOREIGN KEY FK_77E0ED5898260155');
        $this->addSql('DROP INDEX UNIQ_77E0ED58A73F0036 ON ad');
        $this->addSql('DROP INDEX UNIQ_77E0ED58AE80F5DF ON ad');
        $this->addSql('DROP INDEX UNIQ_77E0ED5898260155 ON ad');
        $this->addSql('ALTER TABLE ad DROP ville_id, DROP department_id, DROP region_id');
    }
}
