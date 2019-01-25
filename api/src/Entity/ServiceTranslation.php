<?php

namespace App\Entity;

use Ds\Component\Model\Attribute\Accessor;
use Ds\Component\Translation\Model\Type\Translation;
use Knp\DoctrineBehaviors\Model as Behavior;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class ServiceTranslation
 *
 * @ORM\Entity
 * @ORM\Table(name="app_service_trans")
 * @ORM\Cache(usage="NONSTRICT_READ_WRITE")
 */
class ServiceTranslation implements Translation
{
    use Behavior\Translatable\Translation;

    use Accessor\Title;
    use Accessor\Description;
    use Accessor\Presentation;
    use Accessor\Data;

    /**
     * @var string
     * @ORM\Column(name="title", type="string", length=255, nullable=true)
     */
    private $title;

    /**
     * @var string
     * @ORM\Column(name="description", type="text", nullable=true)
     */
    private $description;

    /**
     * @var string
     * @ORM\Column(name="presentation", type="text", nullable=true)
     */
    private $presentation;

    /**
     * @var string
     * @ORM\Column(name="data", type="json_array")
     */
    private $data;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->data = [];
    }
}
