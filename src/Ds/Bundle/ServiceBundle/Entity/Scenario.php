<?php

namespace Ds\Bundle\ServiceBundle\Entity;

use Ds\Component\Model\Type\Identifiable;
use Ds\Component\Model\Type\Uuidentifiable;
use Ds\Component\Model\Type\Ownable;
use Ds\Component\Model\Type\Translatable;
use Ds\Component\Model\Type\Enableable;
use Ds\Component\Model\Type\Versionable;
use Ds\Component\Model\Attribute\Accessor;
use Ds\Bundle\ServiceBundle\Attribute\Accessor as ServiceAccessor;
use Knp\DoctrineBehaviors\Model as Behavior;
use Doctrine\Common\Collections\ArrayCollection;

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
 *         "filters"={"ds.scenario.search", "ds.scenario.date", "ds.scenario.boolean"},
 *         "normalization_context"={
 *             "groups"={"scenario_output"}
 *         },
 *         "denormalization_context"={
 *             "groups"={"scenario_input"}
 *         }
 *     }
 * )
 * @ORM\Entity(repositoryClass="Ds\Bundle\ServiceBundle\Repository\ScenarioRepository")
 * @ORM\Table(name="ds_scenario")
 * @ORM\HasLifecycleCallbacks
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
    use Accessor\Title;
    use Accessor\Description;
    use Accessor\Presentation;
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
     * @var \Ds\Bundle\ServiceBundle\Entity\Service
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
     * @param \Ds\Bundle\ServiceBundle\Entity\Submission $submission
     * @return \Ds\Bundle\ServiceBundle\Entity\Scenario
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
     * @param \Ds\Bundle\ServiceBundle\Entity\Submission $submission
     * @return \Ds\Bundle\ServiceBundle\Entity\Scenario
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
