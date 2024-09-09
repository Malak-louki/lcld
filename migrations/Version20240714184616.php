<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240714184616 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE comments (id INT AUTO_INCREMENT NOT NULL, editor_id INT DEFAULT NULL, comment_date DATETIME DEFAULT NULL, is_read TINYINT(1) DEFAULT NULL, comment LONGTEXT DEFAULT NULL, INDEX IDX_5F9E962A6995AC4C (editor_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE stock_history (id INT AUTO_INCREMENT NOT NULL, piece_id INT DEFAULT NULL, quantitychange INT DEFAULT NULL, change_date DATETIME DEFAULT NULL, INDEX IDX_3E1C60E8C40FCFA8 (piece_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE comments ADD CONSTRAINT FK_5F9E962A6995AC4C FOREIGN KEY (editor_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE stock_history ADD CONSTRAINT FK_3E1C60E8C40FCFA8 FOREIGN KEY (piece_id) REFERENCES piece (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE comments DROP FOREIGN KEY FK_5F9E962A6995AC4C');
        $this->addSql('ALTER TABLE stock_history DROP FOREIGN KEY FK_3E1C60E8C40FCFA8');
        $this->addSql('DROP TABLE comments');
        $this->addSql('DROP TABLE stock_history');
    }
}
