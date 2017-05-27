<?php

namespace Ds\Bundle\ServiceBundle\Entity;

use Ds\Component\Model\Type\Identifiable;
use Ds\Component\Model\Type\Uuidentifiable;
use Ds\Component\Model\Type\Ownable;
use Ds\Component\Model\Type\Translatable;
use Ds\Component\Model\Type\Enableable;
use Ds\Component\Model\Accessor;
use Ds\Bundle\ServiceBundle\Accessor as ServiceAccessor;
use Knp\DoctrineBehaviors\Model as Behavior;

use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Annotation\ApiProperty;
use Symfony\Component\Serializer\Annotation as Serializer;
use Symfony\Component\Validator\Constraints as Assert;
use Ds\Component\Model\Annotation\Translate;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints as ORMAssert;

/**
 * Class Scenario
 *
 * @ApiResource(
 *     attributes={
 *         "filters"={"ds_service.filter.scenario"},
 *         "normalization_context"={"groups"={"scenario_output"}},
 *         "denormalization_context"={"groups"={"scenario_input"}}
 *     }
 * )
 * @ORM\Entity(repositoryClass="Ds\Bundle\ServiceBundle\Repository\ScenarioRepository")
 * @ORM\Table(name="ds_scenario")
 * @ORM\HasLifecycleCallbacks
 * @ORMAssert\UniqueEntity(fields="uuid")
 */
class Scenario implements Identifiable, Uuidentifiable, Ownable, Translatable, Enableable
{
    use Behavior\Translatable\Translatable;
    use Behavior\Timestampable\Timestampable;
    use Behavior\SoftDeletable\SoftDeletable;

    use Accessor\Id;
    use Accessor\Uuid;
    use Accessor\Owner;
    use Accessor\OwnerUuid;
    use Accessor\Title;
    use Accessor\Description;
    use Accessor\Presentation;
    use Accessor\Enabled;
    use ServiceAccessor\Service;

    /**
     * @var integer
     * @ApiProperty(identifier=false, writable=false)
     * @Serializer\Groups({"scenario_output"})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(name="id", type="integer")
     */
    protected $id;

    /**
     * @var string
     * @ApiProperty(identifier=true, writable=false)
     * @Serializer\Groups({"scenario_output"})
     * @ORM\Column(name="uuid", type="guid", unique=true)
     * @Assert\Uuid
     */
    protected $uuid;

    /**
     * @var \DateTime
     * @ApiProperty(writable=false)
     * @Serializer\Groups({"scenario_output"})
     */
    protected $createdAt;

    /**
     * @var \DateTime
     * @ApiProperty(writable=false)
     * @Serializer\Groups({"scenario_output"})
     */
    protected $updatedAt;

    /**
     * @var \DateTime
     * @ApiProperty(writable=false)
     * @Serializer\Groups({"scenario_output"})
     */
    protected $deletedAt;

    /**
     * @var string
     * @ApiProperty
     * @Serializer\Groups({"scenario_output", "scenario_input"})
     * @ORM\Column(name="`owner`", type="string", length=255, nullable=true)
     * @Assert\NotBlank
     */
    protected $owner;

    /**
     * @var string
     * @ApiProperty
     * @Serializer\Groups({"scenario_output", "scenario_input"})
     * @ORM\Column(name="owner_uuid", type="guid", nullable=true)
     * @Assert\NotBlank
     * @Assert\Uuid
     */
    protected $ownerUuid;

    /**
     * @var \Ds\Bundle\ServiceBundle\Entity\Service
     * @Serializer\Groups({"scenario_output", "scenario_input"})
     * @ORM\ManyToOne(targetEntity="Service", inversedBy="scenarios")
     * @ORM\JoinColumn(name="service_id", referencedColumnName="id")
     * @Assert\Valid
     */
    protected $service;

    /**
     * @var array
     * @ApiProperty
     * @Serializer\Groups({"scenario_output", "scenario_input"})
     * @Assert\Type("array")
     * @Assert\NotBlank
     * @Translate
     */
    protected $title;

    /**
     * @var array
     * @ApiProperty
     * @Serializer\Groups({"scenario_output", "scenario_input"})
     * @Assert\Type("array")
     * @Assert\NotBlank
     * @Translate
     */
    protected $description;

    /**
     * @var array
     * @ApiProperty
     * @Serializer\Groups({"scenario_output", "scenario_input"})
     * @Assert\Type("array")
     * @Assert\NotBlank
     * @Translate
     */
    protected $presentation;

    /**
     * @var string
     * @ApiProperty
     * @Serializer\Groups({"scenario_output", "scenario_input"})
     * @ORM\Column(name="enabled", type="boolean")
     * @Assert\NotBlank
     */
    protected $enabled;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->title = [];
        $this->description = [];
        $this->presentation = [];
        $this->enabled = false;
    }
}
