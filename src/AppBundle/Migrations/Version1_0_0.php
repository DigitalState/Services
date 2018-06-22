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
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        // Entity schema
        $this->addSql('CREATE SEQUENCE ds_config_id_seq INCREMENT BY 1 MINVALUE 1 START 19');
        $this->addSql('CREATE SEQUENCE ds_parameter_id_seq INCREMENT BY 1 MINVALUE 1 START 2');
        $this->addSql('CREATE SEQUENCE ds_access_id_seq INCREMENT BY 1 MINVALUE 1 START 3');
        $this->addSql('CREATE SEQUENCE ds_access_permission_id_seq INCREMENT BY 1 MINVALUE 1 START 7');
        $this->addSql('CREATE SEQUENCE ds_tenant_id_seq INCREMENT BY 1 MINVALUE 1 START 2');
        $this->addSql('CREATE SEQUENCE app_category_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE app_category_trans_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE app_scenario_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE app_scenario_trans_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE app_service_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE app_service_trans_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE app_submission_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE ds_config (id INT NOT NULL, uuid UUID NOT NULL, "owner" VARCHAR(255) DEFAULT NULL, owner_uuid UUID DEFAULT NULL, "key" VARCHAR(255) NOT NULL, value JSON DEFAULT NULL, enabled BOOLEAN NOT NULL, version INT DEFAULT 1 NOT NULL, tenant UUID NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_758C45F4D17F50A6 ON ds_config (uuid)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_758C45F48A90ABA94E59C462 ON ds_config (key, tenant)');
        $this->addSql('CREATE TABLE ds_parameter (id INT NOT NULL, "key" VARCHAR(255) NOT NULL, value JSON DEFAULT NULL, enabled BOOLEAN NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_B3C0FD91F48571EB ON ds_parameter ("key")');
        $this->addSql('CREATE TABLE ds_access (id INT NOT NULL, uuid UUID NOT NULL, "owner" VARCHAR(255) DEFAULT NULL, owner_uuid UUID DEFAULT NULL, assignee VARCHAR(255) DEFAULT NULL, assignee_uuid UUID DEFAULT NULL, version INT DEFAULT 1 NOT NULL, tenant UUID NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_A76F41DCD17F50A6 ON ds_access (uuid)');
        $this->addSql('CREATE TABLE ds_access_permission (id INT NOT NULL, access_id INT DEFAULT NULL, scope VARCHAR(255) DEFAULT NULL, entity VARCHAR(255) DEFAULT NULL, entity_uuid UUID DEFAULT NULL, "key" VARCHAR(255) NOT NULL, attributes JSON NOT NULL, tenant UUID NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_D46DD4D04FEA67CF ON ds_access_permission (access_id)');
        $this->addSql('CREATE TABLE ds_tenant (id INT NOT NULL, uuid UUID NOT NULL, data JSON NOT NULL, version INT DEFAULT 1 NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_EF5FAEEAD17F50A6 ON ds_tenant (uuid)');
        $this->addSql('CREATE TABLE app_category (id INT NOT NULL, uuid UUID NOT NULL, "owner" VARCHAR(255) DEFAULT NULL, owner_uuid UUID DEFAULT NULL, slug VARCHAR(255) NOT NULL, enabled BOOLEAN NOT NULL, weight SMALLINT NOT NULL, version INT DEFAULT 1 NOT NULL, tenant UUID NOT NULL, deleted_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_ECC796CD17F50A6 ON app_category (uuid)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_ECC796C989D9B624E59C462 ON app_category (slug, tenant)');
        $this->addSql('CREATE TABLE app_category_trans (id INT NOT NULL, translatable_id INT DEFAULT NULL, title VARCHAR(255) DEFAULT NULL, description TEXT DEFAULT NULL, presentation TEXT DEFAULT NULL, data JSON NOT NULL, locale VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_47E8C30A2C2AC5D3 ON app_category_trans (translatable_id)');
        $this->addSql('CREATE UNIQUE INDEX app_category_trans_unique_translation ON app_category_trans (translatable_id, locale)');
        $this->addSql('CREATE TABLE app_scenario (id INT NOT NULL, service_id INT DEFAULT NULL, uuid UUID NOT NULL, "owner" VARCHAR(255) DEFAULT NULL, owner_uuid UUID DEFAULT NULL, "type" VARCHAR(255) NOT NULL, config JSON NOT NULL, slug VARCHAR(255) NOT NULL, enabled BOOLEAN NOT NULL, weight SMALLINT NOT NULL, version INT DEFAULT 1 NOT NULL, tenant UUID NOT NULL, deleted_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_36C5A875D17F50A6 ON app_scenario (uuid)');
        $this->addSql('CREATE INDEX IDX_36C5A875ED5CA9E6 ON app_scenario (service_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_36C5A875ED5CA9E6989D9B62 ON app_scenario (service_id, slug)');
        $this->addSql('CREATE TABLE app_scenario_trans (id INT NOT NULL, translatable_id INT DEFAULT NULL, title VARCHAR(255) DEFAULT NULL, description TEXT DEFAULT NULL, presentation TEXT DEFAULT NULL, data JSON NOT NULL, locale VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_80D43D122C2AC5D3 ON app_scenario_trans (translatable_id)');
        $this->addSql('CREATE UNIQUE INDEX app_scenario_trans_unique_translation ON app_scenario_trans (translatable_id, locale)');
        $this->addSql('CREATE TABLE app_service (id INT NOT NULL, uuid UUID NOT NULL, "owner" VARCHAR(255) DEFAULT NULL, owner_uuid UUID DEFAULT NULL, slug VARCHAR(255) NOT NULL, enabled BOOLEAN NOT NULL, weight SMALLINT NOT NULL, version INT DEFAULT 1 NOT NULL, tenant UUID NOT NULL, deleted_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_CC01A9FD17F50A6 ON app_service (uuid)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_CC01A9F989D9B624E59C462 ON app_service (slug, tenant)');
        $this->addSql('CREATE TABLE app_service_category (service_id INT NOT NULL, category_id INT NOT NULL, PRIMARY KEY(service_id, category_id))');
        $this->addSql('CREATE INDEX IDX_6B04A35DED5CA9E6 ON app_service_category (service_id)');
        $this->addSql('CREATE INDEX IDX_6B04A35D12469DE2 ON app_service_category (category_id)');
        $this->addSql('CREATE TABLE app_service_trans (id INT NOT NULL, translatable_id INT DEFAULT NULL, title VARCHAR(255) DEFAULT NULL, description TEXT DEFAULT NULL, presentation TEXT DEFAULT NULL, data JSON NOT NULL, locale VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_432ECEF62C2AC5D3 ON app_service_trans (translatable_id)');
        $this->addSql('CREATE UNIQUE INDEX app_service_trans_unique_translation ON app_service_trans (translatable_id, locale)');
        $this->addSql('CREATE TABLE app_submission (id INT NOT NULL, scenario_id INT DEFAULT NULL, uuid UUID NOT NULL, "owner" VARCHAR(255) DEFAULT NULL, owner_uuid UUID DEFAULT NULL, identity VARCHAR(255) DEFAULT NULL, identity_uuid UUID DEFAULT NULL, data JSON NOT NULL, state SMALLINT NOT NULL, version INT DEFAULT 1 NOT NULL, tenant UUID NOT NULL, deleted_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D1EF18FD17F50A6 ON app_submission (uuid)');
        $this->addSql('CREATE INDEX IDX_8D1EF18FE04E49DF ON app_submission (scenario_id)');
        $this->addSql('ALTER TABLE ds_access_permission ADD CONSTRAINT FK_D46DD4D04FEA67CF FOREIGN KEY (access_id) REFERENCES ds_access (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE app_category_trans ADD CONSTRAINT FK_47E8C30A2C2AC5D3 FOREIGN KEY (translatable_id) REFERENCES app_category (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE app_scenario ADD CONSTRAINT FK_36C5A875ED5CA9E6 FOREIGN KEY (service_id) REFERENCES app_service (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE app_scenario_trans ADD CONSTRAINT FK_80D43D122C2AC5D3 FOREIGN KEY (translatable_id) REFERENCES app_scenario (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE app_service_category ADD CONSTRAINT FK_6B04A35DED5CA9E6 FOREIGN KEY (service_id) REFERENCES app_service (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE app_service_category ADD CONSTRAINT FK_6B04A35D12469DE2 FOREIGN KEY (category_id) REFERENCES app_category (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE app_service_trans ADD CONSTRAINT FK_432ECEF62C2AC5D3 FOREIGN KEY (translatable_id) REFERENCES app_service (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE app_submission ADD CONSTRAINT FK_8D1EF18FE04E49DF FOREIGN KEY (scenario_id) REFERENCES app_scenario (id) NOT DEFERRABLE INITIALLY IMMEDIATE');

        // Custom schema
        $this->addSql('CREATE TABLE ds_session (id VARCHAR(128) NOT NULL PRIMARY KEY, data BYTEA NOT NULL, time INTEGER NOT NULL, lifetime INTEGER NOT NULL)');

        // Data
        $yml = file_get_contents('/srv/api-platform/src/AppBundle/Resources/migrations/1_0_0.yml');
        $data = Yaml::parse($yml);

        $this->addSql('
            INSERT INTO 
                ds_parameter (id, key, value, enabled)
            VALUES 
                (1, \'ds_tenant.tenant.default\', \'"'.$data['tenant']['uuid'].'"\', true);
        ');

        $this->addSql('
            INSERT INTO 
                ds_tenant (id, uuid, data, created_at, updated_at)
            VALUES 
                (1, \''.$data['tenant']['uuid'].'\', \'{}\', now(), now());
        ');

        $this->addSql('
            INSERT INTO 
                ds_config (id, uuid, owner, owner_uuid, key, value, enabled, version, tenant, created_at, updated_at)
            VALUES 
                (1, \''.Uuid::uuid4()->toString().'\', \'BusinessUnit\', \''.$data['business_unit']['administration']['uuid'].'\', \'app.bpm.variables.api_url\', \'"api_url"\', true, 1, \''.$data['tenant']['uuid'].'\', now(), now()),
                (2, \''.Uuid::uuid4()->toString().'\', \'BusinessUnit\', \''.$data['business_unit']['administration']['uuid'].'\', \'app.bpm.variables.api_user\', \'"api_user"\', true, 1, \''.$data['tenant']['uuid'].'\', now(), now()),
                (3, \''.Uuid::uuid4()->toString().'\', \'BusinessUnit\', \''.$data['business_unit']['administration']['uuid'].'\', \'app.bpm.variables.api_key\', \'"api_key"\', true, 1, \''.$data['tenant']['uuid'].'\', now(), now()),
                (4, \''.Uuid::uuid4()->toString().'\', \'BusinessUnit\', \''.$data['business_unit']['administration']['uuid'].'\', \'app.bpm.variables.service_uuid\', \'"service_uuid"\', true, 1, \''.$data['tenant']['uuid'].'\', now(), now()),
                (5, \''.Uuid::uuid4()->toString().'\', \'BusinessUnit\', \''.$data['business_unit']['administration']['uuid'].'\', \'app.bpm.variables.scenario_uuid\', \'"scenario_uuid"\', true, 1, \''.$data['tenant']['uuid'].'\', now(), now()),
                (6, \''.Uuid::uuid4()->toString().'\', \'BusinessUnit\', \''.$data['business_unit']['administration']['uuid'].'\', \'app.bpm.variables.scenario_custom_data\', \'"scenario_custom_data"\', true, 1, \''.$data['tenant']['uuid'].'\', now(), now()),
                (7, \''.Uuid::uuid4()->toString().'\', \'BusinessUnit\', \''.$data['business_unit']['administration']['uuid'].'\', \'app.bpm.variables.identity\', \'"identity"\', true, 1, \''.$data['tenant']['uuid'].'\', now(), now()),
                (8, \''.Uuid::uuid4()->toString().'\', \'BusinessUnit\', \''.$data['business_unit']['administration']['uuid'].'\', \'app.bpm.variables.identity_uuid\', \'"identity_uuid"\', true, 1, \''.$data['tenant']['uuid'].'\', now(), now()),
                (9, \''.Uuid::uuid4()->toString().'\', \'BusinessUnit\', \''.$data['business_unit']['administration']['uuid'].'\', \'app.bpm.variables.submission_uuid\', \'"submission_uuid"\', true, 1, \''.$data['tenant']['uuid'].'\', now(), now()),
                (10, \''.Uuid::uuid4()->toString().'\', \'BusinessUnit\', \''.$data['business_unit']['administration']['uuid'].'\', \'app.bpm.variables.start_data\', \'"start_data"\', true, 1, \''.$data['tenant']['uuid'].'\', now(), now()),
                (11, \''.Uuid::uuid4()->toString().'\', \'BusinessUnit\', \''.$data['business_unit']['administration']['uuid'].'\', \'ds_api.user.username\', \'"system@system.ds"\', true, 1, \''.$data['tenant']['uuid'].'\', now(), now()),
                (12, \''.Uuid::uuid4()->toString().'\', \'BusinessUnit\', \''.$data['business_unit']['administration']['uuid'].'\', \'ds_api.user.password\', \'"'.$data['user']['system']['password'].'"\', true, 1, \''.$data['tenant']['uuid'].'\', now(), now()),
                (13, \''.Uuid::uuid4()->toString().'\', \'BusinessUnit\', \''.$data['business_unit']['administration']['uuid'].'\', \'ds_api.user.uuid\', \'"'.$data['user']['system']['uuid'].'"\', true, 1, \''.$data['tenant']['uuid'].'\', now(), now()),
                (14, \''.Uuid::uuid4()->toString().'\', \'BusinessUnit\', \''.$data['business_unit']['administration']['uuid'].'\', \'ds_api.user.roles\', \'[]\', true, 1, \''.$data['tenant']['uuid'].'\', now(), now()),
                (15, \''.Uuid::uuid4()->toString().'\', \'BusinessUnit\', \''.$data['business_unit']['administration']['uuid'].'\', \'ds_api.user.identity.roles\', \'[]\', true, 1, \''.$data['tenant']['uuid'].'\', now(), now()),
                (16, \''.Uuid::uuid4()->toString().'\', \'BusinessUnit\', \''.$data['business_unit']['administration']['uuid'].'\', \'ds_api.user.identity.type\', \'"System"\', true, 1, \''.$data['tenant']['uuid'].'\', now(), now()),
                (17, \''.Uuid::uuid4()->toString().'\', \'BusinessUnit\', \''.$data['business_unit']['administration']['uuid'].'\', \'ds_api.user.identity.uuid\', \'"'.$data['identity']['system']['uuid'].'"\', true, 1, \''.$data['tenant']['uuid'].'\', now(), now()),
                (18, \''.Uuid::uuid4()->toString().'\', \'BusinessUnit\', \''.$data['business_unit']['administration']['uuid'].'\', \'ds_api.user.tenant\', \'"'.$data['tenant']['uuid'].'"\', true, 1, \''.$data['tenant']['uuid'].'\', now(), now());
        ');

        $this->addSql('
            INSERT INTO 
                ds_access (id, uuid, owner, owner_uuid, assignee, assignee_uuid, version, tenant, created_at, updated_at)
            VALUES 
                (1, \''.Uuid::uuid4()->toString().'\', \'System\', \''.$data['identity']['system']['uuid'].'\', \'System\', \''.$data['identity']['system']['uuid'].'\', 1, \''.$data['tenant']['uuid'].'\', now(), now()),
                (2, \''.Uuid::uuid4()->toString().'\', \'BusinessUnit\', \''.$data['business_unit']['administration']['uuid'].'\', \'Staff\', \''.$data['identity']['admin']['uuid'].'\', 1, \''.$data['tenant']['uuid'].'\', now(), now());
        ');

        $this->addSql('
            INSERT INTO 
                ds_access_permission (id, access_id, scope, entity, entity_uuid, key, attributes, tenant)
            VALUES 
                (1, 1, \'generic\', NULL, NULL, \'entity\', \'["BROWSE","READ","EDIT","ADD","DELETE"]\', \''.$data['tenant']['uuid'].'\'),
                (2, 1, \'generic\', NULL, NULL, \'property\', \'["BROWSE","READ","EDIT"]\', \''.$data['tenant']['uuid'].'\'),
                (3, 1, \'generic\', NULL, NULL, \'generic\', \'["BROWSE","READ","EDIT","ADD","DELETE","EXECUTE"]\', \''.$data['tenant']['uuid'].'\'),
                (4, 2, \'generic\', NULL, NULL, \'entity\', \'["BROWSE","READ","EDIT","ADD","DELETE"]\', \''.$data['tenant']['uuid'].'\'),
                (5, 2, \'generic\', NULL, NULL, \'property\', \'["BROWSE","READ","EDIT"]\', \''.$data['tenant']['uuid'].'\'),
                (6, 2, \'generic\', NULL, NULL, \'generic\', \'["BROWSE","READ","EDIT","ADD","DELETE","EXECUTE"]\', \''.$data['tenant']['uuid'].'\');
        ');
    }

    /**
     * Down
     *
     * @param \Doctrine\DBAL\Schema\Schema $schema
     */
    public function down(Schema $schema)
    {
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        // Entity schema
        $this->addSql('ALTER TABLE ds_access_permission DROP CONSTRAINT FK_D46DD4D04FEA67CF');
        $this->addSql('ALTER TABLE app_category_trans DROP CONSTRAINT FK_47E8C30A2C2AC5D3');
        $this->addSql('ALTER TABLE app_service_category DROP CONSTRAINT FK_6B04A35D12469DE2');
        $this->addSql('ALTER TABLE app_scenario_trans DROP CONSTRAINT FK_80D43D122C2AC5D3');
        $this->addSql('ALTER TABLE app_submission DROP CONSTRAINT FK_8D1EF18FE04E49DF');
        $this->addSql('ALTER TABLE app_scenario DROP CONSTRAINT FK_36C5A875ED5CA9E6');
        $this->addSql('ALTER TABLE app_service_category DROP CONSTRAINT FK_6B04A35DED5CA9E6');
        $this->addSql('ALTER TABLE app_service_trans DROP CONSTRAINT FK_432ECEF62C2AC5D3');
        $this->addSql('DROP SEQUENCE ds_config_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE ds_parameter_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE ds_access_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE ds_access_permission_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE ds_tenant_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE app_category_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE app_category_trans_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE app_scenario_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE app_scenario_trans_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE app_service_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE app_service_trans_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE app_submission_id_seq CASCADE');
        $this->addSql('DROP TABLE ds_config');
        $this->addSql('DROP TABLE ds_parameter');
        $this->addSql('DROP TABLE ds_access');
        $this->addSql('DROP TABLE ds_access_permission');
        $this->addSql('DROP TABLE ds_tenant');
        $this->addSql('DROP TABLE app_category');
        $this->addSql('DROP TABLE app_category_trans');
        $this->addSql('DROP TABLE app_scenario');
        $this->addSql('DROP TABLE app_scenario_trans');
        $this->addSql('DROP TABLE app_service');
        $this->addSql('DROP TABLE app_service_category');
        $this->addSql('DROP TABLE app_service_trans');
        $this->addSql('DROP TABLE app_submission');

        // Custom schema
        $this->addSql('DROP TABLE ds_session');
    }
}
