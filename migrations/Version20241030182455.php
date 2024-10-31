<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241030182455 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE departments CHANGE diploma_required diploma_required TEXT NOT NULL, CHANGE diploma_delivered diploma_delivered TEXT NOT NULL');
        $this->addSql('ALTER TABLE formations CHANGE admission_condition admission_condition TEXT NOT NULL');
        $this->addSql('ALTER TABLE parcours DROP FOREIGN KEY FK_99B1DEE3AE80F5DF');
        $this->addSql('ALTER TABLE parcours ADD CONSTRAINT FK_99B1DEE3AE80F5DF FOREIGN KEY (department_id) REFERENCES departments (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE parcours DROP FOREIGN KEY FK_99B1DEE3AE80F5DF');
        $this->addSql('ALTER TABLE parcours ADD CONSTRAINT FK_99B1DEE3AE80F5DF FOREIGN KEY (department_id) REFERENCES departments (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE formations CHANGE admission_condition admission_condition TEXT NOT NULL');
        $this->addSql('ALTER TABLE departments CHANGE diploma_required diploma_required TEXT NOT NULL, CHANGE diploma_delivered diploma_delivered TEXT NOT NULL');
    }
}
