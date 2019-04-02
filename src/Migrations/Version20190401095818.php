<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190401095818 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE ad DROP INDEX UNIQ_77E0ED58A73F0036, ADD INDEX IDX_77E0ED58A73F0036 (ville_id)');
        $this->addSql('ALTER TABLE ad DROP INDEX UNIQ_77E0ED5898260155, ADD INDEX IDX_77E0ED5898260155 (region_id)');
        $this->addSql('ALTER TABLE ad DROP INDEX UNIQ_77E0ED58AE80F5DF, ADD INDEX IDX_77E0ED58AE80F5DF (department_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE ad DROP INDEX IDX_77E0ED58A73F0036, ADD UNIQUE INDEX UNIQ_77E0ED58A73F0036 (ville_id)');
        $this->addSql('ALTER TABLE ad DROP INDEX IDX_77E0ED58AE80F5DF, ADD UNIQUE INDEX UNIQ_77E0ED58AE80F5DF (department_id)');
        $this->addSql('ALTER TABLE ad DROP INDEX IDX_77E0ED5898260155, ADD UNIQUE INDEX UNIQ_77E0ED5898260155 (region_id)');
    }
}
