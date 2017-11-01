<?php

namespace AppBundle\Migrations;

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
        // Tables
        $this->addSql('CREATE TABLE ds_session (id VARCHAR(128) NOT NULL PRIMARY KEY, `data` BLOB NOT NULL, `time` INTEGER UNSIGNED NOT NULL, lifetime MEDIUMINT NOT NULL) COLLATE utf8_bin, engine = innodb');
        $this->addSql('CREATE TABLE ds_config (id INT AUTO_INCREMENT NOT NULL, uuid CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', `owner` VARCHAR(255) DEFAULT NULL, owner_uuid CHAR(36) DEFAULT NULL COMMENT \'(DC2Type:guid)\', `key` VARCHAR(255) NOT NULL, `value` LONGTEXT DEFAULT NULL, enabled TINYINT(1) NOT NULL, version INT DEFAULT 1 NOT NULL, created_at DATETIME DEFAULT NULL, updated_at DATETIME DEFAULT NULL, UNIQUE INDEX UNIQ_758C45F4D17F50A6 (uuid), UNIQUE INDEX UNIQ_758C45F44E645A7E (`key`), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ds_access (id INT AUTO_INCREMENT NOT NULL, uuid CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', `owner` VARCHAR(255) DEFAULT NULL, owner_uuid CHAR(36) DEFAULT NULL COMMENT \'(DC2Type:guid)\', identity VARCHAR(255) DEFAULT NULL, identity_uuid CHAR(36) DEFAULT NULL COMMENT \'(DC2Type:guid)\', version INT DEFAULT 1 NOT NULL, created_at DATETIME DEFAULT NULL, updated_at DATETIME DEFAULT NULL, UNIQUE INDEX UNIQ_A76F41DCD17F50A6 (uuid), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ds_access_permission (id INT AUTO_INCREMENT NOT NULL, access_id INT DEFAULT NULL, entity VARCHAR(255) DEFAULT NULL, entity_uuid CHAR(36) DEFAULT NULL COMMENT \'(DC2Type:guid)\', `key` VARCHAR(255) NOT NULL, attributes LONGTEXT NOT NULL COMMENT \'(DC2Type:json_array)\', INDEX IDX_D46DD4D04FEA67CF (access_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE app_category (id INT AUTO_INCREMENT NOT NULL, uuid CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', `owner` VARCHAR(255) DEFAULT NULL, owner_uuid CHAR(36) DEFAULT NULL COMMENT \'(DC2Type:guid)\', slug VARCHAR(255) NOT NULL, enabled TINYINT(1) NOT NULL, weight SMALLINT NOT NULL, version INT DEFAULT 1 NOT NULL, deleted_at DATETIME DEFAULT NULL, created_at DATETIME DEFAULT NULL, updated_at DATETIME DEFAULT NULL, UNIQUE INDEX UNIQ_ECC796CD17F50A6 (uuid), UNIQUE INDEX UNIQ_ECC796C989D9B62 (slug), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE app_category_trans (id INT AUTO_INCREMENT NOT NULL, translatable_id INT DEFAULT NULL, title VARCHAR(255) DEFAULT NULL, description LONGTEXT DEFAULT NULL, presentation LONGTEXT DEFAULT NULL, data LONGTEXT NOT NULL COMMENT \'(DC2Type:json_array)\', locale VARCHAR(255) NOT NULL, INDEX IDX_47E8C30A2C2AC5D3 (translatable_id), UNIQUE INDEX app_category_trans_unique_translation (translatable_id, locale), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE app_scenario (id INT AUTO_INCREMENT NOT NULL, service_id INT DEFAULT NULL, uuid CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', `owner` VARCHAR(255) DEFAULT NULL, owner_uuid CHAR(36) DEFAULT NULL COMMENT \'(DC2Type:guid)\', `type` VARCHAR(255) NOT NULL, config LONGTEXT NOT NULL COMMENT \'(DC2Type:json_array)\', slug VARCHAR(255) NOT NULL, enabled TINYINT(1) NOT NULL, weight SMALLINT NOT NULL, version INT DEFAULT 1 NOT NULL, deleted_at DATETIME DEFAULT NULL, created_at DATETIME DEFAULT NULL, updated_at DATETIME DEFAULT NULL, UNIQUE INDEX UNIQ_36C5A875D17F50A6 (uuid), INDEX IDX_36C5A875ED5CA9E6 (service_id), UNIQUE INDEX UNIQ_36C5A875ED5CA9E6989D9B62 (service_id, slug), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE app_scenario_trans (id INT AUTO_INCREMENT NOT NULL, translatable_id INT DEFAULT NULL, title VARCHAR(255) DEFAULT NULL, description LONGTEXT DEFAULT NULL, presentation LONGTEXT DEFAULT NULL, data LONGTEXT NOT NULL COMMENT \'(DC2Type:json_array)\', locale VARCHAR(255) NOT NULL, INDEX IDX_80D43D122C2AC5D3 (translatable_id), UNIQUE INDEX app_scenario_trans_unique_translation (translatable_id, locale), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE app_service (id INT AUTO_INCREMENT NOT NULL, uuid CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', `owner` VARCHAR(255) DEFAULT NULL, owner_uuid CHAR(36) DEFAULT NULL COMMENT \'(DC2Type:guid)\', slug VARCHAR(255) NOT NULL, enabled TINYINT(1) NOT NULL, weight SMALLINT NOT NULL, version INT DEFAULT 1 NOT NULL, deleted_at DATETIME DEFAULT NULL, created_at DATETIME DEFAULT NULL, updated_at DATETIME DEFAULT NULL, UNIQUE INDEX UNIQ_CC01A9FD17F50A6 (uuid), UNIQUE INDEX UNIQ_CC01A9F989D9B62 (slug), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE app_service_category (service_id INT NOT NULL, category_id INT NOT NULL, INDEX IDX_6B04A35DED5CA9E6 (service_id), INDEX IDX_6B04A35D12469DE2 (category_id), PRIMARY KEY(service_id, category_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE app_service_trans (id INT AUTO_INCREMENT NOT NULL, translatable_id INT DEFAULT NULL, title VARCHAR(255) DEFAULT NULL, description LONGTEXT DEFAULT NULL, presentation LONGTEXT DEFAULT NULL, data LONGTEXT NOT NULL COMMENT \'(DC2Type:json_array)\', locale VARCHAR(255) NOT NULL, INDEX IDX_432ECEF62C2AC5D3 (translatable_id), UNIQUE INDEX app_service_trans_unique_translation (translatable_id, locale), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE app_submission (id INT AUTO_INCREMENT NOT NULL, scenario_id INT DEFAULT NULL, uuid CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', `owner` VARCHAR(255) DEFAULT NULL, owner_uuid CHAR(36) DEFAULT NULL COMMENT \'(DC2Type:guid)\', identity VARCHAR(255) DEFAULT NULL, identity_uuid CHAR(36) DEFAULT NULL COMMENT \'(DC2Type:guid)\', data LONGTEXT NOT NULL COMMENT \'(DC2Type:json_array)\', state SMALLINT UNSIGNED NOT NULL, version INT DEFAULT 1 NOT NULL, deleted_at DATETIME DEFAULT NULL, created_at DATETIME DEFAULT NULL, updated_at DATETIME DEFAULT NULL, UNIQUE INDEX UNIQ_8D1EF18FD17F50A6 (uuid), INDEX IDX_8D1EF18FE04E49DF (scenario_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');

        // Foreign keys
        $this->addSql('ALTER TABLE ds_access_permission ADD CONSTRAINT FK_D46DD4D04FEA67CF FOREIGN KEY (access_id) REFERENCES ds_access (id)');
        $this->addSql('ALTER TABLE app_category_trans ADD CONSTRAINT FK_47E8C30A2C2AC5D3 FOREIGN KEY (translatable_id) REFERENCES app_category (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE app_scenario ADD CONSTRAINT FK_36C5A875ED5CA9E6 FOREIGN KEY (service_id) REFERENCES app_service (id)');
        $this->addSql('ALTER TABLE app_scenario_trans ADD CONSTRAINT FK_80D43D122C2AC5D3 FOREIGN KEY (translatable_id) REFERENCES app_scenario (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE app_service_category ADD CONSTRAINT FK_6B04A35DED5CA9E6 FOREIGN KEY (service_id) REFERENCES app_service (id)');
        $this->addSql('ALTER TABLE app_service_category ADD CONSTRAINT FK_6B04A35D12469DE2 FOREIGN KEY (category_id) REFERENCES app_category (id)');
        $this->addSql('ALTER TABLE app_service_trans ADD CONSTRAINT FK_432ECEF62C2AC5D3 FOREIGN KEY (translatable_id) REFERENCES app_service (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE app_submission ADD CONSTRAINT FK_8D1EF18FE04E49DF FOREIGN KEY (scenario_id) REFERENCES app_scenario (id)');

        // Data
        $this->addSql('
            INSERT INTO 
                `ds_config` (`id`, `uuid`, `owner`, `owner_uuid`, `key`, `value`, `enabled`, `version`, `created_at`, `updated_at`)
            VALUES 
                (1, \'a1612291-ec5d-43a6-b701-7a0e523359bb\', \'BusinessUnit\', \'11bec012-a73f-45c1-8d2e-53502fa58c23\', \'app.bpm.variables.api_url\', \'api_url\', 1, 1, now(), now()),
                (2, \'320660ba-07a7-4000-a970-78a8b4601a94\', \'BusinessUnit\', \'11bec012-a73f-45c1-8d2e-53502fa58c23\', \'app.bpm.variables.api_user\', \'api_user\', 1, 1, now(), now()),
                (3, \'9d9df387-3dc2-4301-8a86-b36f66b9ae6e\', \'BusinessUnit\', \'11bec012-a73f-45c1-8d2e-53502fa58c23\', \'app.bpm.variables.api_key\', \'api_key\', 1, 1, now(), now()),
                (4, \'1541eecc-9cbc-446d-9111-e06bd9b18045\', \'BusinessUnit\', \'11bec012-a73f-45c1-8d2e-53502fa58c23\', \'app.bpm.variables.service_uuid\', \'service_uuid\', 1, 1, now(), now()),
                (5, \'0da7715a-552b-47e3-ae68-9e86dd33a693\', \'BusinessUnit\', \'11bec012-a73f-45c1-8d2e-53502fa58c23\', \'app.bpm.variables.scenario_uuid\', \'scenario_uuid\', 1, 1, now(), now()),
                (6, \'689bc680-9f3c-4ab0-a7ff-29997e58c3b4\', \'BusinessUnit\', \'11bec012-a73f-45c1-8d2e-53502fa58c23\', \'app.bpm.variables.identity\', \'identity\', 1, 1, now(), now()),
                (7, \'0dc59760-2d99-401b-b5bc-99ff275f8a09\', \'BusinessUnit\', \'11bec012-a73f-45c1-8d2e-53502fa58c23\', \'app.bpm.variables.identity_uuid\', \'identity_uuid\', 1, 1, now(), now()),
                (8, \'fcadcae3-180b-4261-98d5-093788748c99\', \'BusinessUnit\', \'11bec012-a73f-45c1-8d2e-53502fa58c23\', \'app.bpm.variables.submission_uuid\', \'submission_uuid\', 1, 1, now(), now()),
                (9, \'674213cf-dd26-4ec9-952f-52db344b7970\', \'BusinessUnit\', \'11bec012-a73f-45c1-8d2e-53502fa58c23\', \'app.bpm.variables.start_data\', \'start_data\', 1, 1, now(), now()),
                (10, \'07e5372b-4d22-4bb2-a9db-816bfdc0a7f6\', \'BusinessUnit\', \'11bec012-a73f-45c1-8d2e-53502fa58c23\', \'ds_api.user.username\', \'system@ds\', 1, 1, now(), now()),
                (11, \'11ebfa24-d397-4876-ae03-fa791083f386\', \'BusinessUnit\', \'11bec012-a73f-45c1-8d2e-53502fa58c23\', \'ds_api.user.uuid\', \'b496655f-8fe6-4340-9a77-1bc3eeabab53\', 1, 1, now(), now()),
                (12, \'1780830f-0a16-4f16-be63-4d1577834a19\', \'BusinessUnit\', \'11bec012-a73f-45c1-8d2e-53502fa58c23\', \'ds_api.user.roles\', \'ROLE_SYSTEM\', 1, 1, now(), now()),
                (13, \'772f17ec-a46c-4090-9965-56e6839241f5\', \'BusinessUnit\', \'11bec012-a73f-45c1-8d2e-53502fa58c23\', \'ds_api.user.identity\', \'System\', 1, 1, now(), now()),
                (14, \'395c84cc-ac5c-4e95-a735-4c197281146c\', \'BusinessUnit\', \'11bec012-a73f-45c1-8d2e-53502fa58c23\', \'ds_api.user.identity_uuid\', \'df5fd904-aa47-452f-9c4a-d6b52fe5ace4\', 1, 1, now(), now()),
                (15, \'85aa90e0-ca2b-4bef-834b-eab8973a1c97\', \'BusinessUnit\', \'11bec012-a73f-45c1-8d2e-53502fa58c23\', \'ds_api.api.authentication.host\', \'http://127.0.0.1\', 1, 1, now(), now()),
                (16, \'98c231e4-9886-4d18-b31a-7a9f65fda57d\', \'BusinessUnit\', \'11bec012-a73f-45c1-8d2e-53502fa58c23\', \'ds_api.api.identities.host\', \'http://127.0.0.1\', 1, 1, now(), now()),
                (17, \'318d2df8-1e5c-47a1-b841-b7b60451833b\', \'BusinessUnit\', \'11bec012-a73f-45c1-8d2e-53502fa58c23\', \'ds_api.api.cases.host\', \'http://127.0.0.1\', 1, 1, now(), now()),
                (18, \'2dd9b153-5eb9-4a5d-bba0-5c21c6cdd5c7\', \'BusinessUnit\', \'11bec012-a73f-45c1-8d2e-53502fa58c23\', \'ds_api.api.services.host\', \'http://127.0.0.1\', 1, 1, now(), now()),
                (19, \'dd040562-6c77-47f2-929f-ecbfe9d90332\', \'BusinessUnit\', \'11bec012-a73f-45c1-8d2e-53502fa58c23\', \'ds_api.api.records.host\', \'http://127.0.0.1\', 1, 1, now(), now()),
                (20, \'adae1758-e6ee-4063-9b7f-86e434c1bc21\', \'BusinessUnit\', \'11bec012-a73f-45c1-8d2e-53502fa58c23\', \'ds_api.api.assets.host\', \'http://127.0.0.1\', 1, 1, now(), now()),
                (21, \'736c5591-832a-4d1c-8236-8b7b07c4a820\', \'BusinessUnit\', \'11bec012-a73f-45c1-8d2e-53502fa58c23\', \'ds_api.api.cms.host\', \'http://127.0.0.1\', 1, 1, now(), now()),
                (22, \'9e581cd1-0d89-4c26-a78a-b679dfe95fc2\', \'BusinessUnit\', \'11bec012-a73f-45c1-8d2e-53502fa58c23\', \'ds_api.api.camunda.host\', \'http://127.0.0.1/engine-rest\', 1, 1, now(), now()),
                (23, \'751954bd-177e-43c0-aab2-fb21c758de56\', \'BusinessUnit\', \'11bec012-a73f-45c1-8d2e-53502fa58c23\', \'ds_api.api.formio.host\', \'http://127.0.0.1\', 1, 1, now(), now());
        ');
        
        $this->addSql('
            INSERT INTO 
                `ds_access` (`id`, `uuid`, `owner`, `owner_uuid`, `identity`, `identity_uuid`, `version`, `created_at`, `updated_at`)
            VALUES 
                (1, \'09a02f6a-bb41-4e5a-96fe-b531cd80610e\', \'System\', \'df5fd904-aa47-452f-9c4a-d6b52fe5ace4\', \'System\', \'df5fd904-aa47-452f-9c4a-d6b52fe5ace4\', 1, now(), now()),
                (2, \'ff56f709-e8f9-43a6-8c0c-741ea15a4e3c\', \'BusinessUnit\', \'11bec012-a73f-45c1-8d2e-53502fa58c23\', \'System\', \'7b59586d-6924-47f3-bc1b-0dc207f5e80c\', 1, now(), now());
        ');

        $this->addSql('
            INSERT INTO 
                `ds_access_permission` (`id`, `access_id`, `entity`, `entity_uuid`, `key`, `attributes`)
            VALUES 
                (1, 1, \'BusinessUnit\', NULL, \'entity\', \'["BROWSE","READ","EDIT","ADD","DELETE"]\'),
                (2, 1, \'BusinessUnit\', NULL, \'property\', \'["BROWSE","READ","EDIT"]\'),
                (3, 1, \'BusinessUnit\', NULL, \'custom\', \'["BROWSE","READ","EDIT","ADD","DELETE","EXECUTE"]\'),
                (4, 2, \'BusinessUnit\', NULL, \'entity\', \'["BROWSE","READ","EDIT","ADD","DELETE"]\'),
                (5, 2, \'BusinessUnit\', NULL, \'property\', \'["BROWSE","READ","EDIT"]\'),
                (6, 2, \'BusinessUnit\', NULL, \'custom\', \'["BROWSE","READ","EDIT","ADD","DELETE","EXECUTE"]\');
        ');
    }

    /**
     * Down
     *
     * @param \Doctrine\DBAL\Schema\Schema $schema
     */
    public function down(Schema $schema)
    {
        // Foreign keys
        $this->addSql('ALTER TABLE ds_access_permission DROP FOREIGN KEY FK_D46DD4D04FEA67CF');
        $this->addSql('ALTER TABLE app_category_trans DROP FOREIGN KEY FK_47E8C30A2C2AC5D3');
        $this->addSql('ALTER TABLE app_service_category DROP FOREIGN KEY FK_6B04A35D12469DE2');
        $this->addSql('ALTER TABLE app_scenario_trans DROP FOREIGN KEY FK_80D43D122C2AC5D3');
        $this->addSql('ALTER TABLE app_submission DROP FOREIGN KEY FK_8D1EF18FE04E49DF');
        $this->addSql('ALTER TABLE app_scenario DROP FOREIGN KEY FK_36C5A875ED5CA9E6');
        $this->addSql('ALTER TABLE app_service_category DROP FOREIGN KEY FK_6B04A35DED5CA9E6');
        $this->addSql('ALTER TABLE app_service_trans DROP FOREIGN KEY FK_432ECEF62C2AC5D3');

        // Tables
        $this->addSql('DROP TABLE ds_config');
        $this->addSql('DROP TABLE ds_access');
        $this->addSql('DROP TABLE ds_access_permission');
        $this->addSql('DROP TABLE app_category');
        $this->addSql('DROP TABLE app_category_trans');
        $this->addSql('DROP TABLE app_scenario');
        $this->addSql('DROP TABLE app_scenario_trans');
        $this->addSql('DROP TABLE app_service');
        $this->addSql('DROP TABLE app_service_category');
        $this->addSql('DROP TABLE app_service_trans');
        $this->addSql('DROP TABLE app_submission');
        $this->addSql('DROP TABLE ds_session');
    }
}
