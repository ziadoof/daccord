<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190304093901 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE ad ADD the_type VARCHAR(255) DEFAULT NULL, ADD second_language VARCHAR(255) DEFAULT NULL, ADD age INT DEFAULT NULL, ADD languages LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:array)\', ADD number_of_rooms INT DEFAULT NULL, ADD min_number_of_rooms INT DEFAULT NULL, ADD max_number_of_rooms INT DEFAULT NULL, DROP keyboard_language, DROP machin_name, DROP animal_color, DROP film_name, DROP book_name, DROP language_book_film, DROP clothes_material, DROP clothes_size, DROP gaz_type, DROP hdd_capacity, DROP gauge, DROP size_perfume, DROP shoe_size, DROP parachute_size, DROP animal_age, DROP kids_clothes_size, DROP diapers_size, DROP capacity_size, DROP washing_capacity, DROP tires_size, DROP room_number, DROP min_room_number, DROP max_room_number, CHANGE processor processor VARCHAR(255) DEFAULT NULL, CHANGE tree_in_one three_in_one TINYINT(1) DEFAULT NULL, CHANGE date date_of_event DATE DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE ad ADD keyboard_language VARCHAR(255) DEFAULT NULL COLLATE utf8mb4_unicode_ci, ADD machin_name VARCHAR(255) DEFAULT NULL COLLATE utf8mb4_unicode_ci, ADD animal_color VARCHAR(255) DEFAULT NULL COLLATE utf8mb4_unicode_ci, ADD film_name VARCHAR(255) DEFAULT NULL COLLATE utf8mb4_unicode_ci, ADD book_name VARCHAR(255) DEFAULT NULL COLLATE utf8mb4_unicode_ci, ADD language_book_film VARCHAR(255) DEFAULT NULL COLLATE utf8mb4_unicode_ci, ADD clothes_material VARCHAR(255) DEFAULT NULL COLLATE utf8mb4_unicode_ci, ADD clothes_size VARCHAR(255) DEFAULT NULL COLLATE utf8mb4_unicode_ci, ADD gaz_type VARCHAR(255) DEFAULT NULL COLLATE utf8mb4_unicode_ci, ADD hdd_capacity INT DEFAULT NULL, ADD gauge INT DEFAULT NULL, ADD size_perfume INT DEFAULT NULL, ADD shoe_size INT DEFAULT NULL, ADD parachute_size INT DEFAULT NULL, ADD animal_age INT DEFAULT NULL, ADD kids_clothes_size INT DEFAULT NULL, ADD diapers_size INT DEFAULT NULL, ADD capacity_size INT DEFAULT NULL, ADD washing_capacity INT DEFAULT NULL, ADD tires_size INT DEFAULT NULL, ADD room_number INT DEFAULT NULL, ADD min_room_number INT DEFAULT NULL, ADD max_room_number INT DEFAULT NULL, DROP the_type, DROP second_language, DROP age, DROP languages, DROP number_of_rooms, DROP min_number_of_rooms, DROP max_number_of_rooms, CHANGE processor processor INT DEFAULT NULL, CHANGE three_in_one tree_in_one TINYINT(1) DEFAULT NULL, CHANGE date_of_event date DATE DEFAULT NULL');
    }
}
