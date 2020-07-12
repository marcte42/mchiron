<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200712154946 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'sqlite', 'Migration can only be executed safely on \'sqlite\'.');

        $this->addSql('CREATE TABLE category (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, createddate DATETIME NOT NULL, modifieddate DATETIME DEFAULT NULL, obsoletedate DATETIME DEFAULT NULL, name VARCHAR(255) NOT NULL, priority INTEGER NOT NULL)');
        $this->addSql('CREATE TABLE project (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, createddate DATETIME NOT NULL, modifieddate DATETIME DEFAULT NULL, obsoletedate DATETIME DEFAULT NULL, title VARCHAR(255) NOT NULL, description CLOB DEFAULT NULL, projectdate DATE DEFAULT NULL, client VARCHAR(255) DEFAULT NULL, priority INTEGER NOT NULL)');
        $this->addSql('CREATE TABLE images (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, project_id INTEGER NOT NULL, createddate DATETIME NOT NULL, modifiedname DATETIME DEFAULT NULL, obsoletedate DATETIME DEFAULT NULL, name VARCHAR(255) DEFAULT NULL, link VARCHAR(2083) NOT NULL, priority INTEGER NOT NULL)');
        $this->addSql('CREATE INDEX IDX_E01FBE6A166D1F9C ON images (project_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'sqlite', 'Migration can only be executed safely on \'sqlite\'.');

        $this->addSql('DROP TABLE category');
        $this->addSql('DROP TABLE project');
        $this->addSql('DROP TABLE images');
    }
}
