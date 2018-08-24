<?php

namespace AppBundle\Entity;

use Ds\Component\Model\Attribute\Accessor;
use Knp\DoctrineBehaviors\Model as Behavior;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class CategoryTranslation
 *
 * @ORM\Entity
 * @ORM\Table(name="app_category_trans")
 * @ORM\Cache(usage="NONSTRICT_READ_WRITE")
 */
class CategoryTranslation
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
    protected $title;

    /**
     * @var string
     * @ORM\Column(name="description", type="text", nullable=true)
     */
    protected $description;

    /**
     * @var string
     * @ORM\Column(name="presentation", type="text", nullable=true)
     */
    protected $presentation;

    /**
     * @var string
     * @ORM\Column(name="data", type="json_array")
     */
    protected $data;
}
