<?php

namespace AppBundle\Service;

use AppBundle\Entity\Service;
use Doctrine\ORM\EntityManager;
use Ds\Component\Entity\Service\EntityService;

/**
 * Class ServiceService
 */
class ServiceService extends EntityService
{
    /**
     * Constructor
     *
     * @param \Doctrine\ORM\EntityManager $manager
     * @param string $entity
     */
    public function __construct(EntityManager $manager, $entity = Service::class)
    {
        parent::__construct($manager, $entity);
    }
}
