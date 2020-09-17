<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190409105516 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE alert (id INT AUTO_INCREMENT NOT NULL, comment VARCHAR(30) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE alert_type (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(30) NOT NULL, descripton VARCHAR(30) NOT NULL, level INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE driver (id INT AUTO_INCREMENT NOT NULL, drivinglicence INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE evaluation (id INT AUTO_INCREMENT NOT NULL, comment VARCHAR(30) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE event (id INT AUTO_INCREMENT NOT NULL, description VARCHAR(30) NOT NULL, start_date VARCHAR(30) NOT NULL, end_date VARCHAR(30) NOT NULL, name VARCHAR(30) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE favorites (id INT AUTO_INCREMENT NOT NULL, rank INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE history (id INT AUTO_INCREMENT NOT NULL, start_date DATE NOT NULL, end_date VARCHAR(30) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE line_staton (id INT AUTO_INCREMENT NOT NULL, rank INT NOT NULL, stopduration INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE line_type (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(30) NOT NULL, code INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE position (id INT AUTO_INCREMENT NOT NULL, latitude INT NOT NULL, longitude INT NOT NULL, time_stop VARCHAR(30) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE roud (id INT AUTO_INCREMENT NOT NULL, list_position VARCHAR(30) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE station (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(30) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE vehicle (id INT AUTO_INCREMENT NOT NULL, nbr_bus INT NOT NULL, mark VARCHAR(30) NOT NULL, register_nbr INT NOT NULL, max_siege INT NOT NULL, vehicle_type VARCHAR(30) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE vehicle_owner (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE vehicle_type (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(30) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE alert');
        $this->addSql('DROP TABLE alert_type');
        $this->addSql('DROP TABLE driver');
        $this->addSql('DROP TABLE evaluation');
        $this->addSql('DROP TABLE event');
        $this->addSql('DROP TABLE favorites');
        $this->addSql('DROP TABLE history');
        $this->addSql('DROP TABLE line_staton');
        $this->addSql('DROP TABLE line_type');
        $this->addSql('DROP TABLE position');
        $this->addSql('DROP TABLE roud');
        $this->addSql('DROP TABLE station');
        $this->addSql('DROP TABLE vehicle');
        $this->addSql('DROP TABLE vehicle_owner');
        $this->addSql('DROP TABLE vehicle_type');
    }
}
