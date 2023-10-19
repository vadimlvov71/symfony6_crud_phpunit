<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231016140933 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('CREATE TABLE employee
        (id BIGINT AUTO_INCREMENT NOT NULL, 
        name VARCHAR(255) NOT NULL, 
        last_name VARCHAR(255) NOT NULL, 
        email  VARCHAR(255) NOT NULL, 
        current_salary  VARCHAR(255) NOT NULL, 
        date_to_be_hired  DATETIME NOT NULL, 
        data_entity_created DATETIME NOT NULL, 
        date_entity_updated DATETIME DEFAULT NULL, 
        PRIMARY KEY(id)) 
        DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        //$this->addSql('ALTER TABLE employee DROP date_to_be_hired, DROP data_entity_created, DROP date_entity_updated, DROP current_salary');
    }
}
