<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190513014534 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE roud_station DROP FOREIGN KEY FK_38B8014F34FB03A');
        $this->addSql('DROP TABLE roud');
        $this->addSql('DROP TABLE roud_station');
        $this->addSql('ALTER TABLE customer CHANGE id id INT AUTO_INCREMENT NOT NULL');
        $this->addSql('ALTER TABLE user CHANGE roles roles JSON NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE roud (id INT AUTO_INCREMENT NOT NULL, list_position VARCHAR(30) NOT NULL COLLATE utf8mb4_unicode_ci, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE roud_station (roud_id INT NOT NULL, station_id INT NOT NULL, INDEX IDX_38B8014F34FB03A (roud_id), INDEX IDX_38B8014F21BDB235 (station_id), PRIMARY KEY(roud_id, station_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE roud_station ADD CONSTRAINT FK_38B8014F21BDB235 FOREIGN KEY (station_id) REFERENCES station (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE roud_station ADD CONSTRAINT FK_38B8014F34FB03A FOREIGN KEY (roud_id) REFERENCES roud (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE customer CHANGE id id INT NOT NULL');
        $this->addSql('ALTER TABLE user CHANGE roles roles JSON DEFAULT NULL');
    }
}
