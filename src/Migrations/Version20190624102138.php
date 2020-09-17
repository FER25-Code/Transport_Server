<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190624102138 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE history DROP FOREIGN KEY FK_27BA704B5992B8E4');
        $this->addSql('ALTER TABLE road_station DROP FOREIGN KEY FK_16FD20DD962F8178');
        $this->addSql('DROP TABLE interstations');
        $this->addSql('DROP TABLE road');
        $this->addSql('DROP TABLE road_station');
        $this->addSql('ALTER TABLE alert DROP FOREIGN KEY FK_17FD46C15B18A191');
        $this->addSql('DROP INDEX IDX_17FD46C15B18A191 ON alert');
        $this->addSql('ALTER TABLE alert DROP latitude, DROP longitude, CHANGE position_id Line_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE alert ADD CONSTRAINT FK_17FD46C182C64CDE FOREIGN KEY (Line_id) REFERENCES line (id)');
        $this->addSql('CREATE INDEX IDX_17FD46C182C64CDE ON alert (Line_id)');
        $this->addSql('ALTER TABLE user DROP roles');
        $this->addSql('ALTER TABLE customer ADD username VARCHAR(180) NOT NULL, ADD password VARCHAR(255) NOT NULL, ADD firstname VARCHAR(255) NOT NULL, ADD lastname VARCHAR(255) NOT NULL, ADD email VARCHAR(255) NOT NULL, CHANGE id id INT AUTO_INCREMENT NOT NULL');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_81398E09F85E0677 ON customer (username)');
        $this->addSql('ALTER TABLE driver ADD username VARCHAR(180) NOT NULL, ADD password VARCHAR(255) NOT NULL, ADD firstname VARCHAR(255) NOT NULL, ADD lastname VARCHAR(255) NOT NULL, ADD email VARCHAR(255) NOT NULL');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_11667CD9F85E0677 ON driver (username)');
        $this->addSql('DROP INDEX IDX_27BA704B5992B8E4 ON history');
        $this->addSql('ALTER TABLE history DROP Road_id');
        $this->addSql('ALTER TABLE interstation ADD one_Station INT DEFAULT NULL, ADD other_Station INT DEFAULT NULL');
        $this->addSql('ALTER TABLE interstation ADD CONSTRAINT FK_C9FA7DE3309FDC03 FOREIGN KEY (one_Station) REFERENCES station (id)');
        $this->addSql('ALTER TABLE interstation ADD CONSTRAINT FK_C9FA7DE343D95F41 FOREIGN KEY (other_Station) REFERENCES station (id)');
        $this->addSql('CREATE INDEX IDX_C9FA7DE3309FDC03 ON interstation (one_Station)');
        $this->addSql('CREATE INDEX IDX_C9FA7DE343D95F41 ON interstation (other_Station)');
        $this->addSql('ALTER TABLE line_station DROP FOREIGN KEY FK_FD119BB221BDB235');
        $this->addSql('ALTER TABLE line_station DROP FOREIGN KEY FK_FD119BB24D7B7542');
        $this->addSql('ALTER TABLE line_station DROP PRIMARY KEY');
        $this->addSql('ALTER TABLE line_station ADD id INT AUTO_INCREMENT NOT NULL, ADD rank INT NOT NULL, ADD stopduration INT NOT NULL, CHANGE line_id line_id INT DEFAULT NULL, CHANGE station_id station_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE line_station ADD CONSTRAINT FK_2A9D79D621BDB235 FOREIGN KEY (station_id) REFERENCES station (id)');
        $this->addSql('ALTER TABLE line_station ADD CONSTRAINT FK_2A9D79D64D7B7542 FOREIGN KEY (line_id) REFERENCES line (id)');
        $this->addSql('ALTER TABLE line_station ADD PRIMARY KEY (id)');
        $this->addSql('ALTER TABLE line_station RENAME INDEX idx_fd119bb221bdb235 TO IDX_2A9D79D621BDB235');
        $this->addSql('ALTER TABLE line_station RENAME INDEX idx_fd119bb24d7b7542 TO IDX_2A9D79D64D7B7542');
        $this->addSql('ALTER TABLE position DROP timestamp');
        $this->addSql('ALTER TABLE station CHANGE name name VARCHAR(30) NOT NULL');
        $this->addSql('ALTER TABLE vehicle ADD on_station INT NOT NULL, ADD latitude DOUBLE PRECISION NOT NULL, ADD longitude DOUBLE PRECISION NOT NULL, DROP register_nbr, DROP max_siege');
        $this->addSql('ALTER TABLE vehicle_owner ADD username VARCHAR(180) NOT NULL, ADD password VARCHAR(255) NOT NULL, ADD firstname VARCHAR(255) NOT NULL, ADD lastname VARCHAR(255) NOT NULL, ADD email VARCHAR(255) NOT NULL, DROP Name');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_ADCF6690F85E0677 ON vehicle_owner (username)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE interstations (station_id INT NOT NULL, next_station_id INT NOT NULL, INDEX IDX_91BACD4121BDB235 (station_id), INDEX IDX_91BACD419E2A59F6 (next_station_id), PRIMARY KEY(station_id, next_station_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE road (id INT AUTO_INCREMENT NOT NULL, list_position VARCHAR(30) NOT NULL COLLATE utf8mb4_unicode_ci, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE road_station (road_id INT NOT NULL, station_id INT NOT NULL, INDEX IDX_16FD20DD962F8178 (road_id), INDEX IDX_16FD20DD21BDB235 (station_id), PRIMARY KEY(road_id, station_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE interstations ADD CONSTRAINT FK_91BACD4121BDB235 FOREIGN KEY (station_id) REFERENCES station (id)');
        $this->addSql('ALTER TABLE interstations ADD CONSTRAINT FK_91BACD419E2A59F6 FOREIGN KEY (next_station_id) REFERENCES station (id)');
        $this->addSql('ALTER TABLE road_station ADD CONSTRAINT FK_16FD20DD21BDB235 FOREIGN KEY (station_id) REFERENCES station (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE road_station ADD CONSTRAINT FK_16FD20DD962F8178 FOREIGN KEY (road_id) REFERENCES road (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE alert DROP FOREIGN KEY FK_17FD46C182C64CDE');
        $this->addSql('DROP INDEX IDX_17FD46C182C64CDE ON alert');
        $this->addSql('ALTER TABLE alert ADD latitude DOUBLE PRECISION NOT NULL, ADD longitude DOUBLE PRECISION NOT NULL, CHANGE line_id Position_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE alert ADD CONSTRAINT FK_17FD46C15B18A191 FOREIGN KEY (Position_id) REFERENCES position (id)');
        $this->addSql('CREATE INDEX IDX_17FD46C15B18A191 ON alert (Position_id)');
        $this->addSql('DROP INDEX UNIQ_81398E09F85E0677 ON customer');
        $this->addSql('ALTER TABLE customer DROP username, DROP password, DROP firstname, DROP lastname, DROP email, CHANGE id id INT NOT NULL');
        $this->addSql('DROP INDEX UNIQ_11667CD9F85E0677 ON driver');
        $this->addSql('ALTER TABLE driver DROP username, DROP password, DROP firstname, DROP lastname, DROP email');
        $this->addSql('ALTER TABLE history ADD Road_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE history ADD CONSTRAINT FK_27BA704B5992B8E4 FOREIGN KEY (Road_id) REFERENCES road (id)');
        $this->addSql('CREATE INDEX IDX_27BA704B5992B8E4 ON history (Road_id)');
        $this->addSql('ALTER TABLE interstation DROP FOREIGN KEY FK_C9FA7DE3309FDC03');
        $this->addSql('ALTER TABLE interstation DROP FOREIGN KEY FK_C9FA7DE343D95F41');
        $this->addSql('DROP INDEX IDX_C9FA7DE3309FDC03 ON interstation');
        $this->addSql('DROP INDEX IDX_C9FA7DE343D95F41 ON interstation');
        $this->addSql('ALTER TABLE interstation DROP one_Station, DROP other_Station');
        $this->addSql('ALTER TABLE line_station MODIFY id INT NOT NULL');
        $this->addSql('ALTER TABLE line_station DROP FOREIGN KEY FK_2A9D79D621BDB235');
        $this->addSql('ALTER TABLE line_station DROP FOREIGN KEY FK_2A9D79D64D7B7542');
        $this->addSql('ALTER TABLE line_station DROP PRIMARY KEY');
        $this->addSql('ALTER TABLE line_station DROP id, DROP rank, DROP stopduration, CHANGE station_id station_id INT NOT NULL, CHANGE line_id line_id INT NOT NULL');
        $this->addSql('ALTER TABLE line_station ADD CONSTRAINT FK_FD119BB221BDB235 FOREIGN KEY (station_id) REFERENCES station (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE line_station ADD CONSTRAINT FK_FD119BB24D7B7542 FOREIGN KEY (line_id) REFERENCES line (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE line_station ADD PRIMARY KEY (line_id, station_id)');
        $this->addSql('ALTER TABLE line_station RENAME INDEX idx_2a9d79d64d7b7542 TO IDX_FD119BB24D7B7542');
        $this->addSql('ALTER TABLE line_station RENAME INDEX idx_2a9d79d621bdb235 TO IDX_FD119BB221BDB235');
        $this->addSql('ALTER TABLE position ADD timestamp INT NOT NULL');
        $this->addSql('ALTER TABLE station CHANGE name name VARCHAR(225) NOT NULL COLLATE utf8mb4_unicode_ci');
        $this->addSql('ALTER TABLE user ADD roles JSON DEFAULT NULL');
        $this->addSql('ALTER TABLE vehicle ADD max_siege INT NOT NULL, DROP latitude, DROP longitude, CHANGE on_station register_nbr INT NOT NULL');
        $this->addSql('DROP INDEX UNIQ_ADCF6690F85E0677 ON vehicle_owner');
        $this->addSql('ALTER TABLE vehicle_owner ADD Name VARCHAR(50) DEFAULT \'0\' NOT NULL COLLATE utf8mb4_unicode_ci, DROP username, DROP password, DROP firstname, DROP lastname, DROP email');
    }
}
