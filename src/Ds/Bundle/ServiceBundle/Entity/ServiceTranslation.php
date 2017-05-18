<?php

namespace Ds\Bundle\ServiceBundle\Entity;

use Ds\Component\Model\Accessor;
use Knp\DoctrineBehaviors\Model as Behavior;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class ServiceTranslation
 *
 * @ORM\Entity
 * @ORM\Table(name="ds_service_translation")
 */
class ServiceTranslation
{
    use Behavior\Translatable\Translation;
    use Behavior\Timestampable\Timestampable;
    use Behavior\SoftDeletable\SoftDeletable;

    use Accessor\Title;
    use Accessor\Description;
    use Accessor\Presentation;

    /**
     * @var string
     * @ORM\Column(name="title", type="string", length=255)
     */
    protected $title;

    /**
     * @var string
     * @ORM\Column(name="description", type="text")
     */
    protected $description;

    /**
     * @var string
     * @ORM\Column(name="presentation", type="text")
     */
    protected $presentation;
}
