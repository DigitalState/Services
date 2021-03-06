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
use Doctrine\ORM\Mapping as ORM;
use Ds\Component\Locale\Model\Annotation\Locale;
use Ds\Component\Translation\Model\Annotation\Translate;
use Symfony\Bridge\Doctrine\Validator\Constraints as ORMAssert;
use Symfony\Component\Serializer\Annotation as Serializer;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class Service
 *
 * @ApiResource(
 *     attributes={
 *         "normalization_context"={
 *             "groups"={"service_output"}
 *         },
 *         "denormalization_context"={
 *             "groups"={"service_input"}
 *         },
 *         "filters"={
 *             "app.service.search",
 *             "app.service.search_translation",
 *             "app.service.date",
 *             "app.service.boolean",
 *             "app.service.order",
 *             "app.service.order_translation"
 *         }
 *     }
 * )
 * @ORM\Entity(repositoryClass="App\Repository\ServiceRepository")
 * @ORM\Table(
 *     name="app_service",
 *     uniqueConstraints={
 *        @ORM\UniqueConstraint(columns={"slug", "tenant"})
 *    }
 * )
 * @ORM\Cache(usage="NONSTRICT_READ_WRITE")
 * @ORMAssert\UniqueEntity(fields="uuid")
 * @ORMAssert\UniqueEntity(fields={"slug", "tenant"})
 */
class Service implements Identifiable, Uuidentifiable, Sluggable, Ownable, Translatable, Localizable, Enableable, Deletable, Versionable, Tenantable
{
    use Behavior\Translatable\Translatable;
    use Behavior\Timestampable\Timestampable;
    use Behavior\SoftDeletable\SoftDeletable;

    use Accessor\Id;
    use Accessor\Uuid;
    use Accessor\Owner;
    use Accessor\OwnerUuid;
    use Accessor\Slug;
    use TranslationAccessor\Title;
    use TranslationAccessor\Description;
    use TranslationAccessor\Presentation;
    use TranslationAccessor\Data;
    use ServiceAccessor\Scenarios;
    use Accessor\Enabled;
    use Accessor\Deleted;
    use Accessor\Weight;
    use Accessor\Version;
    use TenantAccessor\Tenant;

    /**
     * @var integer
     * @ApiProperty(identifier=false, writable=false)
     * @Serializer\Groups({"service_output"})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(name="id", type="integer")
     */
    private $id;

    /**
     * @var string
     * @ApiProperty(identifier=true, writable=false)
     * @Serializer\Groups({"service_output"})
     * @ORM\Column(name="uuid", type="guid", unique=true)
     * @Assert\Uuid
     */
    private $uuid;

    /**
     * @var \DateTime
     * @ApiProperty(writable=false)
     * @Serializer\Groups({"service_output"})
     */
    protected $createdAt;

    /**
     * @var \DateTime
     * @ApiProperty(writable=false)
     * @Serializer\Groups({"service_output"})
     */
    protected $updatedAt;

    /**
     * @var \DateTime
     * @ApiProperty(writable=false)
     * @Serializer\Groups({"service_output"})
     */
    protected $deletedAt;

    /**
     * @var string
     * @ApiProperty
     * @Serializer\Groups({"service_output", "service_input"})
     * @ORM\Column(name="`owner`", type="string", length=255, nullable=true)
     * @Assert\NotBlank
     * @Assert\Length(min=1, max=255)
     */
    private $owner;

    /**
     * @var string
     * @ApiProperty
     * @Serializer\Groups({"service_output", "service_input"})
     * @ORM\Column(name="owner_uuid", type="guid", nullable=true)
     * @Assert\NotBlank
     * @Assert\Uuid
     */
    private $ownerUuid;

    /**
     * @var string
     * @ApiProperty
     * @Serializer\Groups({"service_output", "service_input"})
     * @ORM\Column(name="slug", type="string")
     * @Assert\NotBlank
     * @Assert\Length(min=1, max=255)
     */
    private $slug;

    /**
     * @var array
     * @ApiProperty
     * @Serializer\Groups({"service_output", "service_input"})
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
     * @Serializer\Groups({"service_output", "service_input"})
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
     * @Serializer\Groups({"service_output", "service_input"})
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
     * @Serializer\Groups({"service_output", "service_input"})
     * @Assert\Type("array")
     * @Assert\NotBlank
     * @Locale
     * @Translate
     */
    private $data;

    /**
     * @var \Doctrine\Common\Collections\ArrayCollection
     * @ApiProperty
     * @Serializer\Groups({"service_output", "service_input"})
     * @ORM\ManyToMany(targetEntity="Category", inversedBy="services")
     * @ORM\JoinTable(
     *     name="app_service_category",
     *     joinColumns={@ORM\JoinColumn(name="service_id", referencedColumnName="id", onDelete="CASCADE")},
     *     inverseJoinColumns={@ORM\JoinColumn(name="category_id", referencedColumnName="id", onDelete="CASCADE")}
     * )
     * @ORM\Cache(usage="NONSTRICT_READ_WRITE")
     */
    private $categories; # region accessors

    /**
     * Add category
     *
     * @param \App\Entity\Category $category
     * @return \App\Entity\Service
     */
    public function addCategory(Category $category)
    {
        if (!$this->categories->contains($category)) {
            $this->categories->add($category);
            $category->addService($this);
        }

        return $this;
    }
    /**
     * Remove category
     *
     * @param \App\Entity\Category $category
     * @return \App\Entity\Service
     */
    public function removeCategory(Category $category)
    {
        if ($this->categories->contains($category)) {
            $this->categories->removeElement($category);
            $category->removeService($this);
        }

        return $this;
    }

    /**
     * Get categories
     *
     * @return \Doctrine\Common\Collections\ArrayCollection
     */
    public function getCategories()
    {
        return $this->categories;
    }

    # endregion

    /**
     * @var \Doctrine\Common\Collections\ArrayCollection
     * @ApiProperty(writable=false)
     * @Serializer\Groups({"service_output"})
     * @ORM\OneToMany(targetEntity="Scenario", mappedBy="service")
     * @ORM\Cache(usage="NONSTRICT_READ_WRITE")
     */
    private $scenarios;

    /**
     * @var string
     * @ApiProperty
     * @Serializer\Groups({"service_output", "service_input"})
     * @ORM\Column(name="enabled", type="boolean")
     * @Assert\Type("boolean")
     */
    private $enabled;

    /**
     * @var integer
     * @ApiProperty
     * @Serializer\Groups({"service_output", "service_input"})
     * @ORM\Column(name="weight", type="smallint")
     * @Assert\Length(min=0, max=255)
     */
    private $weight;

    /**
     * @var integer
     * @ApiProperty
     * @Serializer\Groups({"service_output", "service_input"})
     * @ORM\Column(name="version", type="integer")
     * @ORM\Version
     * @Assert\NotBlank
     * @Assert\Type("integer")
     */
    private $version;

    /**
     * @var string
     * @ApiProperty(writable=false)
     * @Serializer\Groups({"service_output"})
     * @ORM\Column(name="tenant", type="guid")
     * @Assert\Uuid
     */
    private $tenant;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->title = [];
        $this->description = [];
        $this->presentation = [];
        $this->categories = new ArrayCollection;
        $this->enabled = false;
        $this->weight = 0;
    }
}
