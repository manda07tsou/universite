<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241028095925 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE departments CHANGE diploma_required diploma_required TEXT NOT NULL, CHANGE diploma_delivered diploma_delivered TEXT NOT NULL');
        $this->addSql('ALTER TABLE formations ADD formation_types VARCHAR(255) NOT NULL, DROP type_formation, CHANGE admission_condition admission_condition TEXT NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE formations ADD type_formation TEXT NOT NULL, DROP formation_types, CHANGE admission_condition admission_condition TEXT NOT NULL');
        $this->addSql('ALTER TABLE departments CHANGE diploma_required diploma_required TEXT NOT NULL, CHANGE diploma_delivered diploma_delivered TEXT NOT NULL');
    }
}
