<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221020191450 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE backend DROP FOREIGN KEY FK_8FE5C971166D1F9C');
        $this->addSql('DROP INDEX IDX_8FE5C971166D1F9C ON backend');
        $this->addSql('ALTER TABLE backend DROP project_id');
        $this->addSql('ALTER TABLE frontend DROP FOREIGN KEY FK_CC111E9C166D1F9C');
        $this->addSql('DROP INDEX IDX_CC111E9C166D1F9C ON frontend');
        $this->addSql('ALTER TABLE frontend DROP project_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE backend ADD project_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE backend ADD CONSTRAINT FK_8FE5C971166D1F9C FOREIGN KEY (project_id) REFERENCES project (id)');
        $this->addSql('CREATE INDEX IDX_8FE5C971166D1F9C ON backend (project_id)');
        $this->addSql('ALTER TABLE frontend ADD project_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE frontend ADD CONSTRAINT FK_CC111E9C166D1F9C FOREIGN KEY (project_id) REFERENCES project (id)');
        $this->addSql('CREATE INDEX IDX_CC111E9C166D1F9C ON frontend (project_id)');
    }
}
