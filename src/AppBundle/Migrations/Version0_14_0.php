<?php

namespace AppBundle\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;
use Ds\Component\Container\Attribute;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use stdClass;

/**
 * Class Version0_14_0
 */
class Version0_14_0 extends AbstractMigration implements ContainerAwareInterface
{
    use Attribute\Container;

    /**
     * Up
     *
     * @param \Doctrine\DBAL\Schema\Schema $schema
     */
    public function up(Schema $schema)
    {
        $platform = $this->connection->getDatabasePlatform()->getName();

        switch ($platform) {
            case 'postgresql':
                // Schema
                $this->addSql('ALTER TABLE ds_tenant DROP data');
                break;

            default:
                $this->abortIf(true,'Migration cannot be executed on "'.$platform.'".');
                break;
        }
    }

    /**
     * Down
     *
     * @param \Doctrine\DBAL\Schema\Schema $schema
     */
    public function down(Schema $schema)
    {
        $platform = $this->connection->getDatabasePlatform()->getName();
        $cipherService = $this->container->get('ds_encryption.service.cipher');

        switch ($platform) {
            case 'postgresql':
                // Schema
                $this->warnIf(true, 'Tenant data column was lost during the previous migration and was reset to an empty object.');
                $this->addSql('ALTER TABLE ds_tenant ADD data JSON NULL');
                $data = '"'.$cipherService->encrypt(serialize(new stdClass)).'"';
                $this->addSql('UPDATE ds_tenant SET data = '.$this->connection->quote($data));
                $this->addSql('ALTER TABLE ds_tenant ALTER COLUMN data SET NOT NULL');
                break;

            default:
                $this->abortIf(true,'Migration cannot be executed on "'.$platform.'".');
                break;
        }
    }
}
