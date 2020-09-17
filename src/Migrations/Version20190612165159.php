<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190612165159 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE alert (id INT AUTO_INCREMENT NOT NULL, comment VARCHAR(30) NOT NULL, latitude DOUBLE PRECISION NOT NULL, longitude DOUBLE PRECISION NOT NULL, AlertType_id INT DEFAULT NULL, User_id INT DEFAULT NULL, Position_id INT DEFAULT NULL, INDEX IDX_17FD46C1DCC1E873 (AlertType_id), INDEX IDX_17FD46C168D3EA09 (User_id), INDEX IDX_17FD46C15B18A191 (Position_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE event (id INT AUTO_INCREMENT NOT NULL, position_id INT DEFAULT NULL, description VARCHAR(30) NOT NULL, start_date DATETIME NOT NULL, end_date DATETIME NOT NULL, name VARCHAR(30) NOT NULL, INDEX IDX_3BAE0AA7DD842E46 (position_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE position (id INT AUTO_INCREMENT NOT NULL, vehicle_id INT DEFAULT NULL, latitude DOUBLE PRECISION NOT NULL, longitude DOUBLE PRECISION NOT NULL, timestamp INT NOT NULL, INDEX IDX_462CE4F5545317D1 (vehicle_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE line (id INT AUTO_INCREMENT NOT NULL, color_type VARCHAR(10) NOT NULL, line_number INT NOT NULL, LineType_id INT DEFAULT NULL, INDEX IDX_D114B4F61108BE6 (LineType_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE Line_Station (line_id INT NOT NULL, station_id INT NOT NULL, INDEX IDX_FD119BB24D7B7542 (line_id), INDEX IDX_FD119BB221BDB235 (station_id), PRIMARY KEY(line_id, station_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ride (id INT AUTO_INCREMENT NOT NULL, line_id INT DEFAULT NULL, direction INT NOT NULL, departure_date DATETIME NOT NULL, finish_date DATETIME DEFAULT NULL, created_at DATETIME NOT NULL, Driver_id INT DEFAULT NULL, Vehicle_id INT DEFAULT NULL, INDEX IDX_9B3D7CD04D7B7542 (line_id), INDEX IDX_9B3D7CD041B3BBAA (Driver_id), INDEX IDX_9B3D7CD01B0E1401 (Vehicle_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE station (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(225) NOT NULL, Position_id INT DEFAULT NULL, UNIQUE INDEX UNIQ_9F39F8B15B18A191 (Position_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE Interstations (station_id INT NOT NULL, next_station_id INT NOT NULL, INDEX IDX_91BACD4121BDB235 (station_id), INDEX IDX_91BACD419E2A59F6 (next_station_id), PRIMARY KEY(station_id, next_station_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE vehicle (id INT AUTO_INCREMENT NOT NULL, nbr_bus INT NOT NULL, mark VARCHAR(30) NOT NULL, register_nbr INT NOT NULL, max_siege INT NOT NULL, VehicleOwner_id INT DEFAULT NULL, VehicleType_id INT DEFAULT NULL, INDEX IDX_1B80E48664B48123 (VehicleOwner_id), INDEX IDX_1B80E48697782B87 (VehicleType_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE alert_type (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(30) NOT NULL, descripton VARCHAR(30) NOT NULL, level INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE api_token (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, token VARCHAR(255) NOT NULL, expires_at DATETIME NOT NULL, INDEX IDX_7BA2F5EBA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE driver (id INT AUTO_INCREMENT NOT NULL, drivinglicence INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE evaluation (id INT AUTO_INCREMENT NOT NULL, customer_id INT DEFAULT NULL, ride_id INT DEFAULT NULL, comment VARCHAR(255) NOT NULL, note VARCHAR(255) NOT NULL, INDEX IDX_1323A5759395C3F3 (customer_id), INDEX IDX_1323A575302A8A70 (ride_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE favorites (id INT AUTO_INCREMENT NOT NULL, line_id INT DEFAULT NULL, rank INT NOT NULL, Station_id INT DEFAULT NULL, Customer_id INT DEFAULT NULL, INDEX IDX_E46960F54D7B7542 (line_id), INDEX IDX_E46960F56EE0B1E5 (Station_id), INDEX IDX_E46960F515094C24 (Customer_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE history (id INT AUTO_INCREMENT NOT NULL, start_date DATE NOT NULL, end_date VARCHAR(30) NOT NULL, Ride_id INT DEFAULT NULL, INDEX IDX_27BA704BFF97B3EC (Ride_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE interstation (id INT AUTO_INCREMENT NOT NULL, periode VARCHAR(255) NOT NULL, time TIME NOT NULL, distance DOUBLE PRECISION NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE line_staton (id INT AUTO_INCREMENT NOT NULL, rank INT NOT NULL, stopduration INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE line_type (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(30) NOT NULL, code INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE vehicle_owner (id INT AUTO_INCREMENT NOT NULL, username VARCHAR(180) NOT NULL, roles JSON DEFAULT NULL, password VARCHAR(255) NOT NULL, firstname VARCHAR(255) NOT NULL, lastname VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_ADCF6690F85E0677 (username), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE vehicle_type (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(30) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE alert ADD CONSTRAINT FK_17FD46C1DCC1E873 FOREIGN KEY (AlertType_id) REFERENCES alert_type (id)');
        $this->addSql('ALTER TABLE alert ADD CONSTRAINT FK_17FD46C168D3EA09 FOREIGN KEY (User_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE alert ADD CONSTRAINT FK_17FD46C15B18A191 FOREIGN KEY (Position_id) REFERENCES position (id)');
        $this->addSql('ALTER TABLE event ADD CONSTRAINT FK_3BAE0AA7DD842E46 FOREIGN KEY (position_id) REFERENCES position (id)');
        $this->addSql('ALTER TABLE position ADD CONSTRAINT FK_462CE4F5545317D1 FOREIGN KEY (vehicle_id) REFERENCES vehicle (id)');
        $this->addSql('ALTER TABLE line ADD CONSTRAINT FK_D114B4F61108BE6 FOREIGN KEY (LineType_id) REFERENCES line_type (id)');
        $this->addSql('ALTER TABLE Line_Station ADD CONSTRAINT FK_FD119BB24D7B7542 FOREIGN KEY (line_id) REFERENCES line (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE Line_Station ADD CONSTRAINT FK_FD119BB221BDB235 FOREIGN KEY (station_id) REFERENCES station (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE ride ADD CONSTRAINT FK_9B3D7CD04D7B7542 FOREIGN KEY (line_id) REFERENCES line (id)');
        $this->addSql('ALTER TABLE ride ADD CONSTRAINT FK_9B3D7CD041B3BBAA FOREIGN KEY (Driver_id) REFERENCES driver (id)');
        $this->addSql('ALTER TABLE ride ADD CONSTRAINT FK_9B3D7CD01B0E1401 FOREIGN KEY (Vehicle_id) REFERENCES vehicle (id)');
        $this->addSql('ALTER TABLE station ADD CONSTRAINT FK_9F39F8B15B18A191 FOREIGN KEY (Position_id) REFERENCES position (id)');
        $this->addSql('ALTER TABLE Interstations ADD CONSTRAINT FK_91BACD4121BDB235 FOREIGN KEY (station_id) REFERENCES station (id)');
        $this->addSql('ALTER TABLE Interstations ADD CONSTRAINT FK_91BACD419E2A59F6 FOREIGN KEY (next_station_id) REFERENCES station (id)');
        $this->addSql('ALTER TABLE vehicle ADD CONSTRAINT FK_1B80E48664B48123 FOREIGN KEY (VehicleOwner_id) REFERENCES vehicle_owner (id)');
        $this->addSql('ALTER TABLE vehicle ADD CONSTRAINT FK_1B80E48697782B87 FOREIGN KEY (VehicleType_id) REFERENCES vehicle_type (id)');
        $this->addSql('ALTER TABLE api_token ADD CONSTRAINT FK_7BA2F5EBA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE evaluation ADD CONSTRAINT FK_1323A5759395C3F3 FOREIGN KEY (customer_id) REFERENCES customer (id)');
        $this->addSql('ALTER TABLE evaluation ADD CONSTRAINT FK_1323A575302A8A70 FOREIGN KEY (ride_id) REFERENCES ride (id)');
        $this->addSql('ALTER TABLE favorites ADD CONSTRAINT FK_E46960F54D7B7542 FOREIGN KEY (line_id) REFERENCES line (id)');
        $this->addSql('ALTER TABLE favorites ADD CONSTRAINT FK_E46960F56EE0B1E5 FOREIGN KEY (Station_id) REFERENCES station (id)');
        $this->addSql('ALTER TABLE favorites ADD CONSTRAINT FK_E46960F515094C24 FOREIGN KEY (Customer_id) REFERENCES customer (id)');
        $this->addSql('ALTER TABLE history ADD CONSTRAINT FK_27BA704BFF97B3EC FOREIGN KEY (Ride_id) REFERENCES ride (id)');
        $this->addSql('ALTER TABLE customer DROP firstname, DROP lastname');
        $this->addSql('ALTER TABLE user ADD username VARCHAR(180) NOT NULL, ADD roles JSON DEFAULT NULL, ADD password VARCHAR(255) NOT NULL, ADD email VARCHAR(255) NOT NULL, CHANGE firstname firstname VARCHAR(255) NOT NULL, CHANGE lastname lastname VARCHAR(255) NOT NULL');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649F85E0677 ON user (username)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE alert DROP FOREIGN KEY FK_17FD46C15B18A191');
        $this->addSql('ALTER TABLE event DROP FOREIGN KEY FK_3BAE0AA7DD842E46');
        $this->addSql('ALTER TABLE station DROP FOREIGN KEY FK_9F39F8B15B18A191');
        $this->addSql('ALTER TABLE Line_Station DROP FOREIGN KEY FK_FD119BB24D7B7542');
        $this->addSql('ALTER TABLE ride DROP FOREIGN KEY FK_9B3D7CD04D7B7542');
        $this->addSql('ALTER TABLE favorites DROP FOREIGN KEY FK_E46960F54D7B7542');
        $this->addSql('ALTER TABLE evaluation DROP FOREIGN KEY FK_1323A575302A8A70');
        $this->addSql('ALTER TABLE history DROP FOREIGN KEY FK_27BA704BFF97B3EC');
        $this->addSql('ALTER TABLE Line_Station DROP FOREIGN KEY FK_FD119BB221BDB235');
        $this->addSql('ALTER TABLE Interstations DROP FOREIGN KEY FK_91BACD4121BDB235');
        $this->addSql('ALTER TABLE Interstations DROP FOREIGN KEY FK_91BACD419E2A59F6');
        $this->addSql('ALTER TABLE favorites DROP FOREIGN KEY FK_E46960F56EE0B1E5');
        $this->addSql('ALTER TABLE position DROP FOREIGN KEY FK_462CE4F5545317D1');
        $this->addSql('ALTER TABLE ride DROP FOREIGN KEY FK_9B3D7CD01B0E1401');
        $this->addSql('ALTER TABLE alert DROP FOREIGN KEY FK_17FD46C1DCC1E873');
        $this->addSql('ALTER TABLE ride DROP FOREIGN KEY FK_9B3D7CD041B3BBAA');
        $this->addSql('ALTER TABLE line DROP FOREIGN KEY FK_D114B4F61108BE6');
        $this->addSql('ALTER TABLE vehicle DROP FOREIGN KEY FK_1B80E48664B48123');
        $this->addSql('ALTER TABLE vehicle DROP FOREIGN KEY FK_1B80E48697782B87');
        $this->addSql('DROP TABLE alert');
        $this->addSql('DROP TABLE event');
        $this->addSql('DROP TABLE position');
        $this->addSql('DROP TABLE line');
        $this->addSql('DROP TABLE Line_Station');
        $this->addSql('DROP TABLE ride');
        $this->addSql('DROP TABLE station');
        $this->addSql('DROP TABLE Interstations');
        $this->addSql('DROP TABLE vehicle');
        $this->addSql('DROP TABLE alert_type');
        $this->addSql('DROP TABLE api_token');
        $this->addSql('DROP TABLE driver');
        $this->addSql('DROP TABLE evaluation');
        $this->addSql('DROP TABLE favorites');
        $this->addSql('DROP TABLE history');
        $this->addSql('DROP TABLE interstation');
        $this->addSql('DROP TABLE line_staton');
        $this->addSql('DROP TABLE line_type');
        $this->addSql('DROP TABLE vehicle_owner');
        $this->addSql('DROP TABLE vehicle_type');
        $this->addSql('ALTER TABLE customer ADD firstname VARCHAR(50) NOT NULL COLLATE utf8mb4_unicode_ci, ADD lastname VARCHAR(50) NOT NULL COLLATE utf8mb4_unicode_ci');
        $this->addSql('DROP INDEX UNIQ_8D93D649F85E0677 ON user');
        $this->addSql('ALTER TABLE user DROP username, DROP roles, DROP password, DROP email, CHANGE firstname firstname VARCHAR(50) NOT NULL COLLATE utf8mb4_unicode_ci, CHANGE lastname lastname VARCHAR(50) NOT NULL COLLATE utf8mb4_unicode_ci');
    }
}
