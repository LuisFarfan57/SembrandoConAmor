<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200625152152 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE donacion_monetaria (id INT AUTO_INCREMENT NOT NULL, familia_id INT DEFAULT NULL, donador_id INT DEFAULT NULL, nombre VARCHAR(200) DEFAULT NULL, cantidad DOUBLE PRECISION NOT NULL, INDEX IDX_C4D82EE3D02563A3 (familia_id), INDEX IDX_C4D82EE380CDAE34 (donador_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE donacion_viveres (id INT AUTO_INCREMENT NOT NULL, familia_id INT DEFAULT NULL, donador_id INT DEFAULT NULL, nombre VARCHAR(200) NOT NULL, unidad_medida VARCHAR(20) NOT NULL, INDEX IDX_939A8D3AD02563A3 (familia_id), INDEX IDX_939A8D3A80CDAE34 (donador_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE donador (id INT AUTO_INCREMENT NOT NULL, nombre VARCHAR(255) NOT NULL, correo_electronico VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE familia (id INT AUTO_INCREMENT NOT NULL, primer_nombre VARCHAR(50) NOT NULL, segundo_nombre VARCHAR(50) DEFAULT NULL, primer_apellido VARCHAR(50) NOT NULL, segundo_apellido VARCHAR(50) DEFAULT NULL, telefono INT NOT NULL, direccion VARCHAR(200) DEFAULT NULL, integrantes INT NOT NULL, descripcion LONGTEXT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE donacion_monetaria ADD CONSTRAINT FK_C4D82EE3D02563A3 FOREIGN KEY (familia_id) REFERENCES familia (id)');
        $this->addSql('ALTER TABLE donacion_monetaria ADD CONSTRAINT FK_C4D82EE380CDAE34 FOREIGN KEY (donador_id) REFERENCES donador (id)');
        $this->addSql('ALTER TABLE donacion_viveres ADD CONSTRAINT FK_939A8D3AD02563A3 FOREIGN KEY (familia_id) REFERENCES familia (id)');
        $this->addSql('ALTER TABLE donacion_viveres ADD CONSTRAINT FK_939A8D3A80CDAE34 FOREIGN KEY (donador_id) REFERENCES donador (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE donacion_monetaria DROP FOREIGN KEY FK_C4D82EE380CDAE34');
        $this->addSql('ALTER TABLE donacion_viveres DROP FOREIGN KEY FK_939A8D3A80CDAE34');
        $this->addSql('ALTER TABLE donacion_monetaria DROP FOREIGN KEY FK_C4D82EE3D02563A3');
        $this->addSql('ALTER TABLE donacion_viveres DROP FOREIGN KEY FK_939A8D3AD02563A3');
        $this->addSql('DROP TABLE donacion_monetaria');
        $this->addSql('DROP TABLE donacion_viveres');
        $this->addSql('DROP TABLE donador');
        $this->addSql('DROP TABLE familia');
    }
}
