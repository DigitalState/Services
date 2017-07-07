<?php

namespace AppBundle\Entity;

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
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ServiceRepository")
 * @ORM\Table(name="app_service")
 * @ORMAssert\UniqueEntity(fields="uuid")
 */
class Service implements Identifiable, Uuidentifiable, Ownable, Translatable, Enableable, Versionable
{
    use Behavior\Translatable\Translatable;
    use Behavior\Timestampable\Timestampable;
    use Behavior\SoftDeletable\SoftDeletable;

    use Accessor\Id;
    use Accessor\Uuid;
    use Accessor\Owner;
    use Accessor\OwnerUuid;
    use Accessor\Translation\Title;
    use Accessor\Translation\Description;
    use Accessor\Translation\Presentation;
    use Accessor\Enabled;
    use Accessor\Weight;
    use Accessor\Version;

    /**
     * @var integer
     * @ApiProperty(identifier=false, writable=false)
     * @Serializer\Groups({"service_output"})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(name="id", type="integer")
     */
    protected $id;

    /**
     * @var string
     * @ApiProperty(identifier=true, writable=false)
     * @Serializer\Groups({"service_output"})
     * @ORM\Column(name="uuid", type="guid", unique=true)
     * @Assert\Uuid
     */
    protected $uuid;

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
    protected $owner;

    /**
     * @var string
     * @ApiProperty
     * @Serializer\Groups({"service_output", "service_input"})
     * @ORM\Column(name="owner_uuid", type="guid", nullable=true)
     * @Assert\NotBlank
     * @Assert\Uuid
     */
    protected $ownerUuid;

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
     * @Translate
     */
    protected $title;

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
     * @Translate
     */
    protected $description;

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
     * @Translate
     */
    protected $presentation;

    /**
     * @var \Doctrine\Common\Collections\ArrayCollection
     * @ApiProperty
     * @Serializer\Groups({"service_output", "service_input"})
     * @ORM\ManyToMany(targetEntity="Category", inversedBy="services")
     * @ORM\JoinTable(
     *     name="app_service_category",
     *     joinColumns={@ORM\JoinColumn(name="service_id", referencedColumnName="id")},
     *     inverseJoinColumns={@ORM\JoinColumn(name="category_id", referencedColumnName="id")}
     * )
     */
    protected $categories; # region accessors

    /**
     * Add category
     *
     * @param \AppBundle\Entity\Category $category
     * @return \AppBundle\Entity\Service
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
     * @param \AppBundle\Entity\Category $category
     * @return \AppBundle\Entity\Service
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
     * @ApiProperty
     * @Serializer\Groups({"service_output"})
     * @ORM\OneToMany(targetEntity="Scenario", mappedBy="service")
     */
    protected $scenarios; # region accessors

    /**
     * Add scenario
     *
     * @param \AppBundle\Entity\Scenario $scenario
     * @return \AppBundle\Entity\Service
     */
    public function addScenario(Scenario $scenario)
    {
        if (!$this->scenarios->contains($scenario)) {
            $this->scenarios->add($scenario);
        }

        return $this;
    }

    /**
     * Remove scenario
     *
     * @param \AppBundle\Entity\Scenario $scenario
     * @return \AppBundle\Entity\Service
     */
    public function removeScenario(Scenario $scenario)
    {
        if ($this->scenarios->contains($scenario)) {
            $this->scenarios->removeElement($scenario);
        }

        return $this;
    }

    /**
     * Get scenarios
     *
     * @return \Doctrine\Common\Collections\ArrayCollection
     */
    public function getScenarios()
    {
        return $this->scenarios;
    }

    # endregion

    /**
     * @var string
     * @ApiProperty
     * @Serializer\Groups({"service_output", "service_input"})
     * @ORM\Column(name="enabled", type="boolean")
     * @Assert\Type("boolean")
     */
    protected $enabled;

    /**
     * @var integer
     * @ApiProperty
     * @Serializer\Groups({"service_output", "service_input"})
     * @ORM\Column(name="weight", type="smallint")
     * @Assert\NotBlank
     * @Assert\Length(min=0, max=255)
     */
    protected $weight;

    /**
     * @var integer
     * @ApiProperty
     * @Serializer\Groups({"service_output", "service_input"})
     * @ORM\Column(name="version", type="integer")
     * @ORM\Version
     * @Assert\NotBlank
     * @Assert\Type("integer")
     */
    protected $version;

    /**
     * @var string
     * @ORM\Column(name="form", type="string")
     */
//    protected $form; # region accessors

    /**
     * Set form
     *
     * @param string $form
     * @return \AppBundle\Entity\Service
     */
//    public function setForm($form)
//    {
//        $this->form = $form;
//
//        return $this;
//    }

    /**
     * Get form
     *
     * @return string
     */
//    public function getForm()
//    {
//        return $this->form;
//    }

    # endregion

    /**
     * @var array
     * @ApiProperty
     * @Serializer\Groups({"service_output"})
     */
//    protected $formMeta; # region accessors

    /**
     * Set form meta
     *
     * @param array $formMeta
     * @return \AppBundle\Entity\Service
     */
//    public function setFormMeta($formMeta)
//    {
//        $this->formMeta = $formMeta;
//
//        return $this;
//    }

    /**
     * Get form meta
     *
     * @param string $property
     * @return array
     * @throws \OutOfRangeException
     */
//    public function getFormMeta($property = null)
//    {
//        if (null === $property) {
//            return $this->formMeta;
//        }
//
//        if (!array_key_exists($property, $this->formMeta)) {
//            throw new OutOfRangeException('Array property does not exist.');
//        }
//
//        return $this->formMeta[$property];
//    }

    # endregion

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
    }
}
