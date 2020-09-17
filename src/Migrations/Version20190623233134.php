<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190623233134 extends AbstractMigration
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
        $this->addSql('DROP TABLE road');
        $this->addSql('DROP TABLE road_station');
        $this->addSql('ALTER TABLE event ADD audio LONGBLOB NOT NULL');
        $this->addSql('ALTER TABLE customer CHANGE id id INT AUTO_INCREMENT NOT NULL');
        $this->addSql('DROP INDEX IDX_27BA704B5992B8E4 ON history');
        $this->addSql('ALTER TABLE history DROP Road_id');
        $this->addSql('ALTER TABLE vehicle_owner ADD username VARCHAR(180) NOT NULL, ADD roles JSON DEFAULT NULL, ADD password VARCHAR(255) NOT NULL, ADD firstname VARCHAR(255) NOT NULL, ADD lastname VARCHAR(255) NOT NULL, ADD email VARCHAR(255) NOT NULL, DROP Name');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_ADCF6690F85E0677 ON vehicle_owner (username)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE road (id INT AUTO_INCREMENT NOT NULL, list_position VARCHAR(30) NOT NULL COLLATE utf8mb4_unicode_ci, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE road_station (road_id INT NOT NULL, station_id INT NOT NULL, INDEX IDX_16FD20DD962F8178 (road_id), INDEX IDX_16FD20DD21BDB235 (station_id), PRIMARY KEY(road_id, station_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE road_station ADD CONSTRAINT FK_16FD20DD21BDB235 FOREIGN KEY (station_id) REFERENCES station (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE road_station ADD CONSTRAINT FK_16FD20DD962F8178 FOREIGN KEY (road_id) REFERENCES road (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE customer CHANGE id id INT NOT NULL');
        $this->addSql('ALTER TABLE event DROP audio');
        $this->addSql('ALTER TABLE history ADD Road_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE history ADD CONSTRAINT FK_27BA704B5992B8E4 FOREIGN KEY (Road_id) REFERENCES road (id)');
        $this->addSql('CREATE INDEX IDX_27BA704B5992B8E4 ON history (Road_id)');
        $this->addSql('DROP INDEX UNIQ_ADCF6690F85E0677 ON vehicle_owner');
        $this->addSql('ALTER TABLE vehicle_owner ADD Name VARCHAR(50) DEFAULT \'0\' NOT NULL COLLATE utf8mb4_unicode_ci, DROP username, DROP roles, DROP password, DROP firstname, DROP lastname, DROP email');
    }
}
