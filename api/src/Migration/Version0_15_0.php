<?php

namespace App\Migration;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;
use Doctrine\DBAL\Migrations\Version;
use Ds\Component\Acl\Migration\Version0_15_0 as Acl;
use Ds\Component\Config\Migration\Version0_15_0 as Config;
use Ds\Component\Container\Attribute;
use Ds\Component\Database\Util\Objects;
use Ds\Component\Database\Util\Parameters;
use Ds\Component\Metadata\Migration\Version0_15_0 as Metadata;
use Ds\Component\Parameter\Migration\Version0_15_0 as Parameter;
use Ds\Component\Tenant\Migration\Version0_15_0 as Tenant;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;

/**
 * Class Version0_15_0
 */
final class Version0_15_0 extends AbstractMigration implements ContainerAwareInterface
{
    use Attribute\Container;

    /**
     * @cont string
     */
    const DIRECTORY = '/srv/api/config/migrations';

    /**
     * @var \Ds\Component\Acl\Migration\Version0_15_0
     */
    private $acl;

    /**
     * @var \Ds\Component\Config\Migration\Version0_15_0
     */
    private $config;

    /**
     * @var \Ds\Component\Metadata\Migration\Version0_15_0
     */
    private $metadata;

    /**
     * @var \Ds\Component\Parameter\Migration\Version0_15_0
     */
    private $parameter;

    /**
     * @var \Ds\Component\Tenant\Migration\Version0_15_0
     */
    private $tenant;

    /**
     * Constructor
     *
     * @param \Doctrine\DBAL\Migrations\Version  $version
     */
    public function __construct(Version $version)
    {
        parent::__construct($version);
        $this->acl = new Acl($version);
        $this->config = new Config($version);
        $this->metadata = new Metadata($version);
        $this->parameter = new Parameter($version);
        $this->tenant = new Tenant($version);
    }

    /**
     * Up migration
     *
     * @param \Doctrine\DBAL\Schema\Schema $schema
     */
    public function up(Schema $schema)
    {
        $parameters = Parameters::parseFile(static::DIRECTORY.'/parameters.yaml');
        $this->acl->up($schema, Objects::parseFile(static::DIRECTORY.'/0_15_0/acl.yaml', $parameters));
        $this->config->setContainer($this->container)->up($schema, Objects::parseFile(static::DIRECTORY.'/0_15_0/config.yaml', $parameters));
        $this->metadata->up($schema, Objects::parseFile(static::DIRECTORY.'/0_15_0/metadata.yaml', $parameters));
        $this->parameter->setContainer($this->container)->up($schema, Objects::parseFile(static::DIRECTORY.'/0_15_0/system/parameter.yaml', $parameters));
        $this->tenant->up($schema, Objects::parseFile(static::DIRECTORY.'/0_15_0/system/tenant.yaml', $parameters));

        switch ($this->platform->getName()) {
            case 'postgresql':
                $this->addSql('CREATE SEQUENCE app_category_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
                $this->addSql('CREATE SEQUENCE app_category_trans_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
                $this->addSql('CREATE SEQUENCE app_scenario_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
                $this->addSql('CREATE SEQUENCE app_scenario_trans_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
                $this->addSql('CREATE SEQUENCE app_service_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
                $this->addSql('CREATE SEQUENCE app_service_trans_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
                $this->addSql('CREATE SEQUENCE app_submission_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
                $this->addSql('CREATE TABLE app_category (id INT NOT NULL, uuid UUID NOT NULL, "owner" VARCHAR(255) DEFAULT NULL, owner_uuid UUID DEFAULT NULL, slug VARCHAR(255) NOT NULL, enabled BOOLEAN NOT NULL, weight SMALLINT NOT NULL, version INT DEFAULT 1 NOT NULL, tenant UUID NOT NULL, deleted_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
                $this->addSql('CREATE UNIQUE INDEX UNIQ_ECC796CD17F50A6 ON app_category (uuid)');
                $this->addSql('CREATE UNIQUE INDEX UNIQ_ECC796C989D9B624E59C462 ON app_category (slug, tenant)');
                $this->addSql('CREATE TABLE app_category_trans (id INT NOT NULL, translatable_id INT DEFAULT NULL, title VARCHAR(255) DEFAULT NULL, description TEXT DEFAULT NULL, presentation TEXT DEFAULT NULL, data JSON NOT NULL, locale VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
                $this->addSql('CREATE INDEX IDX_47E8C30A2C2AC5D3 ON app_category_trans (translatable_id)');
                $this->addSql('CREATE UNIQUE INDEX app_category_trans_unique_translation ON app_category_trans (translatable_id, locale)');
                $this->addSql('COMMENT ON COLUMN app_category_trans.data IS \'(DC2Type:json_array)\'');
                $this->addSql('CREATE TABLE app_scenario (id INT NOT NULL, service_id INT DEFAULT NULL, uuid UUID NOT NULL, "owner" VARCHAR(255) DEFAULT NULL, owner_uuid UUID DEFAULT NULL, "type" VARCHAR(255) NOT NULL, config JSON NOT NULL, slug VARCHAR(255) NOT NULL, enabled BOOLEAN NOT NULL, weight SMALLINT NOT NULL, version INT DEFAULT 1 NOT NULL, tenant UUID NOT NULL, deleted_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
                $this->addSql('CREATE UNIQUE INDEX UNIQ_36C5A875D17F50A6 ON app_scenario (uuid)');
                $this->addSql('CREATE INDEX IDX_36C5A875ED5CA9E6 ON app_scenario (service_id)');
                $this->addSql('CREATE UNIQUE INDEX UNIQ_36C5A875ED5CA9E6989D9B62 ON app_scenario (service_id, slug)');
                $this->addSql('COMMENT ON COLUMN app_scenario.config IS \'(DC2Type:json_array)\'');
                $this->addSql('CREATE TABLE app_scenario_trans (id INT NOT NULL, translatable_id INT DEFAULT NULL, title VARCHAR(255) DEFAULT NULL, description TEXT DEFAULT NULL, presentation TEXT DEFAULT NULL, data JSON NOT NULL, locale VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
                $this->addSql('CREATE INDEX IDX_80D43D122C2AC5D3 ON app_scenario_trans (translatable_id)');
                $this->addSql('CREATE UNIQUE INDEX app_scenario_trans_unique_translation ON app_scenario_trans (translatable_id, locale)');
                $this->addSql('COMMENT ON COLUMN app_scenario_trans.data IS \'(DC2Type:json_array)\'');
                $this->addSql('CREATE TABLE app_service (id INT NOT NULL, uuid UUID NOT NULL, "owner" VARCHAR(255) DEFAULT NULL, owner_uuid UUID DEFAULT NULL, slug VARCHAR(255) NOT NULL, enabled BOOLEAN NOT NULL, weight SMALLINT NOT NULL, version INT DEFAULT 1 NOT NULL, tenant UUID NOT NULL, deleted_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
                $this->addSql('CREATE UNIQUE INDEX UNIQ_CC01A9FD17F50A6 ON app_service (uuid)');
                $this->addSql('CREATE UNIQUE INDEX UNIQ_CC01A9F989D9B624E59C462 ON app_service (slug, tenant)');
                $this->addSql('CREATE TABLE app_service_category (service_id INT NOT NULL, category_id INT NOT NULL, PRIMARY KEY(service_id, category_id))');
                $this->addSql('CREATE INDEX IDX_6B04A35DED5CA9E6 ON app_service_category (service_id)');
                $this->addSql('CREATE INDEX IDX_6B04A35D12469DE2 ON app_service_category (category_id)');
                $this->addSql('CREATE TABLE app_service_trans (id INT NOT NULL, translatable_id INT DEFAULT NULL, title VARCHAR(255) DEFAULT NULL, description TEXT DEFAULT NULL, presentation TEXT DEFAULT NULL, data JSON NOT NULL, locale VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
                $this->addSql('CREATE INDEX IDX_432ECEF62C2AC5D3 ON app_service_trans (translatable_id)');
                $this->addSql('CREATE UNIQUE INDEX app_service_trans_unique_translation ON app_service_trans (translatable_id, locale)');
                $this->addSql('COMMENT ON COLUMN app_service_trans.data IS \'(DC2Type:json_array)\'');
                $this->addSql('CREATE TABLE app_submission (id INT NOT NULL, scenario_id INT DEFAULT NULL, uuid UUID NOT NULL, "owner" VARCHAR(255) DEFAULT NULL, owner_uuid UUID DEFAULT NULL, identity VARCHAR(255) DEFAULT NULL, identity_uuid UUID DEFAULT NULL, data JSON NOT NULL, state SMALLINT NOT NULL, version INT DEFAULT 1 NOT NULL, tenant UUID NOT NULL, deleted_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
                $this->addSql('CREATE UNIQUE INDEX UNIQ_8D1EF18FD17F50A6 ON app_submission (uuid)');
                $this->addSql('CREATE INDEX IDX_8D1EF18FE04E49DF ON app_submission (scenario_id)');
                $this->addSql('COMMENT ON COLUMN app_submission.data IS \'(DC2Type:json_array)\'');
                $this->addSql('ALTER TABLE app_category_trans ADD CONSTRAINT FK_47E8C30A2C2AC5D3 FOREIGN KEY (translatable_id) REFERENCES app_category (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
                $this->addSql('ALTER TABLE app_scenario ADD CONSTRAINT FK_36C5A875ED5CA9E6 FOREIGN KEY (service_id) REFERENCES app_service (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
                $this->addSql('ALTER TABLE app_scenario_trans ADD CONSTRAINT FK_80D43D122C2AC5D3 FOREIGN KEY (translatable_id) REFERENCES app_scenario (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
                $this->addSql('ALTER TABLE app_service_category ADD CONSTRAINT FK_6B04A35DED5CA9E6 FOREIGN KEY (service_id) REFERENCES app_service (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
                $this->addSql('ALTER TABLE app_service_category ADD CONSTRAINT FK_6B04A35D12469DE2 FOREIGN KEY (category_id) REFERENCES app_category (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
                $this->addSql('ALTER TABLE app_service_trans ADD CONSTRAINT FK_432ECEF62C2AC5D3 FOREIGN KEY (translatable_id) REFERENCES app_service (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
                $this->addSql('ALTER TABLE app_submission ADD CONSTRAINT FK_8D1EF18FE04E49DF FOREIGN KEY (scenario_id) REFERENCES app_scenario (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
                break;

            default:
                $this->abortIf(true,'Migration cannot be executed on "'.$this->platform->getName().'".');
                break;
        }
    }

    /**
     * Down migration
     *
     * @param \Doctrine\DBAL\Schema\Schema $schema
     */
    public function down(Schema $schema)
    {
        $this->acl->down($schema);
        $this->config->setContainer($this->container)->down($schema);
        $this->metadata->down($schema);
        $this->parameter->setContainer($this->container)->down($schema);
        $this->tenant->down($schema);

        switch ($this->platform->getName()) {
            case 'postgresql':
                $this->addSql('ALTER TABLE app_category_trans DROP CONSTRAINT FK_47E8C30A2C2AC5D3');
                $this->addSql('ALTER TABLE app_service_category DROP CONSTRAINT FK_6B04A35D12469DE2');
                $this->addSql('ALTER TABLE app_scenario_trans DROP CONSTRAINT FK_80D43D122C2AC5D3');
                $this->addSql('ALTER TABLE app_submission DROP CONSTRAINT FK_8D1EF18FE04E49DF');
                $this->addSql('ALTER TABLE app_scenario DROP CONSTRAINT FK_36C5A875ED5CA9E6');
                $this->addSql('ALTER TABLE app_service_category DROP CONSTRAINT FK_6B04A35DED5CA9E6');
                $this->addSql('ALTER TABLE app_service_trans DROP CONSTRAINT FK_432ECEF62C2AC5D3');
                $this->addSql('DROP SEQUENCE app_category_id_seq CASCADE');
                $this->addSql('DROP SEQUENCE app_category_trans_id_seq CASCADE');
                $this->addSql('DROP SEQUENCE app_scenario_id_seq CASCADE');
                $this->addSql('DROP SEQUENCE app_scenario_trans_id_seq CASCADE');
                $this->addSql('DROP SEQUENCE app_service_id_seq CASCADE');
                $this->addSql('DROP SEQUENCE app_service_trans_id_seq CASCADE');
                $this->addSql('DROP SEQUENCE app_submission_id_seq CASCADE');
                $this->addSql('DROP TABLE app_category');
                $this->addSql('DROP TABLE app_category_trans');
                $this->addSql('DROP TABLE app_scenario');
                $this->addSql('DROP TABLE app_scenario_trans');
                $this->addSql('DROP TABLE app_service');
                $this->addSql('DROP TABLE app_service_category');
                $this->addSql('DROP TABLE app_service_trans');
                $this->addSql('DROP TABLE app_submission');
                break;

            default:
                $this->abortIf(true,'Migration cannot be executed on "'.$this->platform->getName().'".');
                break;
        }
    }
}
