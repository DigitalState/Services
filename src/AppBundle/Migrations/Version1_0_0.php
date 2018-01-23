<?php

namespace AppBundle\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;
use Ramsey\Uuid\Uuid;
use Symfony\Component\Yaml\Yaml;

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
        $yml = file_get_contents('/srv/api-platform/src/AppBundle/Resources/migrations/1_0_0.yml');
        $data = Yaml::parse($yml);

        $this->addSql('
            INSERT INTO 
                `ds_config` (`id`, `uuid`, `owner`, `owner_uuid`, `key`, `value`, `enabled`, `version`, `created_at`, `updated_at`)
            VALUES 
                (1, \''.Uuid::uuid4()->toString().'\', \'BusinessUnit\', \''.$data['business_unit']['administration']['uuid'].'\', \'app.bpm.variables.api_url\', \'api_url\', 1, 1, now(), now()),
                (2, \''.Uuid::uuid4()->toString().'\', \'BusinessUnit\', \''.$data['business_unit']['administration']['uuid'].'\', \'app.bpm.variables.api_user\', \'api_user\', 1, 1, now(), now()),
                (3, \''.Uuid::uuid4()->toString().'\', \'BusinessUnit\', \''.$data['business_unit']['administration']['uuid'].'\', \'app.bpm.variables.api_key\', \'api_key\', 1, 1, now(), now()),
                (4, \''.Uuid::uuid4()->toString().'\', \'BusinessUnit\', \''.$data['business_unit']['administration']['uuid'].'\', \'app.bpm.variables.service_uuid\', \'service_uuid\', 1, 1, now(), now()),
                (5, \''.Uuid::uuid4()->toString().'\', \'BusinessUnit\', \''.$data['business_unit']['administration']['uuid'].'\', \'app.bpm.variables.scenario_uuid\', \'scenario_uuid\', 1, 1, now(), now()),
                (6, \''.Uuid::uuid4()->toString().'\', \'BusinessUnit\', \''.$data['business_unit']['administration']['uuid'].'\', \'app.bpm.variables.identity\', \'identity\', 1, 1, now(), now()),
                (7, \''.Uuid::uuid4()->toString().'\', \'BusinessUnit\', \''.$data['business_unit']['administration']['uuid'].'\', \'app.bpm.variables.identity_uuid\', \'identity_uuid\', 1, 1, now(), now()),
                (8, \''.Uuid::uuid4()->toString().'\', \'BusinessUnit\', \''.$data['business_unit']['administration']['uuid'].'\', \'app.bpm.variables.submission_uuid\', \'submission_uuid\', 1, 1, now(), now()),
                (9, \''.Uuid::uuid4()->toString().'\', \'BusinessUnit\', \''.$data['business_unit']['administration']['uuid'].'\', \'app.bpm.variables.start_data\', \'start_data\', 1, 1, now(), now()),
                (10, \''.Uuid::uuid4()->toString().'\', \'BusinessUnit\', \''.$data['business_unit']['administration']['uuid'].'\', \'ds_api.user.username\', \'system@ds\', 1, 1, now(), now()),
                (11, \''.Uuid::uuid4()->toString().'\', \'BusinessUnit\', \''.$data['business_unit']['administration']['uuid'].'\', \'ds_api.user.uuid\', \''.$data['user']['system']['uuid'].'\', 1, 1, now(), now()),
                (12, \''.Uuid::uuid4()->toString().'\', \'BusinessUnit\', \''.$data['business_unit']['administration']['uuid'].'\', \'ds_api.user.roles\', \'ROLE_SYSTEM\', 1, 1, now(), now()),
                (13, \''.Uuid::uuid4()->toString().'\', \'BusinessUnit\', \''.$data['business_unit']['administration']['uuid'].'\', \'ds_api.user.identity\', \'System\', 1, 1, now(), now()),
                (14, \''.Uuid::uuid4()->toString().'\', \'BusinessUnit\', \''.$data['business_unit']['administration']['uuid'].'\', \'ds_api.user.identity_uuid\', \''.$data['identity']['system']['uuid'].'\', 1, 1, now(), now()),
                (15, \''.Uuid::uuid4()->toString().'\', \'BusinessUnit\', \''.$data['business_unit']['administration']['uuid'].'\', \'ds_api.api.assets.host\', \''.$data['config']['ds_api.api.assets.host']['value'].'\', 1, 1, now(), now()),
                (16, \''.Uuid::uuid4()->toString().'\', \'BusinessUnit\', \''.$data['business_unit']['administration']['uuid'].'\', \'ds_api.api.authentication.host\', \''.$data['config']['ds_api.api.authentication.host']['value'].'\', 1, 1, now(), now()),
                (17, \''.Uuid::uuid4()->toString().'\', \'BusinessUnit\', \''.$data['business_unit']['administration']['uuid'].'\', \'ds_api.api.camunda.host\', \''.$data['config']['ds_api.api.camunda.host']['value'].'\', 1, 1, now(), now()),
                (18, \''.Uuid::uuid4()->toString().'\', \'BusinessUnit\', \''.$data['business_unit']['administration']['uuid'].'\', \'ds_api.api.cases.host\', \''.$data['config']['ds_api.api.cases.host']['value'].'\', 1, 1, now(), now()),
                (19, \''.Uuid::uuid4()->toString().'\', \'BusinessUnit\', \''.$data['business_unit']['administration']['uuid'].'\', \'ds_api.api.cms.host\', \''.$data['config']['ds_api.api.cms.host']['value'].'\', 1, 1, now(), now()),
                (20, \''.Uuid::uuid4()->toString().'\', \'BusinessUnit\', \''.$data['business_unit']['administration']['uuid'].'\', \'ds_api.api.formio.host\', \''.$data['config']['ds_api.api.formio.host']['value'].'\', 1, 1, now(), now()),
                (21, \''.Uuid::uuid4()->toString().'\', \'BusinessUnit\', \''.$data['business_unit']['administration']['uuid'].'\', \'ds_api.api.identities.host\', \''.$data['config']['ds_api.api.identities.host']['value'].'\', 1, 1, now(), now()),
                (22, \''.Uuid::uuid4()->toString().'\', \'BusinessUnit\', \''.$data['business_unit']['administration']['uuid'].'\', \'ds_api.api.records.host\', \''.$data['config']['ds_api.api.records.host']['value'].'\', 1, 1, now(), now()),
                (23, \''.Uuid::uuid4()->toString().'\', \'BusinessUnit\', \''.$data['business_unit']['administration']['uuid'].'\', \'ds_api.api.services.host\', \''.$data['config']['ds_api.api.services.host']['value'].'\', 1, 1, now(), now()),
                (24, \''.Uuid::uuid4()->toString().'\', \'BusinessUnit\', \''.$data['business_unit']['administration']['uuid'].'\', \'ds_api.api.tasks.host\', \''.$data['config']['ds_api.api.tasks.host']['value'].'\', 1, 1, now(), now());
        ');

        $this->addSql('
            INSERT INTO 
                `ds_access` (`id`, `uuid`, `owner`, `owner_uuid`, `identity`, `identity_uuid`, `version`, `created_at`, `updated_at`)
            VALUES 
                (1, \''.Uuid::uuid4()->toString().'\', \'System\', \''.$data['identity']['system']['uuid'].'\', \'System\', \''.$data['identity']['system']['uuid'].'\', 1, now(), now()),
                (2, \''.Uuid::uuid4()->toString().'\', \'BusinessUnit\', \''.$data['business_unit']['administration']['uuid'].'\', \'Anonymous\', NULL, 1, now(), now()),
                (3, \''.Uuid::uuid4()->toString().'\', \'BusinessUnit\', \''.$data['business_unit']['administration']['uuid'].'\', \'Individual\', NULL, 1, now(), now()),
                (4, \''.Uuid::uuid4()->toString().'\', \'BusinessUnit\', \''.$data['business_unit']['administration']['uuid'].'\', \'Organization\', NULL, 1, now(), now()),
                (5, \''.Uuid::uuid4()->toString().'\', \'BusinessUnit\', \''.$data['business_unit']['administration']['uuid'].'\', \'Staff\', NULL, 1, now(), now()),
                (6, \''.Uuid::uuid4()->toString().'\', \'BusinessUnit\', \''.$data['business_unit']['administration']['uuid'].'\', \'Staff\', \''.$data['identity']['admin']['uuid'].'\', 1, now(), now());
        ');

        $this->addSql('
            INSERT INTO 
                `ds_access_permission` (`id`, `access_id`, `entity`, `entity_uuid`, `key`, `attributes`)
            VALUES 
                (1, 1, \'BusinessUnit\', NULL, \'entity\', \'["BROWSE","READ","EDIT","ADD","DELETE"]\'),
                (2, 1, \'BusinessUnit\', NULL, \'property\', \'["BROWSE","READ","EDIT"]\'),
                (3, 1, \'BusinessUnit\', NULL, \'custom\', \'["BROWSE","READ","EDIT","ADD","DELETE","EXECUTE"]\'),
                (4, 2, \'BusinessUnit\', \''.$data['business_unit']['backoffice']['uuid'].'\', \'category\', \'["BROWSE","READ"]\'),
                (5, 2, \'BusinessUnit\', \''.$data['business_unit']['backoffice']['uuid'].'\', \'category_uuid\', \'["BROWSE","READ"]\'),
                (6, 2, \'BusinessUnit\', \''.$data['business_unit']['backoffice']['uuid'].'\', \'category_title\', \'["BROWSE","READ"]\'),
                (7, 2, \'BusinessUnit\', \''.$data['business_unit']['backoffice']['uuid'].'\', \'category_description\', \'["BROWSE","READ"]\'),
                (8, 2, \'BusinessUnit\', \''.$data['business_unit']['backoffice']['uuid'].'\', \'category_presentation\', \'["BROWSE","READ"]\'),
                (9, 2, \'BusinessUnit\', \''.$data['business_unit']['backoffice']['uuid'].'\', \'category_data\', \'["BROWSE","READ"]\'),
                (10, 2, \'BusinessUnit\', \''.$data['business_unit']['backoffice']['uuid'].'\', \'service\', \'["BROWSE","READ"]\'),
                (11, 2, \'BusinessUnit\', \''.$data['business_unit']['backoffice']['uuid'].'\', \'service_uuid\', \'["BROWSE","READ"]\'),
                (12, 2, \'BusinessUnit\', \''.$data['business_unit']['backoffice']['uuid'].'\', \'service_title\', \'["BROWSE","READ"]\'),
                (13, 2, \'BusinessUnit\', \''.$data['business_unit']['backoffice']['uuid'].'\', \'service_description\', \'["BROWSE","READ"]\'),
                (14, 2, \'BusinessUnit\', \''.$data['business_unit']['backoffice']['uuid'].'\', \'service_presentation\', \'["BROWSE","READ"]\'),
                (15, 2, \'BusinessUnit\', \''.$data['business_unit']['backoffice']['uuid'].'\', \'service_data\', \'["BROWSE","READ"]\'),
                (16, 2, \'BusinessUnit\', \''.$data['business_unit']['backoffice']['uuid'].'\', \'scenario\', \'["BROWSE","READ"]\'),
                (17, 2, \'BusinessUnit\', \''.$data['business_unit']['backoffice']['uuid'].'\', \'scenario_uuid\', \'["BROWSE","READ"]\'),
                (18, 2, \'BusinessUnit\', \''.$data['business_unit']['backoffice']['uuid'].'\', \'scenario_title\', \'["BROWSE","READ"]\'),
                (19, 2, \'BusinessUnit\', \''.$data['business_unit']['backoffice']['uuid'].'\', \'scenario_description\', \'["BROWSE","READ"]\'),
                (20, 2, \'BusinessUnit\', \''.$data['business_unit']['backoffice']['uuid'].'\', \'scenario_presentation\', \'["BROWSE","READ"]\'),
                (21, 2, \'BusinessUnit\', \''.$data['business_unit']['backoffice']['uuid'].'\', \'scenario_data\', \'["BROWSE","READ"]\'),
                (22, 2, \'BusinessUnit\', \''.$data['business_unit']['backoffice']['uuid'].'\', \'submission\', \'["BROWSE","READ"]\'),
                (23, 2, \'BusinessUnit\', \''.$data['business_unit']['backoffice']['uuid'].'\', \'submission_uuid\', \'["BROWSE","READ"]\'),
                (24, 2, \'BusinessUnit\', \''.$data['business_unit']['backoffice']['uuid'].'\', \'submission_created_at\', \'["BROWSE","READ"]\'),
                (25, 2, \'BusinessUnit\', \''.$data['business_unit']['backoffice']['uuid'].'\', \'submission_scenario\', \'["BROWSE","READ"]\'),
                (26, 2, \'BusinessUnit\', \''.$data['business_unit']['backoffice']['uuid'].'\', \'submission_data\', \'["BROWSE","READ"]\'),
                (27, 3, \'BusinessUnit\', \''.$data['business_unit']['backoffice']['uuid'].'\', \'category\', \'["BROWSE","READ"]\'),
                (28, 3, \'BusinessUnit\', \''.$data['business_unit']['backoffice']['uuid'].'\', \'category_uuid\', \'["BROWSE","READ"]\'),
                (29, 3, \'BusinessUnit\', \''.$data['business_unit']['backoffice']['uuid'].'\', \'category_title\', \'["BROWSE","READ"]\'),
                (30, 3, \'BusinessUnit\', \''.$data['business_unit']['backoffice']['uuid'].'\', \'category_description\', \'["BROWSE","READ"]\'),
                (31, 3, \'BusinessUnit\', \''.$data['business_unit']['backoffice']['uuid'].'\', \'category_presentation\', \'["BROWSE","READ"]\'),
                (32, 3, \'BusinessUnit\', \''.$data['business_unit']['backoffice']['uuid'].'\', \'category_data\', \'["BROWSE","READ"]\'),
                (33, 3, \'BusinessUnit\', \''.$data['business_unit']['backoffice']['uuid'].'\', \'service\', \'["BROWSE","READ"]\'),
                (34, 3, \'BusinessUnit\', \''.$data['business_unit']['backoffice']['uuid'].'\', \'service_uuid\', \'["BROWSE","READ"]\'),
                (35, 3, \'BusinessUnit\', \''.$data['business_unit']['backoffice']['uuid'].'\', \'service_title\', \'["BROWSE","READ"]\'),
                (36, 3, \'BusinessUnit\', \''.$data['business_unit']['backoffice']['uuid'].'\', \'service_description\', \'["BROWSE","READ"]\'),
                (37, 3, \'BusinessUnit\', \''.$data['business_unit']['backoffice']['uuid'].'\', \'service_presentation\', \'["BROWSE","READ"]\'),
                (38, 3, \'BusinessUnit\', \''.$data['business_unit']['backoffice']['uuid'].'\', \'service_data\', \'["BROWSE","READ"]\'),
                (39, 3, \'BusinessUnit\', \''.$data['business_unit']['backoffice']['uuid'].'\', \'scenario\', \'["BROWSE","READ"]\'),
                (40, 3, \'BusinessUnit\', \''.$data['business_unit']['backoffice']['uuid'].'\', \'scenario_uuid\', \'["BROWSE","READ"]\'),
                (41, 3, \'BusinessUnit\', \''.$data['business_unit']['backoffice']['uuid'].'\', \'scenario_title\', \'["BROWSE","READ"]\'),
                (42, 3, \'BusinessUnit\', \''.$data['business_unit']['backoffice']['uuid'].'\', \'scenario_description\', \'["BROWSE","READ"]\'),
                (43, 3, \'BusinessUnit\', \''.$data['business_unit']['backoffice']['uuid'].'\', \'scenario_presentation\', \'["BROWSE","READ"]\'),
                (44, 3, \'BusinessUnit\', \''.$data['business_unit']['backoffice']['uuid'].'\', \'scenario_data\', \'["BROWSE","READ"]\'),
                (45, 3, \'BusinessUnit\', \''.$data['business_unit']['backoffice']['uuid'].'\', \'submission\', \'["BROWSE","READ"]\'),
                (46, 3, \'BusinessUnit\', \''.$data['business_unit']['backoffice']['uuid'].'\', \'submission_uuid\', \'["BROWSE","READ"]\'),
                (47, 3, \'BusinessUnit\', \''.$data['business_unit']['backoffice']['uuid'].'\', \'submission_created_at\', \'["BROWSE","READ"]\'),
                (48, 3, \'BusinessUnit\', \''.$data['business_unit']['backoffice']['uuid'].'\', \'submission_scenario\', \'["BROWSE","READ"]\'),
                (49, 3, \'BusinessUnit\', \''.$data['business_unit']['backoffice']['uuid'].'\', \'submission_data\', \'["BROWSE","READ"]\'),
                (50, 4, \'BusinessUnit\', \''.$data['business_unit']['backoffice']['uuid'].'\', \'category\', \'["BROWSE","READ"]\'),
                (51, 4, \'BusinessUnit\', \''.$data['business_unit']['backoffice']['uuid'].'\', \'category_uuid\', \'["BROWSE","READ"]\'),
                (52, 4, \'BusinessUnit\', \''.$data['business_unit']['backoffice']['uuid'].'\', \'category_title\', \'["BROWSE","READ"]\'),
                (53, 4, \'BusinessUnit\', \''.$data['business_unit']['backoffice']['uuid'].'\', \'category_description\', \'["BROWSE","READ"]\'),
                (54, 4, \'BusinessUnit\', \''.$data['business_unit']['backoffice']['uuid'].'\', \'category_presentation\', \'["BROWSE","READ"]\'),
                (55, 4, \'BusinessUnit\', \''.$data['business_unit']['backoffice']['uuid'].'\', \'category_data\', \'["BROWSE","READ"]\'),
                (56, 4, \'BusinessUnit\', \''.$data['business_unit']['backoffice']['uuid'].'\', \'service\', \'["BROWSE","READ"]\'),
                (57, 4, \'BusinessUnit\', \''.$data['business_unit']['backoffice']['uuid'].'\', \'service_uuid\', \'["BROWSE","READ"]\'),
                (58, 4, \'BusinessUnit\', \''.$data['business_unit']['backoffice']['uuid'].'\', \'service_title\', \'["BROWSE","READ"]\'),
                (59, 4, \'BusinessUnit\', \''.$data['business_unit']['backoffice']['uuid'].'\', \'service_description\', \'["BROWSE","READ"]\'),
                (60, 4, \'BusinessUnit\', \''.$data['business_unit']['backoffice']['uuid'].'\', \'service_presentation\', \'["BROWSE","READ"]\'),
                (61, 4, \'BusinessUnit\', \''.$data['business_unit']['backoffice']['uuid'].'\', \'service_data\', \'["BROWSE","READ"]\'),
                (62, 4, \'BusinessUnit\', \''.$data['business_unit']['backoffice']['uuid'].'\', \'scenario\', \'["BROWSE","READ"]\'),
                (63, 4, \'BusinessUnit\', \''.$data['business_unit']['backoffice']['uuid'].'\', \'scenario_uuid\', \'["BROWSE","READ"]\'),
                (64, 4, \'BusinessUnit\', \''.$data['business_unit']['backoffice']['uuid'].'\', \'scenario_title\', \'["BROWSE","READ"]\'),
                (65, 4, \'BusinessUnit\', \''.$data['business_unit']['backoffice']['uuid'].'\', \'scenario_description\', \'["BROWSE","READ"]\'),
                (66, 4, \'BusinessUnit\', \''.$data['business_unit']['backoffice']['uuid'].'\', \'scenario_presentation\', \'["BROWSE","READ"]\'),
                (67, 4, \'BusinessUnit\', \''.$data['business_unit']['backoffice']['uuid'].'\', \'scenario_data\', \'["BROWSE","READ"]\'),
                (68, 4, \'BusinessUnit\', \''.$data['business_unit']['backoffice']['uuid'].'\', \'submission\', \'["BROWSE","READ"]\'),
                (69, 4, \'BusinessUnit\', \''.$data['business_unit']['backoffice']['uuid'].'\', \'submission_uuid\', \'["BROWSE","READ"]\'),
                (70, 4, \'BusinessUnit\', \''.$data['business_unit']['backoffice']['uuid'].'\', \'submission_created_at\', \'["BROWSE","READ"]\'),
                (71, 4, \'BusinessUnit\', \''.$data['business_unit']['backoffice']['uuid'].'\', \'submission_scenario\', \'["BROWSE","READ"]\'),
                (72, 4, \'BusinessUnit\', \''.$data['business_unit']['backoffice']['uuid'].'\', \'submission_data\', \'["BROWSE","READ"]\'),
                (73, 5, \'BusinessUnit\', \''.$data['business_unit']['backoffice']['uuid'].'\', \'category\', \'["BROWSE","READ"]\'),
                (74, 5, \'BusinessUnit\', \''.$data['business_unit']['backoffice']['uuid'].'\', \'category_property\', \'["BROWSE","READ"]\'),
                (75, 5, \'BusinessUnit\', \''.$data['business_unit']['backoffice']['uuid'].'\', \'service\', \'["BROWSE","READ"]\'),
                (76, 5, \'BusinessUnit\', \''.$data['business_unit']['backoffice']['uuid'].'\', \'service_property\', \'["BROWSE","READ"]\'),
                (77, 5, \'BusinessUnit\', \''.$data['business_unit']['backoffice']['uuid'].'\', \'scenario\', \'["BROWSE","READ"]\'),
                (78, 5, \'BusinessUnit\', \''.$data['business_unit']['backoffice']['uuid'].'\', \'scenario_property\', \'["BROWSE","READ"]\'),
                (79, 5, \'BusinessUnit\', \''.$data['business_unit']['backoffice']['uuid'].'\', \'submission\', \'["BROWSE","READ"]\'),
                (80, 5, \'BusinessUnit\', \''.$data['business_unit']['backoffice']['uuid'].'\', \'submission_property\', \'["BROWSE","READ"]\'),
                (81, 6, \'BusinessUnit\', NULL, \'entity\', \'["BROWSE","READ","EDIT","ADD","DELETE"]\'),
                (82, 6, \'BusinessUnit\', NULL, \'property\', \'["BROWSE","READ","EDIT"]\'),
                (83, 6, \'BusinessUnit\', NULL, \'custom\', \'["BROWSE","READ","EDIT","ADD","DELETE","EXECUTE"]\');
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
