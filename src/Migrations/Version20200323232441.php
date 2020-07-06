<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200323232441 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE categorie (id INT AUTO_INCREMENT NOT NULL, titre VARCHAR(255) NOT NULL, motscles LONGTEXT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET UTF8 COLLATE `UTF8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE note (id INT AUTO_INCREMENT NOT NULL, note INT NOT NULL, avis LONGTEXT NOT NULL, date_enregistrement DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET UTF8 COLLATE `UTF8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE commentaire (id INT AUTO_INCREMENT NOT NULL, commentaire LONGTEXT NOT NULL, date_enregistrement DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET UTF8 COLLATE `UTF8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE photo (id INT AUTO_INCREMENT NOT NULL, photo1 VARCHAR(255) NOT NULL, photo2 VARCHAR(255) DEFAULT NULL, photo3 VARCHAR(255) DEFAULT NULL, photo4 VARCHAR(255) DEFAULT NULL, photo5 VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET UTF8 COLLATE `UTF8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE membre (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, pseudo VARCHAR(20) NOT NULL, nom VARCHAR(20) NOT NULL, prenom VARCHAR(20) NOT NULL, telephone VARCHAR(20) NOT NULL, civilite VARCHAR(1) NOT NULL, date_enregistrement DATETIME NOT NULL, UNIQUE INDEX UNIQ_F6B4FB29E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET UTF8 COLLATE `UTF8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE annonce (id INT AUTO_INCREMENT NOT NULL, titre VARCHAR(255) NOT NULL, description_courte VARCHAR(255) NOT NULL, description_longue LONGTEXT NOT NULL, prix DOUBLE PRECISION NOT NULL, adresse VARCHAR(50) NOT NULL, ville VARCHAR(20) NOT NULL, cp VARCHAR(5) NOT NULL, pays VARCHAR(20) NOT NULL, date_enregistrement DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET UTF8 COLLATE `UTF8_unicode_ci` ENGINE = InnoDB');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE categorie');
        $this->addSql('DROP TABLE note');
        $this->addSql('DROP TABLE commentaire');
        $this->addSql('DROP TABLE photo');
        $this->addSql('DROP TABLE membre');
        $this->addSql('DROP TABLE annonce');
    }
}
