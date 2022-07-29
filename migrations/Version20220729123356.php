<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220729123356 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE abonnement ADD illustration VARCHAR(255) NOT NULL, ADD slug VARCHAR(255) NOT NULL, ADD description LONGTEXT NOT NULL, DROP date_start, DROP iduser, DROP date_end');
        $this->addSql('ALTER TABLE `order` ADD is_paid TINYINT(1) NOT NULL');
        $this->addSql('ALTER TABLE order_details ADD total DOUBLE PRECISION NOT NULL');
        $this->addSql('ALTER TABLE user CHANGE roles roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\'');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE abonnement ADD date_start DATE NOT NULL, ADD iduser BINARY(16) NOT NULL COMMENT \'(DC2Type:uuid)\', ADD date_end DATE NOT NULL, DROP illustration, DROP slug, DROP description');
        $this->addSql('ALTER TABLE `order` DROP is_paid');
        $this->addSql('ALTER TABLE order_details DROP total');
        $this->addSql('ALTER TABLE `user` CHANGE roles roles LONGTEXT NOT NULL COLLATE `utf8mb4_bin`');
    }
}
