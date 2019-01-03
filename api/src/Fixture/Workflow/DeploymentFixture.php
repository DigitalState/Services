<?php

namespace App\Fixture\Workflow;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Ds\Component\Camunda\Fixture\Camunda\Deployment;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Ds\Component\Api\Api\Api;
use Ds\Component\Camunda\Model\Deployment as DeploymentModel;
use Ds\Component\Camunda\Query\DeploymentParameters;
use Ds\Component\Database\Fixture\Yaml;

/**
 * Class DeploymentFixture
 */
final class DeploymentFixture implements FixtureInterface, OrderedFixtureInterface, ContainerAwareInterface
{
    use Yaml;
//    use Deployment;

    /**
     * Constructor
     *
     * @param string $app
     * @param string $namespace
     */
    public function __construct(string $app, string $namespace)
    {
        $this->app = $app;
        $this->namespace = $namespace;
        $this->path = '/srv/api/config/fixtures/{fixtures}/workflow/deployment.yaml';
    }

    /**
     * {@inheritdoc}
     */
    public function getOrder()
    {
        return 30;
    }

    /**
     * @var string
     */
    private $app;

    /**
     * @var string
     */
    private $namespace;

    /**
     * @var string
     */
    private $path;

    /**
     * {@inheritdoc}
     */
    public function load(ObjectManager $manager)
    {echo 'test';
        $fixtures = array_key_exists('FIXTURES', $_ENV) ? $_ENV['FIXTURES'] : 'dev';
        $source = $this->namespace.'.'.$this->app.'.fixtures.'.$fixtures;
        $api = $this->container->get(Api::class)->get('workflow.deployment');
        $parameters = new DeploymentParameters;
        $parameters->setSource($source);
        $deployments = $api->getList($parameters);

        foreach ($deployments as $deployment) {
            $parameters = new DeploymentParameters;
            $parameters->setCascade(true);
            $api->delete($deployment->getId(), $parameters);
        }

        $objects = $this->parse($this->path);

        foreach ($objects as $object) {
            $deployment = new DeploymentModel;
            $deployment
                ->setName($object->name)
                ->setSource($source)
                ->setTenantId($object->tenant_id);
            $files = [];

            foreach ($object->files as $file) {
                $files[] = dirname(str_replace('{fixtures}', $fixtures, $this->path)).'/'.$file;
            }

            $deployment->setFiles($files);
            $api->create($deployment);
        }
    }
}
