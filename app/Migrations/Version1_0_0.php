<?php

namespace Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Class Version1_0_0
 */
class Version1_0_0 extends AbstractMigration
{
    /**
     * Up
     *
     * @param \Doctrine\DBAL\Schema\Schema $schema
     */
    public function up(Schema $schema)
    {
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE ds_config (id INT AUTO_INCREMENT NOT NULL, uuid CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', `owner` VARCHAR(255) DEFAULT NULL, owner_uuid CHAR(36) DEFAULT NULL COMMENT \'(DC2Type:guid)\', `key` VARCHAR(255) NOT NULL, `value` LONGTEXT DEFAULT NULL, enabled TINYINT(1) NOT NULL, version INT DEFAULT 1 NOT NULL, created_at DATETIME DEFAULT NULL, updated_at DATETIME DEFAULT NULL, UNIQUE INDEX UNIQ_758C45F4D17F50A6 (uuid), UNIQUE INDEX UNIQ_758C45F44E645A7E (`key`), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ds_permission (id INT AUTO_INCREMENT NOT NULL, uuid CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', `owner` VARCHAR(255) DEFAULT NULL, owner_uuid CHAR(36) DEFAULT NULL COMMENT \'(DC2Type:guid)\', user_uuid CHAR(36) DEFAULT NULL COMMENT \'(DC2Type:guid)\', version INT DEFAULT 1 NOT NULL, created_at DATETIME DEFAULT NULL, updated_at DATETIME DEFAULT NULL, UNIQUE INDEX UNIQ_7A6F7670D17F50A6 (uuid), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ds_permission_entry (id INT AUTO_INCREMENT NOT NULL, permission_id INT DEFAULT NULL, business_unit_uuid CHAR(36) DEFAULT NULL COMMENT \'(DC2Type:guid)\', `key` VARCHAR(255) NOT NULL, attributes LONGTEXT NOT NULL COMMENT \'(DC2Type:json_array)\', INDEX IDX_E68A6391FED90CCA (permission_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ds_category (id INT AUTO_INCREMENT NOT NULL, uuid CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', `owner` VARCHAR(255) DEFAULT NULL, owner_uuid CHAR(36) DEFAULT NULL COMMENT \'(DC2Type:guid)\', enabled TINYINT(1) NOT NULL, version INT DEFAULT 1 NOT NULL, deleted_at DATETIME DEFAULT NULL, created_at DATETIME DEFAULT NULL, updated_at DATETIME DEFAULT NULL, UNIQUE INDEX UNIQ_587122C2D17F50A6 (uuid), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ds_category_trans (id INT AUTO_INCREMENT NOT NULL, translatable_id INT DEFAULT NULL, title VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, presentation LONGTEXT NOT NULL, deleted_at DATETIME DEFAULT NULL, created_at DATETIME DEFAULT NULL, updated_at DATETIME DEFAULT NULL, locale VARCHAR(255) NOT NULL, INDEX IDX_AC14890B2C2AC5D3 (translatable_id), UNIQUE INDEX ds_category_trans_unique_translation (translatable_id, locale), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ds_scenario (id INT AUTO_INCREMENT NOT NULL, service_id INT DEFAULT NULL, uuid CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', `owner` VARCHAR(255) DEFAULT NULL, owner_uuid CHAR(36) DEFAULT NULL COMMENT \'(DC2Type:guid)\', `type` VARCHAR(255) NOT NULL, data LONGTEXT NOT NULL COMMENT \'(DC2Type:json_array)\', enabled TINYINT(1) NOT NULL, weight SMALLINT NOT NULL, version INT DEFAULT 1 NOT NULL, deleted_at DATETIME DEFAULT NULL, created_at DATETIME DEFAULT NULL, updated_at DATETIME DEFAULT NULL, UNIQUE INDEX UNIQ_6078F3DBD17F50A6 (uuid), INDEX IDX_6078F3DBED5CA9E6 (service_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ds_scenario_trans (id INT AUTO_INCREMENT NOT NULL, translatable_id INT DEFAULT NULL, title VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, presentation LONGTEXT NOT NULL, deleted_at DATETIME DEFAULT NULL, created_at DATETIME DEFAULT NULL, updated_at DATETIME DEFAULT NULL, locale VARCHAR(255) NOT NULL, INDEX IDX_6B2877132C2AC5D3 (translatable_id), UNIQUE INDEX ds_scenario_trans_unique_translation (translatable_id, locale), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ds_service (id INT AUTO_INCREMENT NOT NULL, uuid CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', `owner` VARCHAR(255) DEFAULT NULL, owner_uuid CHAR(36) DEFAULT NULL COMMENT \'(DC2Type:guid)\', enabled TINYINT(1) NOT NULL, version INT DEFAULT 1 NOT NULL, deleted_at DATETIME DEFAULT NULL, created_at DATETIME DEFAULT NULL, updated_at DATETIME DEFAULT NULL, UNIQUE INDEX UNIQ_25F97AAD17F50A6 (uuid), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ds_service_category (service_id INT NOT NULL, category_id INT NOT NULL, INDEX IDX_E416D16EED5CA9E6 (service_id), INDEX IDX_E416D16E12469DE2 (category_id), PRIMARY KEY(service_id, category_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ds_service_trans (id INT AUTO_INCREMENT NOT NULL, translatable_id INT DEFAULT NULL, title VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, presentation LONGTEXT NOT NULL, deleted_at DATETIME DEFAULT NULL, created_at DATETIME DEFAULT NULL, updated_at DATETIME DEFAULT NULL, locale VARCHAR(255) NOT NULL, INDEX IDX_B152F0332C2AC5D3 (translatable_id), UNIQUE INDEX ds_service_trans_unique_translation (translatable_id, locale), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ds_submission (id INT AUTO_INCREMENT NOT NULL, scenario_id INT DEFAULT NULL, uuid CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', `owner` VARCHAR(255) DEFAULT NULL, owner_uuid CHAR(36) DEFAULT NULL COMMENT \'(DC2Type:guid)\', identity VARCHAR(255) DEFAULT NULL, identity_uuid CHAR(36) DEFAULT NULL COMMENT \'(DC2Type:guid)\', data LONGTEXT NOT NULL COMMENT \'(DC2Type:json_array)\', state SMALLINT UNSIGNED NOT NULL, version INT DEFAULT 1 NOT NULL, deleted_at DATETIME DEFAULT NULL, created_at DATETIME DEFAULT NULL, updated_at DATETIME DEFAULT NULL, UNIQUE INDEX UNIQ_4123BE29D17F50A6 (uuid), INDEX IDX_4123BE29E04E49DF (scenario_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE ds_permission_entry ADD CONSTRAINT FK_E68A6391FED90CCA FOREIGN KEY (permission_id) REFERENCES ds_permission (id)');
        $this->addSql('ALTER TABLE ds_category_trans ADD CONSTRAINT FK_AC14890B2C2AC5D3 FOREIGN KEY (translatable_id) REFERENCES ds_category (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE ds_scenario ADD CONSTRAINT FK_6078F3DBED5CA9E6 FOREIGN KEY (service_id) REFERENCES ds_service (id)');
        $this->addSql('ALTER TABLE ds_scenario_trans ADD CONSTRAINT FK_6B2877132C2AC5D3 FOREIGN KEY (translatable_id) REFERENCES ds_scenario (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE ds_service_category ADD CONSTRAINT FK_E416D16EED5CA9E6 FOREIGN KEY (service_id) REFERENCES ds_service (id)');
        $this->addSql('ALTER TABLE ds_service_category ADD CONSTRAINT FK_E416D16E12469DE2 FOREIGN KEY (category_id) REFERENCES ds_category (id)');
        $this->addSql('ALTER TABLE ds_service_trans ADD CONSTRAINT FK_B152F0332C2AC5D3 FOREIGN KEY (translatable_id) REFERENCES ds_service (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE ds_submission ADD CONSTRAINT FK_4123BE29E04E49DF FOREIGN KEY (scenario_id) REFERENCES ds_scenario (id)');
    }

    /**
     * Down
     *
     * @param \Doctrine\DBAL\Schema\Schema $schema
     */
    public function down(Schema $schema)
    {
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE ds_permission_entry DROP FOREIGN KEY FK_E68A6391FED90CCA');
        $this->addSql('ALTER TABLE ds_category_trans DROP FOREIGN KEY FK_AC14890B2C2AC5D3');
        $this->addSql('ALTER TABLE ds_service_category DROP FOREIGN KEY FK_E416D16E12469DE2');
        $this->addSql('ALTER TABLE ds_scenario_trans DROP FOREIGN KEY FK_6B2877132C2AC5D3');
        $this->addSql('ALTER TABLE ds_submission DROP FOREIGN KEY FK_4123BE29E04E49DF');
        $this->addSql('ALTER TABLE ds_scenario DROP FOREIGN KEY FK_6078F3DBED5CA9E6');
        $this->addSql('ALTER TABLE ds_service_category DROP FOREIGN KEY FK_E416D16EED5CA9E6');
        $this->addSql('ALTER TABLE ds_service_trans DROP FOREIGN KEY FK_B152F0332C2AC5D3');
        $this->addSql('DROP TABLE ds_config');
        $this->addSql('DROP TABLE ds_permission');
        $this->addSql('DROP TABLE ds_permission_entry');
        $this->addSql('DROP TABLE ds_category');
        $this->addSql('DROP TABLE ds_category_trans');
        $this->addSql('DROP TABLE ds_scenario');
        $this->addSql('DROP TABLE ds_scenario_trans');
        $this->addSql('DROP TABLE ds_service');
        $this->addSql('DROP TABLE ds_service_category');
        $this->addSql('DROP TABLE ds_service_trans');
        $this->addSql('DROP TABLE ds_submission');
    }
}
