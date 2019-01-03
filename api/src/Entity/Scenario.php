<?php

namespace App\Entity;

use App\Entity\Attribute\Accessor as ServiceAccessor;
use Doctrine\Common\Collections\ArrayCollection;
use Ds\Component\Locale\Model\Type\Localizable;
use Ds\Component\Model\Attribute\Accessor;
use Ds\Component\Model\Type\Deletable;
use Ds\Component\Model\Type\Enableable;
use Ds\Component\Model\Type\Identifiable;
use Ds\Component\Model\Type\Ownable;
use Ds\Component\Model\Type\Sluggable;
use Ds\Component\Model\Type\Uuidentifiable;
use Ds\Component\Model\Type\Versionable;
use Ds\Component\Tenant\Model\Attribute\Accessor as TenantAccessor;
use Ds\Component\Tenant\Model\Type\Tenantable;
use Ds\Component\Translation\Model\Attribute\Accessor as TranslationAccessor;
use Ds\Component\Translation\Model\Type\Translatable;
use Knp\DoctrineBehaviors\Model as Behavior;

use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Annotation\ApiProperty;
use App\Validator\Constraints\Scenario as ScenarioAssert;
use Doctrine\ORM\Mapping as ORM;
use Ds\Component\Locale\Model\Annotation\Locale;
use Ds\Component\Translation\Model\Annotation\Translate;
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
 * @ORM\Entity(repositoryClass="App\Repository\ScenarioRepository")
 * @ORM\Table(
 *     name="app_scenario",
 *     uniqueConstraints={
 *         @ORM\UniqueConstraint(columns={"service_id", "slug"})
 *     }
 * )
 * @ORM\Cache(usage="NONSTRICT_READ_WRITE")
 * @ORMAssert\UniqueEntity(fields="uuid")
 * @ORMAssert\UniqueEntity(fields={"service", "slug"})
 * @ScenarioAssert\Config\Valid
 */
class Scenario implements Identifiable, Uuidentifiable, Sluggable, Ownable, Translatable, Localizable, Enableable, Deletable, Versionable, Tenantable
{
    use Behavior\Translatable\Translatable;
    use Behavior\Timestampable\Timestampable;
    use Behavior\SoftDeletable\SoftDeletable;

    use Accessor\Id;
    use Accessor\Uuid;
    use Accessor\Owner;
    use Accessor\OwnerUuid;
    use ServiceAccessor\Service;
    use Accessor\Type;
    use Accessor\Config;
    use Accessor\Slug;
    use TranslationAccessor\Title;
    use TranslationAccessor\Description;
    use TranslationAccessor\Presentation;
    use TranslationAccessor\Data;
    use ServiceAccessor\Submissions;
    use Accessor\Enabled;
    use Accessor\Deleted;
    use Accessor\Weight;
    use Accessor\Version;
    use TenantAccessor\Tenant;

    /**
     * @const string
     */
    const TYPE_API = 'api';
    const TYPE_BPM = 'bpm';
    const TYPE_INFO = 'info';
    const TYPE_URL = 'url';

    /**
     * @var integer
     * @ApiProperty(identifier=false, writable=false)
     * @Serializer\Groups({"scenario_output"})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(name="id", type="integer")
     */
    private $id;

    /**
     * @var string
     * @ApiProperty(identifier=true, writable=false)
     * @Serializer\Groups({"scenario_output"})
     * @ORM\Column(name="uuid", type="guid", unique=true)
     * @Assert\Uuid
     */
    private $uuid;

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
    private $owner;

    /**
     * @var string
     * @ApiProperty
     * @Serializer\Groups({"scenario_output", "scenario_input"})
     * @ORM\Column(name="owner_uuid", type="guid", nullable=true)
     * @Assert\NotBlank
     * @Assert\Uuid
     */
    private $ownerUuid;

    /**
     * @var \App\Entity\Service
     * @Serializer\Groups({"scenario_output", "scenario_input"})
     * @ORM\ManyToOne(targetEntity="Service", inversedBy="scenarios")
     * @ORM\JoinColumn(name="service_id", referencedColumnName="id")
     * @ORM\Cache(usage="NONSTRICT_READ_WRITE")
     * @Assert\Valid
     */
    private $service;

    /**
     * @var string
     * @ApiProperty
     * @Serializer\Groups({"scenario_output", "scenario_input"})
     * @ORM\Column(name="`type`", type="string", length=255)
     * @Assert\NotBlank
     * @Assert\Length(min=1, max=255)
     */
    private $type;

    /**
     * @var array
     * @ApiProperty
     * @Serializer\Groups({"scenario_output", "scenario_input"})
     * @ORM\Column(name="config", type="json_array")
     * @Assert\Type("array")
     */
    private $config;

    /**
     * @var string
     * @ApiProperty
     * @Serializer\Groups({"scenario_output", "scenario_input"})
     * @ORM\Column(name="slug", type="string")
     * @Assert\NotBlank
     * @Assert\Length(min=1, max=255)
     */
    private $slug;

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
     * @Locale
     * @Translate
     */
    private $title;

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
     * @Locale
     * @Translate
     */
    private $description;

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
     * @Locale
     * @Translate
     */
    private $presentation;

    /**
     * @var array
     * @ApiProperty
     * @Serializer\Groups({"scenario_output", "scenario_input"})
     * @Assert\Type("array")
     * @Assert\NotBlank
     * @Locale
     * @Translate
     */
    private $data;

    /**
     * @var \Doctrine\Common\Collections\ArrayCollection
     * @ORM\OneToMany(targetEntity="Submission", mappedBy="scenario")
     * @ORM\Cache(usage="NONSTRICT_READ_WRITE")
     */
    private $submissions;

    /**
     * @var string
     * @ApiProperty
     * @Serializer\Groups({"scenario_output", "scenario_input"})
     * @ORM\Column(name="enabled", type="boolean")
     * @Assert\Type("boolean")
     */
    private $enabled;

    /**
     * @var integer
     * @ApiProperty
     * @Serializer\Groups({"scenario_output", "scenario_input"})
     * @ORM\Column(name="weight", type="smallint")
     * @Assert\Length(min=0, max=255)
     */
    private $weight;

    /**
     * @var integer
     * @ApiProperty
     * @Serializer\Groups({"scenario_output", "scenario_input"})
     * @ORM\Column(name="version", type="integer")
     * @ORM\Version
     * @Assert\NotBlank
     * @Assert\Type("integer")
     */
    private $version;

    /**
     * @var string
     * @ApiProperty(writable=false)
     * @Serializer\Groups({"scenario_output"})
     * @ORM\Column(name="tenant", type="guid")
     * @Assert\Uuid
     */
    private $tenant;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->config = [];
        $this->title = [];
        $this->description = [];
        $this->presentation = [];
        $this->data = [];
        $this->submissions = new ArrayCollection;
        $this->enabled = false;
        $this->weight = 0;
    }
}
