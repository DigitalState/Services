<?php

namespace App\Service;

use App\Entity\Service;
use Doctrine\ORM\EntityManagerInterface;
use Ds\Component\Entity\Service\EntityService;

/**
 * Class ServiceService
 */
final class ServiceService extends EntityService
{
    /**
     * Constructor
     *
     * @param \Doctrine\ORM\EntityManagerInterface $manager
     * @param string $entity
     */
    public function __construct(EntityManagerInterface $manager, string $entity = Service::class)
    {
        parent::__construct($manager, $entity);
    }
}
