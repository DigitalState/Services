<?php

namespace AppBundle\Stat\Service;

use AppBundle\Service\ServiceService;
use Ds\Component\Model\Attribute;
use Ds\Component\Statistic\Model\Datum;
use Ds\Component\Statistic\Stat\Stat;

/**
 * Class CountStat
 */
class CountStat implements Stat
{
    use Attribute\Alias;

    /**
     * @var \AppBundle\Service\ServiceService
     */
    protected $serviceService;

    /**
     * Constructor
     *
     * @param \AppBundle\Service\ServiceService $serviceService
     */
    public function __construct(ServiceService $serviceService)
    {
        $this->serviceService = $serviceService;
    }

    /**
     * {@inheritdoc}
     */
    public function get()
    {
        $datum = new Datum;
        $datum
            ->setAlias($this->alias)
            ->setValue($this->serviceService->getRepository()->getCount([]));

        return $datum;
    }
}
