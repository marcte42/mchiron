<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200712160010 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'sqlite', 'Migration can only be executed safely on \'sqlite\'.');

        $this->addSql('CREATE TABLE project_category (project_id INTEGER NOT NULL, category_id INTEGER NOT NULL, PRIMARY KEY(project_id, category_id))');
        $this->addSql('CREATE INDEX IDX_3B02921A166D1F9C ON project_category (project_id)');
        $this->addSql('CREATE INDEX IDX_3B02921A12469DE2 ON project_category (category_id)');
        $this->addSql('DROP INDEX IDX_E01FBE6A166D1F9C');
        $this->addSql('CREATE TEMPORARY TABLE __temp__images AS SELECT id, project_id, createddate, modifiedname, obsoletedate, name, link, priority FROM images');
        $this->addSql('DROP TABLE images');
        $this->addSql('CREATE TABLE images (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, project_id INTEGER NOT NULL, createddate DATETIME NOT NULL, modifiedname DATETIME DEFAULT NULL, obsoletedate DATETIME DEFAULT NULL, name VARCHAR(255) DEFAULT NULL COLLATE BINARY, link VARCHAR(2083) NOT NULL COLLATE BINARY, priority INTEGER NOT NULL, CONSTRAINT FK_E01FBE6A166D1F9C FOREIGN KEY (project_id) REFERENCES project (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO images (id, project_id, createddate, modifiedname, obsoletedate, name, link, priority) SELECT id, project_id, createddate, modifiedname, obsoletedate, name, link, priority FROM __temp__images');
        $this->addSql('DROP TABLE __temp__images');
        $this->addSql('CREATE INDEX IDX_E01FBE6A166D1F9C ON images (project_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'sqlite', 'Migration can only be executed safely on \'sqlite\'.');

        $this->addSql('DROP TABLE project_category');
        $this->addSql('DROP INDEX IDX_E01FBE6A166D1F9C');
        $this->addSql('CREATE TEMPORARY TABLE __temp__images AS SELECT id, project_id, createddate, modifiedname, obsoletedate, name, link, priority FROM images');
        $this->addSql('DROP TABLE images');
        $this->addSql('CREATE TABLE images (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, project_id INTEGER NOT NULL, createddate DATETIME NOT NULL, modifiedname DATETIME DEFAULT NULL, obsoletedate DATETIME DEFAULT NULL, name VARCHAR(255) DEFAULT NULL, link VARCHAR(2083) NOT NULL, priority INTEGER NOT NULL)');
        $this->addSql('INSERT INTO images (id, project_id, createddate, modifiedname, obsoletedate, name, link, priority) SELECT id, project_id, createddate, modifiedname, obsoletedate, name, link, priority FROM __temp__images');
        $this->addSql('DROP TABLE __temp__images');
        $this->addSql('CREATE INDEX IDX_E01FBE6A166D1F9C ON images (project_id)');
    }
}
