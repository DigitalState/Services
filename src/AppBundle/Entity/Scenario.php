<?php

namespace AppBundle\Entity;

use AppBundle\Entity\Attribute\Accessor as ServiceAccessor;
use Doctrine\Common\Collections\ArrayCollection;
use Ds\Component\Model\Attribute\Accessor;
use Ds\Component\Model\Type\Enableable;
use Ds\Component\Model\Type\Identifiable;
use Ds\Component\Model\Type\Ownable;
use Ds\Component\Model\Type\Uuidentifiable;
use Ds\Component\Model\Type\Translatable;
use Ds\Component\Model\Type\Versionable;
use Knp\DoctrineBehaviors\Model as Behavior;

use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Annotation\ApiProperty;
use Doctrine\ORM\Mapping as ORM;
use Ds\Component\Model\Annotation\Translate;
use Symfony\Bridge\Doctrine\Validator\Constraints as ORMAssert;
use Symfony\Component\Serializer\Annotation as Serializer;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class Scenario
 *
 * @ApiResource(
 *     attributes={
 *         "normalization_context"={
 *             "groups"={"scenario_output"}
 *         },
 *         "denormalization_context"={
 *             "groups"={"scenario_input"}
 *         },
 *         "filters"={
 *             "app.scenario.search",
 *             "app.scenario.search_translation",
 *             "app.scenario.date",
 *             "app.scenario.boolean",
 *             "app.scenario.order",
 *             "app.scenario.order_translation"
 *         }
 *     }
 * )
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ScenarioRepository")
 * @ORM\Table(name="app_scenario")
 * @ORMAssert\UniqueEntity(fields="uuid")
 */
class Scenario implements Identifiable, Uuidentifiable, Ownable, Translatable, Enableable, Versionable
{
    use Behavior\Translatable\Translatable;
    use Behavior\Timestampable\Timestampable;
    use Behavior\SoftDeletable\SoftDeletable;

    use Accessor\Id;
    use Accessor\Uuid;
    use Accessor\Owner;
    use Accessor\OwnerUuid;
    use Accessor\Type;
    use Accessor\Translation\Title;
    use Accessor\Translation\Description;
    use Accessor\Translation\Presentation;
    use Accessor\Data;
    use Accessor\Enabled;
    use Accessor\Weight;
    use Accessor\Version;
    use ServiceAccessor\Service;

    /**
     * @const string
     */
    const TYPE_BPM = 'bpm';

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
     * @Assert\Length(min=1, max=255)
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
     * @var \AppBundle\Entity\Service
     * @Serializer\Groups({"scenario_output", "scenario_input"})
     * @ORM\ManyToOne(targetEntity="Service", inversedBy="scenarios")
     * @ORM\JoinColumn(name="service_id", referencedColumnName="id")
     * @Assert\Valid
     */
    protected $service;

    /**
     * @var string
     * @ApiProperty
     * @Serializer\Groups({"scenario_output", "scenario_input"})
     * @ORM\Column(name="`type`", type="string", length=255)
     * @Assert\NotBlank
     * @Assert\Length(min=1, max=255)
     */
    protected $type;

    /**
     * @var array
     * @ApiProperty
     * @Serializer\Groups({"scenario_output", "scenario_input"})
     * @Assert\Type("array")
     * @Assert\NotBlank
     * @Assert\All({
     *     @Assert\NotBlank,
     *     @Assert\Length(min=1)
     * })
     * @Translate
     */
    protected $title;

    /**
     * @var array
     * @ApiProperty
     * @Serializer\Groups({"scenario_output", "scenario_input"})
     * @Assert\Type("array")
     * @Assert\NotBlank
     * @Assert\All({
     *     @Assert\NotBlank,
     *     @Assert\Length(min=1)
     * })
     * @Translate
     */
    protected $description;

    /**
     * @var array
     * @ApiProperty
     * @Serializer\Groups({"scenario_output", "scenario_input"})
     * @Assert\Type("array")
     * @Assert\NotBlank
     * @Assert\All({
     *     @Assert\NotBlank,
     *     @Assert\Length(min=1)
     * })
     * @Translate
     */
    protected $presentation;

    /**
     * @var array
     * @ApiProperty
     * @Serializer\Groups({"scenario_output", "scenario_input"})
     * @ORM\Column(name="data", type="json_array")
     * @Assert\Type("array")
     */
    protected $data;

    /**
     * @var \Doctrine\Common\Collections\ArrayCollection
     * @ORM\OneToMany(targetEntity="Submission", mappedBy="scenario")
     */
    protected $submissions; # region accessors

    /**
     * Add submission
     *
     * @param \AppBundle\Entity\Submission $submission
     * @return \AppBundle\Entity\Scenario
     */
    public function addSubmission(Submission $submission)
    {
        if (!$this->submissions->contains($submission)) {
            $this->submissions->add($submission);
        }

        return $this;
    }

    /**
     * Remove submission
     *
     * @param \AppBundle\Entity\Submission $submission
     * @return \AppBundle\Entity\Scenario
     */
    public function removeSubmission(Submission $submission)
    {
        if ($this->submissions->contains($submission)) {
            $this->submissions->removeElement($submission);
        }

        return $this;
    }

    /**
     * Get submissions
     *
     * @return \Doctrine\Common\Collections\ArrayCollection
     */
    public function getSubmissions()
    {
        return $this->submissions;
    }

    # endregion

    /**
     * @var string
     * @ApiProperty
     * @Serializer\Groups({"scenario_output", "scenario_input"})
     * @ORM\Column(name="enabled", type="boolean")
     * @Assert\Type("boolean")
     */
    protected $enabled;

    /**
     * @var integer
     * @ApiProperty
     * @Serializer\Groups({"scenario_output", "scenario_input"})
     * @ORM\Column(name="weight", type="smallint")
     * @Assert\NotBlank
     * @Assert\Length(min=0, max=255)
     */
    protected $weight;

    /**
     * @var integer
     * @ApiProperty
     * @Serializer\Groups({"scenario_output", "scenario_input"})
     * @ORM\Column(name="version", type="integer")
     * @ORM\Version
     * @Assert\NotBlank
     * @Assert\Type("integer")
     */
    protected $version;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->title = [];
        $this->description = [];
        $this->presentation = [];
        $this->data = [];
        $this->submissions = new ArrayCollection;
        $this->enabled = false;
        $this->weight = 0;
    }
}
