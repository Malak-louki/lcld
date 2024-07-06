<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240706192242 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE graphics_card (id INT NOT NULL, chipset VARCHAR(255) DEFAULT NULL, memory INT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE keyboard (id INT NOT NULL, is_wireless TINYINT(1) DEFAULT NULL, has_numeric_keypad TINYINT(1) DEFAULT NULL, key_type VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE monitor (id INT NOT NULL, diagonal_size DOUBLE PRECISION DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE motherboard (id INT NOT NULL, socket VARCHAR(255) DEFAULT NULL, form_factor VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE mouse_pad (id INT NOT NULL, is_wireless TINYINT(1) DEFAULT NULL, buttons INT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE piece (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, brand VARCHAR(255) NOT NULL, buying_price DOUBLE PRECISION NOT NULL, quantity INT NOT NULL, is_archived TINYINT(1) NOT NULL, is_desktop TINYINT(1) NOT NULL, description LONGTEXT NOT NULL, category VARCHAR(255) DEFAULT NULL, type VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE power_supply (id INT NOT NULL, power INT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE processor (id INT NOT NULL, frequency DOUBLE PRECISION DEFAULT NULL, cores INT DEFAULT NULL, compatible_chipsets VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ram (id INT NOT NULL, capacity INT DEFAULT NULL, modules INT DEFAULT NULL, type_frequency VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE storage (id INT NOT NULL, storage_type VARCHAR(255) DEFAULT NULL, capacity INT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE graphics_card ADD CONSTRAINT FK_4172E761BF396750 FOREIGN KEY (id) REFERENCES piece (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE keyboard ADD CONSTRAINT FK_83748095BF396750 FOREIGN KEY (id) REFERENCES piece (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE monitor ADD CONSTRAINT FK_E1159985BF396750 FOREIGN KEY (id) REFERENCES piece (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE motherboard ADD CONSTRAINT FK_7F7A0F2BBF396750 FOREIGN KEY (id) REFERENCES piece (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE mouse_pad ADD CONSTRAINT FK_D17C3097BF396750 FOREIGN KEY (id) REFERENCES piece (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE power_supply ADD CONSTRAINT FK_C6E145F3BF396750 FOREIGN KEY (id) REFERENCES piece (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE processor ADD CONSTRAINT FK_29C04650BF396750 FOREIGN KEY (id) REFERENCES piece (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE ram ADD CONSTRAINT FK_E7D1222FBF396750 FOREIGN KEY (id) REFERENCES piece (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE storage ADD CONSTRAINT FK_547A1B34BF396750 FOREIGN KEY (id) REFERENCES piece (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user DROP is_aconceptor');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE graphics_card DROP FOREIGN KEY FK_4172E761BF396750');
        $this->addSql('ALTER TABLE keyboard DROP FOREIGN KEY FK_83748095BF396750');
        $this->addSql('ALTER TABLE monitor DROP FOREIGN KEY FK_E1159985BF396750');
        $this->addSql('ALTER TABLE motherboard DROP FOREIGN KEY FK_7F7A0F2BBF396750');
        $this->addSql('ALTER TABLE mouse_pad DROP FOREIGN KEY FK_D17C3097BF396750');
        $this->addSql('ALTER TABLE power_supply DROP FOREIGN KEY FK_C6E145F3BF396750');
        $this->addSql('ALTER TABLE processor DROP FOREIGN KEY FK_29C04650BF396750');
        $this->addSql('ALTER TABLE ram DROP FOREIGN KEY FK_E7D1222FBF396750');
        $this->addSql('ALTER TABLE storage DROP FOREIGN KEY FK_547A1B34BF396750');
        $this->addSql('DROP TABLE graphics_card');
        $this->addSql('DROP TABLE keyboard');
        $this->addSql('DROP TABLE monitor');
        $this->addSql('DROP TABLE motherboard');
        $this->addSql('DROP TABLE mouse_pad');
        $this->addSql('DROP TABLE piece');
        $this->addSql('DROP TABLE power_supply');
        $this->addSql('DROP TABLE processor');
        $this->addSql('DROP TABLE ram');
        $this->addSql('DROP TABLE storage');
        $this->addSql('ALTER TABLE `user` ADD is_aconceptor TINYINT(1) NOT NULL');
    }
}
