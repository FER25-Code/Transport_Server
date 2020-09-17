<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190409125434 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE customer CHANGE id id INT AUTO_INCREMENT NOT NULL');
        $this->addSql('ALTER TABLE history ADD Ride_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE history ADD CONSTRAINT FK_27BA704BFF97B3EC FOREIGN KEY (Ride_id) REFERENCES ride (id)');
        $this->addSql('CREATE INDEX IDX_27BA704BFF97B3EC ON history (Ride_id)');
        $this->addSql('ALTER TABLE ride ADD Vehicle_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE ride ADD CONSTRAINT FK_9B3D7CD01B0E1401 FOREIGN KEY (Vehicle_id) REFERENCES vehicle (id)');
        $this->addSql('CREATE INDEX IDX_9B3D7CD01B0E1401 ON ride (Vehicle_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE customer CHANGE id id INT NOT NULL');
        $this->addSql('ALTER TABLE history DROP FOREIGN KEY FK_27BA704BFF97B3EC');
        $this->addSql('DROP INDEX IDX_27BA704BFF97B3EC ON history');
        $this->addSql('ALTER TABLE history DROP Ride_id');
        $this->addSql('ALTER TABLE ride DROP FOREIGN KEY FK_9B3D7CD01B0E1401');
        $this->addSql('DROP INDEX IDX_9B3D7CD01B0E1401 ON ride');
        $this->addSql('ALTER TABLE ride DROP Vehicle_id');
    }
}
