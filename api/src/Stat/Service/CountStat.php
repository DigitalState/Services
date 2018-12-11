<?php

namespace App\Stat\Service;

use App\Service\ServiceService;
use Ds\Component\Model\Attribute;
use Ds\Component\Statistic\Model\Datum;
use Ds\Component\Statistic\Stat\Stat;

/**
 * Class CountStat
 */
final class CountStat implements Stat
{
    use Attribute\Alias;

    /**
     * @var \App\Service\ServiceService
     */
    private $serviceService;

    /**
     * Constructor
     *
     * @param \App\Service\ServiceService $serviceService
     */
    public function __construct(ServiceService $serviceService)
    {
        $this->serviceService = $serviceService;
    }

    /**
     * {@inheritdoc}
     */
    public function get(): Datum
    {
        $datum = new Datum;
        $datum
            ->setAlias($this->alias)
            ->setValue($this->serviceService->getRepository()->getCount([]));

        return $datum;
    }
}
