<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240713153933 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE model (id INT AUTO_INCREMENT NOT NULL, motherboard_id INT DEFAULT NULL, processor_id INT DEFAULT NULL, graphics_card_id INT DEFAULT NULL, keyboard_id INT DEFAULT NULL, mouse_pad_id INT DEFAULT NULL, power_supply_id INT DEFAULT NULL, name VARCHAR(255) DEFAULT NULL, is_desktop TINYINT(1) DEFAULT NULL, computer_creation_number INT DEFAULT NULL, add_date DATETIME DEFAULT NULL, description LONGTEXT DEFAULT NULL, total_price DOUBLE PRECISION DEFAULT NULL, is_archived TINYINT(1) DEFAULT NULL, INDEX IDX_D79572D96511E8A3 (motherboard_id), INDEX IDX_D79572D937BAC19A (processor_id), INDEX IDX_D79572D98060115D (graphics_card_id), INDEX IDX_D79572D9F17292C6 (keyboard_id), INDEX IDX_D79572D918E86070 (mouse_pad_id), INDEX IDX_D79572D98BC061D1 (power_supply_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE model_ram (model_id INT NOT NULL, ram_id INT NOT NULL, INDEX IDX_B21248D07975B7E7 (model_id), INDEX IDX_B21248D03366068 (ram_id), PRIMARY KEY(model_id, ram_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE model_monitor (model_id INT NOT NULL, monitor_id INT NOT NULL, INDEX IDX_8186F0747975B7E7 (model_id), INDEX IDX_8186F0744CE1C902 (monitor_id), PRIMARY KEY(model_id, monitor_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE model_storage (model_id INT NOT NULL, storage_id INT NOT NULL, INDEX IDX_34E972C57975B7E7 (model_id), INDEX IDX_34E972C55CC5DB90 (storage_id), PRIMARY KEY(model_id, storage_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE model ADD CONSTRAINT FK_D79572D96511E8A3 FOREIGN KEY (motherboard_id) REFERENCES motherboard (id)');
        $this->addSql('ALTER TABLE model ADD CONSTRAINT FK_D79572D937BAC19A FOREIGN KEY (processor_id) REFERENCES processor (id)');
        $this->addSql('ALTER TABLE model ADD CONSTRAINT FK_D79572D98060115D FOREIGN KEY (graphics_card_id) REFERENCES graphics_card (id)');
        $this->addSql('ALTER TABLE model ADD CONSTRAINT FK_D79572D9F17292C6 FOREIGN KEY (keyboard_id) REFERENCES keyboard (id)');
        $this->addSql('ALTER TABLE model ADD CONSTRAINT FK_D79572D918E86070 FOREIGN KEY (mouse_pad_id) REFERENCES mouse_pad (id)');
        $this->addSql('ALTER TABLE model ADD CONSTRAINT FK_D79572D98BC061D1 FOREIGN KEY (power_supply_id) REFERENCES power_supply (id)');
        $this->addSql('ALTER TABLE model_ram ADD CONSTRAINT FK_B21248D07975B7E7 FOREIGN KEY (model_id) REFERENCES model (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE model_ram ADD CONSTRAINT FK_B21248D03366068 FOREIGN KEY (ram_id) REFERENCES ram (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE model_monitor ADD CONSTRAINT FK_8186F0747975B7E7 FOREIGN KEY (model_id) REFERENCES model (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE model_monitor ADD CONSTRAINT FK_8186F0744CE1C902 FOREIGN KEY (monitor_id) REFERENCES monitor (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE model_storage ADD CONSTRAINT FK_34E972C57975B7E7 FOREIGN KEY (model_id) REFERENCES model (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE model_storage ADD CONSTRAINT FK_34E972C55CC5DB90 FOREIGN KEY (storage_id) REFERENCES storage (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE model DROP FOREIGN KEY FK_D79572D96511E8A3');
        $this->addSql('ALTER TABLE model DROP FOREIGN KEY FK_D79572D937BAC19A');
        $this->addSql('ALTER TABLE model DROP FOREIGN KEY FK_D79572D98060115D');
        $this->addSql('ALTER TABLE model DROP FOREIGN KEY FK_D79572D9F17292C6');
        $this->addSql('ALTER TABLE model DROP FOREIGN KEY FK_D79572D918E86070');
        $this->addSql('ALTER TABLE model DROP FOREIGN KEY FK_D79572D98BC061D1');
        $this->addSql('ALTER TABLE model_ram DROP FOREIGN KEY FK_B21248D07975B7E7');
        $this->addSql('ALTER TABLE model_ram DROP FOREIGN KEY FK_B21248D03366068');
        $this->addSql('ALTER TABLE model_monitor DROP FOREIGN KEY FK_8186F0747975B7E7');
        $this->addSql('ALTER TABLE model_monitor DROP FOREIGN KEY FK_8186F0744CE1C902');
        $this->addSql('ALTER TABLE model_storage DROP FOREIGN KEY FK_34E972C57975B7E7');
        $this->addSql('ALTER TABLE model_storage DROP FOREIGN KEY FK_34E972C55CC5DB90');
        $this->addSql('DROP TABLE model');
        $this->addSql('DROP TABLE model_ram');
        $this->addSql('DROP TABLE model_monitor');
        $this->addSql('DROP TABLE model_storage');
    }
}
