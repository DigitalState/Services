<?php

namespace Ds\Bundle\ServiceBundle\Entity;

use Ds\Component\Model\Type\Identifiable;
use Ds\Component\Model\Type\Uuidentifiable;
use Ds\Component\Model\Type\Ownable;
use Ds\Component\Model\Type\Translatable;
use Ds\Component\Model\Type\Enableable;
use Ds\Component\Model\Accessor;
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
 * Class Category
 *
 * @ApiResource(
 *     attributes={
 *         "filters"={"ds_service.filter.category"},
 *         "normalization_context"={"groups"={"category_output"}},
 *         "denormalization_context"={"groups"={"category_input"}}
 *     }
 * )
 * @ORM\Entity(repositoryClass="Ds\Bundle\ServiceBundle\Repository\CategoryRepository")
 * @ORM\Table(name="ds_category")
 * @ORM\HasLifecycleCallbacks
 * @ORMAssert\UniqueEntity(fields="uuid")
 */
class Category implements Identifiable, Uuidentifiable, Ownable, Translatable, Enableable
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

    /**
     * @var integer
     * @ApiProperty(identifier=false, writable=false)
     * @Serializer\Groups({"category_output"})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(name="id", type="integer")
     */
    protected $id;

    /**
     * @var string
     * @ApiProperty(identifier=true, writable=false)
     * @Serializer\Groups({"category_output"})
     * @ORM\Column(name="uuid", type="guid", unique=true)
     * @Assert\Uuid
     */
    protected $uuid;

    /**
     * @var \DateTime
     * @ApiProperty(writable=false)
     * @Serializer\Groups({"category_output"})
     */
    protected $createdAt;

    /**
     * @var \DateTime
     * @ApiProperty(writable=false)
     * @Serializer\Groups({"category_output"})
     */
    protected $updatedAt;

    /**
     * @var \DateTime
     * @ApiProperty(writable=false)
     * @Serializer\Groups({"category_output"})
     */
    protected $deletedAt;

    /**
     * @var string
     * @ApiProperty
     * @Serializer\Groups({"category_output", "category_input"})
     * @ORM\Column(name="`owner`", type="string", length=255, nullable=true)
     * @Assert\NotBlank
     */
    protected $owner;

    /**
     * @var string
     * @ApiProperty
     * @Serializer\Groups({"category_output", "category_input"})
     * @ORM\Column(name="owner_uuid", type="guid", nullable=true)
     * @Assert\NotBlank
     * @Assert\Uuid
     */
    protected $ownerUuid;

    /**
     * @var array
     * @ApiProperty
     * @Serializer\Groups({"category_output", "category_input"})
     * @Assert\Type("array")
     * @Assert\NotBlank
     * @Translate
     */
    protected $title;

    /**
     * @var array
     * @ApiProperty
     * @Serializer\Groups({"category_output", "category_input"})
     * @Assert\Type("array")
     * @Assert\NotBlank
     * @Translate
     */
    protected $description;

    /**
     * @var array
     * @ApiProperty
     * @Serializer\Groups({"category_output", "category_input"})
     * @Assert\Type("array")
     * @Assert\NotBlank
     * @Translate
     */
    protected $presentation;

    /**
     * @var \Doctrine\Common\Collections\ArrayCollection
     * @ApiProperty
     * @Serializer\Groups({"category_input"})
     * @ORM\ManyToMany(targetEntity="Service", mappedBy="categories")
     */
    protected $services; # region accessors

    /**
     * Add service
     *
     * @param \Ds\Bundle\ServiceBundle\Entity\Service $service
     * @return \Ds\Bundle\ServiceBundle\Entity\Category
     */
    public function addService(Service $service)
    {
        if (!$this->services->contains($service)) {
            $this->services->add($service);
            $service->addCategory($this);
        }

        return $this;
    }
    /**
     * Remove service
     *
     * @param \Ds\Bundle\ServiceBundle\Entity\Service $service
     * @return \Ds\Bundle\ServiceBundle\Entity\Category
     */
    public function removeService(Service $service)
    {
        if ($this->services->contains($service)) {
            $this->services->removeElement($service);
            $service->removeCategory($this);
        }

        return $this;
    }

    /**
     * Get services
     *
     * @return \Doctrine\Common\Collections\ArrayCollection
     */
    public function getServices()
    {
        return $this->services;
    }

    # endregion

    /**
     * @var string
     * @Serializer\Groups({"category_output", "category_input"})
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
        $this->services = new ArrayCollection;
        $this->enabled = false;
    }
}
