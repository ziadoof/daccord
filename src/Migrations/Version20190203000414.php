<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190203000414 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE ad (id INT AUTO_INCREMENT NOT NULL, category_id INT NOT NULL, user_id INT NOT NULL, city_id INT DEFAULT NULL, title VARCHAR(255) DEFAULT NULL, description LONGTEXT DEFAULT NULL, image_one VARCHAR(255) DEFAULT NULL, image_tow VARCHAR(255) DEFAULT NULL, image_three VARCHAR(255) DEFAULT NULL, price DOUBLE PRECISION DEFAULT NULL, donate TINYINT(1) DEFAULT NULL, date_of_ad DATETIME NOT NULL, with_driver TINYINT(1) DEFAULT NULL, type_of_ad VARCHAR(255) NOT NULL, mission VARCHAR(255) DEFAULT NULL, acitvity_area VARCHAR(255) DEFAULT NULL, full_partial VARCHAR(255) DEFAULT NULL, type_of_contract VARCHAR(255) DEFAULT NULL, experience VARCHAR(255) DEFAULT NULL, level_of_study VARCHAR(255) DEFAULT NULL, language VARCHAR(255) DEFAULT NULL, type_of_translation VARCHAR(255) DEFAULT NULL, material VARCHAR(255) DEFAULT NULL, place_of_lesson VARCHAR(255) DEFAULT NULL, level_of_student VARCHAR(255) DEFAULT NULL, brand VARCHAR(255) DEFAULT NULL, color VARCHAR(255) DEFAULT NULL, fuel_type VARCHAR(255) DEFAULT NULL, model VARCHAR(255) DEFAULT NULL, change_gear VARCHAR(255) DEFAULT NULL, manufacture_company VARCHAR(255) DEFAULT NULL, general_situation VARCHAR(255) DEFAULT NULL, paper_size VARCHAR(255) DEFAULT NULL, printing_type VARCHAR(255) DEFAULT NULL, printing_color VARCHAR(255) DEFAULT NULL, keyboard_language VARCHAR(255) DEFAULT NULL, analog_digital VARCHAR(255) DEFAULT NULL, machin_name VARCHAR(255) DEFAULT NULL, animal_color VARCHAR(255) DEFAULT NULL, animal_species VARCHAR(255) DEFAULT NULL, film_name VARCHAR(255) DEFAULT NULL, book_name VARCHAR(255) DEFAULT NULL, dvd_cd VARCHAR(255) DEFAULT NULL, language_book_film VARCHAR(255) DEFAULT NULL, origin_country VARCHAR(255) DEFAULT NULL, clothes_material VARCHAR(255) DEFAULT NULL, clothes_size VARCHAR(255) DEFAULT NULL, cover_material VARCHAR(255) DEFAULT NULL, shape VARCHAR(255) DEFAULT NULL, gaz_type VARCHAR(255) DEFAULT NULL, heating VARCHAR(255) DEFAULT NULL, heating_type VARCHAR(255) DEFAULT NULL, class_energie VARCHAR(255) DEFAULT NULL, ges VARCHAR(255) DEFAULT NULL, event_type VARCHAR(255) DEFAULT NULL, subject_name VARCHAR(255) DEFAULT NULL, salary INT DEFAULT NULL, duration_of_lesson INT DEFAULT NULL, max_distance INT DEFAULT NULL, manufacturing_year INT DEFAULT NULL, max_manufacturing_year INT DEFAULT NULL, min_manufacturing_year INT DEFAULT NULL, number_of_passengers INT DEFAULT NULL, number_of_doors INT DEFAULT NULL, kilometer INT DEFAULT NULL, max_kilometer INT DEFAULT NULL, min_kilometer INT DEFAULT NULL, processor INT DEFAULT NULL, hdd_capacity INT DEFAULT NULL, ram INT DEFAULT NULL, screen_size_cm INT DEFAULT NULL, screen_size_inch INT DEFAULT NULL, capacity INT DEFAULT NULL, accuracy INT DEFAULT NULL, weight INT DEFAULT NULL, caliber INT DEFAULT NULL, max_caliber INT DEFAULT NULL, min_caliber INT DEFAULT NULL, gauge INT DEFAULT NULL, size_perfume INT DEFAULT NULL, shoe_size INT DEFAULT NULL, parachute_size INT DEFAULT NULL, number INT DEFAULT NULL, animal_age INT DEFAULT NULL, width INT DEFAULT NULL, height INT DEFAULT NULL, kids_clothes_size INT DEFAULT NULL, number_of_persson INT DEFAULT NULL, length INT DEFAULT NULL, diapers_size INT DEFAULT NULL, capacity_size INT DEFAULT NULL, number_of_drawer INT DEFAULT NULL, number_of_staging INT DEFAULT NULL, number_of_head INT DEFAULT NULL, washing_capacity INT DEFAULT NULL, ability INT DEFAULT NULL, tires_size INT DEFAULT NULL, floor INT DEFAULT NULL, area INT DEFAULT NULL, min_area INT DEFAULT NULL, max_area INT DEFAULT NULL, room_number INT DEFAULT NULL, min_room_number INT DEFAULT NULL, max_room_number INT DEFAULT NULL, number_of_floors INT DEFAULT NULL, hdmi TINYINT(1) DEFAULT NULL, cd_room TINYINT(1) DEFAULT NULL, wifi TINYINT(1) DEFAULT NULL, usb TINYINT(1) DEFAULT NULL, tree_in_one TINYINT(1) DEFAULT NULL, accessories TINYINT(1) DEFAULT NULL, with_freezer TINYINT(1) DEFAULT NULL, electric_head TINYINT(1) DEFAULT NULL, with_oven TINYINT(1) DEFAULT NULL, covered TINYINT(1) DEFAULT NULL, with_furniture TINYINT(1) DEFAULT NULL, with_garden TINYINT(1) DEFAULT NULL, with_verandah TINYINT(1) DEFAULT NULL, with_elevator TINYINT(1) DEFAULT NULL, date DATE DEFAULT NULL, INDEX IDX_77E0ED5812469DE2 (category_id), INDEX IDX_77E0ED58A76ED395 (user_id), UNIQUE INDEX UNIQ_77E0ED588BAC62AF (city_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE ad ADD CONSTRAINT FK_77E0ED5812469DE2 FOREIGN KEY (category_id) REFERENCES category (id)');
        $this->addSql('ALTER TABLE ad ADD CONSTRAINT FK_77E0ED58A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE ad ADD CONSTRAINT FK_77E0ED588BAC62AF FOREIGN KEY (city_id) REFERENCES city (id)');
        $this->addSql('ALTER TABLE department RENAME INDEX idx_16aeb8d43cc88f90 TO IDX_CD1DE18A98260155');
        $this->addSql('ALTER TABLE city RENAME INDEX idx_d95db16b9a7316f4 TO IDX_2D5B0234AE80F5DF');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE ad');
        $this->addSql('ALTER TABLE city RENAME INDEX idx_2d5b0234ae80f5df TO IDX_D95DB16B9A7316F4');
        $this->addSql('ALTER TABLE department RENAME INDEX idx_cd1de18a98260155 TO IDX_16AEB8D43CC88F90');
    }
}
