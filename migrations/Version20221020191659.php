<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221020191659 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE project_frontend (project_id INT NOT NULL, frontend_id INT NOT NULL, INDEX IDX_F15F9547166D1F9C (project_id), INDEX IDX_F15F95472CB99B45 (frontend_id), PRIMARY KEY(project_id, frontend_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE project_backend (project_id INT NOT NULL, backend_id INT NOT NULL, INDEX IDX_19FBC514166D1F9C (project_id), INDEX IDX_19FBC514F92ABD28 (backend_id), PRIMARY KEY(project_id, backend_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE project_frontend ADD CONSTRAINT FK_F15F9547166D1F9C FOREIGN KEY (project_id) REFERENCES project (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE project_frontend ADD CONSTRAINT FK_F15F95472CB99B45 FOREIGN KEY (frontend_id) REFERENCES frontend (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE project_backend ADD CONSTRAINT FK_19FBC514166D1F9C FOREIGN KEY (project_id) REFERENCES project (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE project_backend ADD CONSTRAINT FK_19FBC514F92ABD28 FOREIGN KEY (backend_id) REFERENCES backend (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE project_frontend DROP FOREIGN KEY FK_F15F9547166D1F9C');
        $this->addSql('ALTER TABLE project_frontend DROP FOREIGN KEY FK_F15F95472CB99B45');
        $this->addSql('ALTER TABLE project_backend DROP FOREIGN KEY FK_19FBC514166D1F9C');
        $this->addSql('ALTER TABLE project_backend DROP FOREIGN KEY FK_19FBC514F92ABD28');
        $this->addSql('DROP TABLE project_frontend');
        $this->addSql('DROP TABLE project_backend');
    }
}
