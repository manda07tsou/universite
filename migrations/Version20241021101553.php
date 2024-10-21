<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241021101553 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE adresses (id INT AUTO_INCREMENT NOT NULL, etablishment_id INT NOT NULL, adress VARCHAR(255) NOT NULL, province VARCHAR(255) NOT NULL, INDEX IDX_EF19255216BE0BCF (etablishment_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE contacts (id INT AUTO_INCREMENT NOT NULL, etablishment_id INT NOT NULL, phone1 VARCHAR(255) NOT NULL, phone2 VARCHAR(255) DEFAULT NULL, phone3 VARCHAR(255) DEFAULT NULL, email VARCHAR(255) DEFAULT NULL, facebook VARCHAR(255) DEFAULT NULL, whatsapp VARCHAR(255) DEFAULT NULL, website VARCHAR(255) DEFAULT NULL, UNIQUE INDEX UNIQ_3340157316BE0BCF (etablishment_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE departments (id INT AUTO_INCREMENT NOT NULL, formation_id INT NOT NULL, filiere_id INT NOT NULL, diploma_required TEXT NOT NULL, diploma_delivered TEXT NOT NULL, INDEX IDX_16AEB8D45200282E (formation_id), INDEX IDX_16AEB8D4180AA129 (filiere_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE etablishments (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, name VARCHAR(255) NOT NULL, about LONGTEXT DEFAULT NULL, logo VARCHAR(255) DEFAULT NULL, slogan VARCHAR(255) DEFAULT NULL, UNIQUE INDEX UNIQ_9E3448C3A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE filieres (id INT AUTO_INCREMENT NOT NULL, filiere VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE formations (id INT AUTO_INCREMENT NOT NULL, etablishment_id INT NOT NULL, type_formation TEXT NOT NULL, admission_condition TEXT NOT NULL, INDEX IDX_4090213716BE0BCF (etablishment_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE parcours (id INT AUTO_INCREMENT NOT NULL, department_id INT NOT NULL, parcour VARCHAR(255) NOT NULL, INDEX IDX_99B1DEE3AE80F5DF (department_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE users (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', available_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', delivered_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE adresses ADD CONSTRAINT FK_EF19255216BE0BCF FOREIGN KEY (etablishment_id) REFERENCES etablishments (id)');
        $this->addSql('ALTER TABLE contacts ADD CONSTRAINT FK_3340157316BE0BCF FOREIGN KEY (etablishment_id) REFERENCES etablishments (id)');
        $this->addSql('ALTER TABLE departments ADD CONSTRAINT FK_16AEB8D45200282E FOREIGN KEY (formation_id) REFERENCES formations (id)');
        $this->addSql('ALTER TABLE departments ADD CONSTRAINT FK_16AEB8D4180AA129 FOREIGN KEY (filiere_id) REFERENCES filieres (id)');
        $this->addSql('ALTER TABLE etablishments ADD CONSTRAINT FK_9E3448C3A76ED395 FOREIGN KEY (user_id) REFERENCES users (id)');
        $this->addSql('ALTER TABLE formations ADD CONSTRAINT FK_4090213716BE0BCF FOREIGN KEY (etablishment_id) REFERENCES etablishments (id)');
        $this->addSql('ALTER TABLE parcours ADD CONSTRAINT FK_99B1DEE3AE80F5DF FOREIGN KEY (department_id) REFERENCES departments (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE adresses DROP FOREIGN KEY FK_EF19255216BE0BCF');
        $this->addSql('ALTER TABLE contacts DROP FOREIGN KEY FK_3340157316BE0BCF');
        $this->addSql('ALTER TABLE departments DROP FOREIGN KEY FK_16AEB8D45200282E');
        $this->addSql('ALTER TABLE departments DROP FOREIGN KEY FK_16AEB8D4180AA129');
        $this->addSql('ALTER TABLE etablishments DROP FOREIGN KEY FK_9E3448C3A76ED395');
        $this->addSql('ALTER TABLE formations DROP FOREIGN KEY FK_4090213716BE0BCF');
        $this->addSql('ALTER TABLE parcours DROP FOREIGN KEY FK_99B1DEE3AE80F5DF');
        $this->addSql('DROP TABLE adresses');
        $this->addSql('DROP TABLE contacts');
        $this->addSql('DROP TABLE departments');
        $this->addSql('DROP TABLE etablishments');
        $this->addSql('DROP TABLE filieres');
        $this->addSql('DROP TABLE formations');
        $this->addSql('DROP TABLE parcours');
        $this->addSql('DROP TABLE users');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
