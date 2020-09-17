<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190513001157 extends AbstractMigration
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
        $this->addSql('CREATE TABLE line_staton (id INT AUTO_INCREMENT NOT NULL, rank INT NOT NULL, stopduration INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('DROP TABLE roud');
        $this->addSql('DROP TABLE roud_station');
        $this->addSql('ALTER TABLE customer CHANGE id id INT AUTO_INCREMENT NOT NULL');
        $this->addSql('DROP INDEX UNIQ_8D93D649F85E0677 ON user');
        $this->addSql('ALTER TABLE user ADD passowrd VARCHAR(50) NOT NULL, DROP roles, DROP password, DROP email, CHANGE username username VARCHAR(50) NOT NULL, CHANGE firstname firstname VARCHAR(50) NOT NULL, CHANGE lastname lastname VARCHAR(50) NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE roud (id INT AUTO_INCREMENT NOT NULL, list_position VARCHAR(30) NOT NULL COLLATE utf8mb4_unicode_ci, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE roud_station (roud_id INT NOT NULL, station_id INT NOT NULL, INDEX IDX_38B8014F34FB03A (roud_id), INDEX IDX_38B8014F21BDB235 (station_id), PRIMARY KEY(roud_id, station_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE roud_station ADD CONSTRAINT FK_38B8014F21BDB235 FOREIGN KEY (station_id) REFERENCES station (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE roud_station ADD CONSTRAINT FK_38B8014F34FB03A FOREIGN KEY (roud_id) REFERENCES roud (id) ON DELETE CASCADE');
        $this->addSql('DROP TABLE line_staton');
        $this->addSql('ALTER TABLE customer CHANGE id id INT NOT NULL');
        $this->addSql('ALTER TABLE user ADD roles JSON NOT NULL, ADD password VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, ADD email VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, DROP passowrd, CHANGE firstname firstname VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, CHANGE lastname lastname VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, CHANGE username username VARCHAR(180) NOT NULL COLLATE utf8mb4_unicode_ci');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649F85E0677 ON user (username)');
    }
}
