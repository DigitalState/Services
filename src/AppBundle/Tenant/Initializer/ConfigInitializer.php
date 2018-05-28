<?php

namespace AppBundle\Tenant\Initializer;

use Ds\Component\Config\Service\ConfigService;
use Ds\Component\Tenant\Initializer\Initializer;

/**
 * Class ConfigInitializer
 */
class ConfigInitializer implements Initializer
{
    /**
     * @var \Ds\Component\Config\Service\ConfigService
     */
    protected $configService;

    /**
     * Constructor
     *
     * @param \Ds\Component\Config\Service\ConfigService $configService
     */
    public function __construct(ConfigService $configService)
    {
        $this->configService = $configService;
    }

    /**
     * {@inheritdoc}
     */
    public function initialize(array $data)
    {
        $items = [
            [
                'key' => 'app.bpm.variables.api_url',
                'value' => 'api_url'
            ],
            [
                'key' => 'app.bpm.variables.api_user',
                'value' => 'api_user'
            ],
            [
                'key' => 'app.bpm.variables.api_key',
                'value' => 'api_key'
            ],
            [
                'key' => 'app.bpm.variables.service_uuid',
                'value' => 'service_uuid'
            ],
            [
                'key' => 'app.bpm.variables.scenario_uuid',
                'value' => 'scenario_uuid'
            ],
            [
                'key' => 'app.bpm.variables.scenario_custom_data',
                'value' => 'scenario_custom_data'
            ],
            [
                'key' => 'app.bpm.variables.identity',
                'value' => 'identity'
            ],
            [
                'key' => 'app.bpm.variables.identity_uuid',
                'value' => 'identity_uuid'
            ],
            [
                'key' => 'app.bpm.variables.submission_uuid',
                'value' => 'submission_uuid'
            ],
            [
                'key' => 'app.bpm.variables.start_data',
                'value' => 'start_data'
            ]
        ];

        $manager = $this->configService->getManager();

        foreach ($items as $item) {
            $config = $this->configService->createInstance();
            $config
                ->setOwner('BusinessUnit')
                ->setOwnerUuid($data['business_unit']['administration']['uuid'])
                ->setKey($item['key'])
                ->setValue($item['value'])
                ->setTenant($data['tenant']['uuid']);
            $manager->persist($config);
            $manager->flush();
        }
    }
}
