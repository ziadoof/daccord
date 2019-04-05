<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190405072516 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE specification (id INT AUTO_INCREMENT NOT NULL, category_id INT NOT NULL, name VARCHAR(255) NOT NULL, label VARCHAR(255) NOT NULL, type VARCHAR(255) NOT NULL, text_options LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:array)\', numeric_options LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:array)\', type_of_choice VARCHAR(255) DEFAULT NULL, min_option INT DEFAULT NULL, max_option INT DEFAULT NULL, INDEX IDX_E3F1A9A12469DE2 (category_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE category (id INT AUTO_INCREMENT NOT NULL, parent_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, type VARCHAR(255) NOT NULL, INDEX IDX_64C19C1727ACA70 (parent_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ad (id INT AUTO_INCREMENT NOT NULL, category_id INT NOT NULL, user_id INT NOT NULL, city_id INT DEFAULT NULL, ville_id INT DEFAULT NULL, department_id INT DEFAULT NULL, region_id INT DEFAULT NULL, title VARCHAR(255) DEFAULT NULL, description LONGTEXT DEFAULT NULL, image_one VARCHAR(255) DEFAULT NULL, image_tow VARCHAR(255) DEFAULT NULL, image_three VARCHAR(255) DEFAULT NULL, price DOUBLE PRECISION DEFAULT NULL, p_price DOUBLE PRECISION DEFAULT NULL, donate TINYINT(1) DEFAULT NULL, date_of_ad DATETIME NOT NULL, type_of_ad VARCHAR(255) NOT NULL, with_driver TINYINT(1) DEFAULT NULL, mission VARCHAR(255) DEFAULT NULL, the_type VARCHAR(255) DEFAULT NULL, second_language VARCHAR(255) DEFAULT NULL, age INT DEFAULT NULL, i_size INT DEFAULT NULL, s_size VARCHAR(255) DEFAULT NULL, languages LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:array)\', acitvity_area VARCHAR(255) DEFAULT NULL, work_hours VARCHAR(255) DEFAULT NULL, type_of_contract VARCHAR(255) DEFAULT NULL, experience VARCHAR(255) DEFAULT NULL, level_of_study VARCHAR(255) DEFAULT NULL, language VARCHAR(255) DEFAULT NULL, type_of_translation VARCHAR(255) DEFAULT NULL, material VARCHAR(255) DEFAULT NULL, place_of_lesson VARCHAR(255) DEFAULT NULL, level_of_student VARCHAR(255) DEFAULT NULL, brand VARCHAR(255) DEFAULT NULL, color VARCHAR(255) DEFAULT NULL, fuel_type VARCHAR(255) DEFAULT NULL, model VARCHAR(255) DEFAULT NULL, change_gear VARCHAR(255) DEFAULT NULL, manufacture_company VARCHAR(255) DEFAULT NULL, general_situation VARCHAR(255) DEFAULT NULL, paper_size VARCHAR(255) DEFAULT NULL, printing_type VARCHAR(255) DEFAULT NULL, printing_color VARCHAR(255) DEFAULT NULL, analog_digital VARCHAR(255) DEFAULT NULL, animal_species VARCHAR(255) DEFAULT NULL, dvd_cd VARCHAR(255) DEFAULT NULL, origin_country VARCHAR(255) DEFAULT NULL, cover_material VARCHAR(255) DEFAULT NULL, shape VARCHAR(255) DEFAULT NULL, heating VARCHAR(255) DEFAULT NULL, heating_type VARCHAR(255) DEFAULT NULL, class_energie VARCHAR(255) DEFAULT NULL, ges VARCHAR(255) DEFAULT NULL, event_type VARCHAR(255) DEFAULT NULL, subject_name VARCHAR(255) DEFAULT NULL, salary INT DEFAULT NULL, duration_of_lesson INT DEFAULT NULL, max_distance INT DEFAULT NULL, manufacturing_year INT DEFAULT NULL, max_manufacturing_year INT DEFAULT NULL, min_manufacturing_year INT DEFAULT NULL, number_of_passengers INT DEFAULT NULL, number_of_doors INT DEFAULT NULL, kilometer INT DEFAULT NULL, max_kilometer INT DEFAULT NULL, min_kilometer INT DEFAULT NULL, processor VARCHAR(255) DEFAULT NULL, ram INT DEFAULT NULL, screen_size_cm DOUBLE PRECISION DEFAULT NULL, screen_size_inch DOUBLE PRECISION DEFAULT NULL, capacity DOUBLE PRECISION DEFAULT NULL, min_capacity DOUBLE PRECISION DEFAULT NULL, max_capacity DOUBLE PRECISION DEFAULT NULL, accuracy DOUBLE PRECISION DEFAULT NULL, weight DOUBLE PRECISION DEFAULT NULL, caliber DOUBLE PRECISION DEFAULT NULL, max_caliber DOUBLE PRECISION DEFAULT NULL, min_caliber DOUBLE PRECISION DEFAULT NULL, number INT DEFAULT NULL, width DOUBLE PRECISION DEFAULT NULL, height DOUBLE PRECISION DEFAULT NULL, number_of_persson INT DEFAULT NULL, length DOUBLE PRECISION DEFAULT NULL, number_of_drawer INT DEFAULT NULL, number_of_staging INT DEFAULT NULL, number_of_head INT DEFAULT NULL, ability DOUBLE PRECISION DEFAULT NULL, floor INT DEFAULT NULL, area DOUBLE PRECISION DEFAULT NULL, min_area DOUBLE PRECISION DEFAULT NULL, max_area DOUBLE PRECISION DEFAULT NULL, number_of_rooms INT DEFAULT NULL, min_number_of_rooms INT DEFAULT NULL, max_number_of_rooms INT DEFAULT NULL, number_of_floors INT DEFAULT NULL, hdmi TINYINT(1) DEFAULT NULL, cd_room TINYINT(1) DEFAULT NULL, wifi TINYINT(1) DEFAULT NULL, usb TINYINT(1) DEFAULT NULL, three_in_one TINYINT(1) DEFAULT NULL, accessories TINYINT(1) DEFAULT NULL, with_freezer TINYINT(1) DEFAULT NULL, electric_head TINYINT(1) DEFAULT NULL, with_oven TINYINT(1) DEFAULT NULL, covered TINYINT(1) DEFAULT NULL, with_furniture TINYINT(1) DEFAULT NULL, with_garden TINYINT(1) DEFAULT NULL, with_verandah TINYINT(1) DEFAULT NULL, with_elevator TINYINT(1) DEFAULT NULL, date_of_event DATE DEFAULT NULL, INDEX IDX_77E0ED5812469DE2 (category_id), INDEX IDX_77E0ED58A76ED395 (user_id), UNIQUE INDEX UNIQ_77E0ED588BAC62AF (city_id), INDEX IDX_77E0ED58A73F0036 (ville_id), INDEX IDX_77E0ED58AE80F5DF (department_id), INDEX IDX_77E0ED5898260155 (region_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE department (id INT AUTO_INCREMENT NOT NULL, region_id INT NOT NULL, name VARCHAR(255) NOT NULL, slug VARCHAR(255) NOT NULL, INDEX IDX_CD1DE18A98260155 (region_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE region (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, slug VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE city (id INT AUTO_INCREMENT NOT NULL, department_id INT NOT NULL, insee_code VARCHAR(5) NOT NULL, zip_code VARCHAR(5) NOT NULL, name VARCHAR(255) NOT NULL, slug VARCHAR(255) NOT NULL, gps_lat DOUBLE PRECISION NOT NULL, gps_lng DOUBLE PRECISION NOT NULL, INDEX IDX_2D5B0234AE80F5DF (department_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, city_id INT DEFAULT NULL, username VARCHAR(180) NOT NULL, username_canonical VARCHAR(180) NOT NULL, email VARCHAR(180) NOT NULL, email_canonical VARCHAR(180) NOT NULL, enabled TINYINT(1) NOT NULL, salt VARCHAR(255) DEFAULT NULL, password VARCHAR(255) NOT NULL, last_login DATETIME DEFAULT NULL, confirmation_token VARCHAR(180) DEFAULT NULL, password_requested_at DATETIME DEFAULT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', firstname VARCHAR(40) DEFAULT NULL, lastname VARCHAR(40) DEFAULT NULL, email_status TINYINT(1) NOT NULL, postal_code INT DEFAULT NULL, phone_number INT DEFAULT NULL, phon_number_status TINYINT(1) NOT NULL, created_at DATETIME NOT NULL, gender VARCHAR(20) DEFAULT NULL, gender_status TINYINT(1) NOT NULL, birthday DATE DEFAULT NULL, birthday_status TINYINT(1) NOT NULL, map_x DOUBLE PRECISION DEFAULT NULL, map_y DOUBLE PRECISION DEFAULT NULL, driver TINYINT(1) DEFAULT NULL, car VARCHAR(40) DEFAULT NULL, color VARCHAR(20) DEFAULT NULL, profile_image VARCHAR(255) DEFAULT NULL, car_image VARCHAR(255) DEFAULT NULL, max_distance INT NOT NULL, point INT NOT NULL, ville VARCHAR(100) DEFAULT NULL, UNIQUE INDEX UNIQ_8D93D64992FC23A8 (username_canonical), UNIQUE INDEX UNIQ_8D93D649A0D96FBF (email_canonical), UNIQUE INDEX UNIQ_8D93D649C05FB297 (confirmation_token), INDEX IDX_8D93D6498BAC62AF (city_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE specification ADD CONSTRAINT FK_E3F1A9A12469DE2 FOREIGN KEY (category_id) REFERENCES category (id)');
        $this->addSql('ALTER TABLE category ADD CONSTRAINT FK_64C19C1727ACA70 FOREIGN KEY (parent_id) REFERENCES category (id)');
        $this->addSql('ALTER TABLE ad ADD CONSTRAINT FK_77E0ED5812469DE2 FOREIGN KEY (category_id) REFERENCES category (id)');
        $this->addSql('ALTER TABLE ad ADD CONSTRAINT FK_77E0ED58A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE ad ADD CONSTRAINT FK_77E0ED588BAC62AF FOREIGN KEY (city_id) REFERENCES city (id)');
        $this->addSql('ALTER TABLE ad ADD CONSTRAINT FK_77E0ED58A73F0036 FOREIGN KEY (ville_id) REFERENCES city (id)');
        $this->addSql('ALTER TABLE ad ADD CONSTRAINT FK_77E0ED58AE80F5DF FOREIGN KEY (department_id) REFERENCES department (id)');
        $this->addSql('ALTER TABLE ad ADD CONSTRAINT FK_77E0ED5898260155 FOREIGN KEY (region_id) REFERENCES region (id)');
        $this->addSql('ALTER TABLE department ADD CONSTRAINT FK_CD1DE18A98260155 FOREIGN KEY (region_id) REFERENCES region (id)');
        $this->addSql('ALTER TABLE city ADD CONSTRAINT FK_2D5B0234AE80F5DF FOREIGN KEY (department_id) REFERENCES department (id)');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D6498BAC62AF FOREIGN KEY (city_id) REFERENCES city (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE specification DROP FOREIGN KEY FK_E3F1A9A12469DE2');
        $this->addSql('ALTER TABLE category DROP FOREIGN KEY FK_64C19C1727ACA70');
        $this->addSql('ALTER TABLE ad DROP FOREIGN KEY FK_77E0ED5812469DE2');
        $this->addSql('ALTER TABLE ad DROP FOREIGN KEY FK_77E0ED58AE80F5DF');
        $this->addSql('ALTER TABLE city DROP FOREIGN KEY FK_2D5B0234AE80F5DF');
        $this->addSql('ALTER TABLE ad DROP FOREIGN KEY FK_77E0ED5898260155');
        $this->addSql('ALTER TABLE department DROP FOREIGN KEY FK_CD1DE18A98260155');
        $this->addSql('ALTER TABLE ad DROP FOREIGN KEY FK_77E0ED588BAC62AF');
        $this->addSql('ALTER TABLE ad DROP FOREIGN KEY FK_77E0ED58A73F0036');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D6498BAC62AF');
        $this->addSql('ALTER TABLE ad DROP FOREIGN KEY FK_77E0ED58A76ED395');
        $this->addSql('DROP TABLE specification');
        $this->addSql('DROP TABLE category');
        $this->addSql('DROP TABLE ad');
        $this->addSql('DROP TABLE department');
        $this->addSql('DROP TABLE region');
        $this->addSql('DROP TABLE city');
        $this->addSql('DROP TABLE user');
    }
}
