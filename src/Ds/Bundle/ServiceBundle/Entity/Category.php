<?php

namespace Ds\Bundle\ServiceBundle\Entity;

use Ds\Component\Entity\Entity\Uuidentifiable;
use Ds\Component\Entity\Entity\Accessor;
use Doctrine\Common\Collections\ArrayCollection;

use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Annotation\ApiProperty;
use Symfony\Component\Serializer\Annotation As Serializer;
use Gedmo\Mapping\Annotation as Behavior;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints as ORMAssert;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class Category
 *
 * @ApiResource(
 *     attributes={
 *         "filters"={"ds_service.category.filter"},
 *         "normalization_context"={"groups"={"category_output"}},
 *         "denormalization_context"={"groups"={"category_input", "category_input_admin"}}
 *     }
 * )
 * @ORM\Entity(repositoryClass="Ds\Bundle\ServiceBundle\Repository\CategoryRepository")
 * @ORM\Table(name="ds_category")
 * @ORM\InheritanceType("JOINED")
 * @ORM\DiscriminatorColumn(name="discriminator", type="string")
 * @ORM\HasLifecycleCallbacks
 * @ORMAssert\UniqueEntity(fields="uuid")
 */
class Category implements Uuidentifiable
{
    /**
     * @var integer
     *
     * @ApiProperty(identifier=false)
     * @Serializer\Groups({"category_output_admin"})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(name="id", type="integer")
     */
    protected $id; use Accessor\Id;

    /**
     * @var string
     *
     * @ApiProperty(identifier=true)
     * @Serializer\Groups({"category_output"})
     * @ORM\Column(name="uuid", type="guid", unique=true)
     * @Assert\Uuid
     */
    protected $uuid; use Accessor\Uuid;

    /**
     * @var \DateTime
     *
     * @Serializer\Groups({"category_output_admin"})
     * @Behavior\Timestampable(on="create")
     * @ORM\Column(name="created_at", type="datetime")
     */
    protected $createdAt; use Accessor\CreatedAt;

    /**
     * @var \DateTime
     *
     * @Serializer\Groups({"category_output_admin"})
     * @Behavior\Timestampable(on="update")
     * @ORM\Column(name="updated_at", type="datetime")
     */
    protected $updatedAt; use Accessor\UpdatedAt;

    /**
     * @var string
     *
     * @Serializer\Groups({"category_output_admin", "category_input_admin"})
     * @ORM\Column(name="`handler`", type="string", nullable=true)
     * Assert\NotBlank
     */
    protected $handler; use Accessor\Handler;

    /**
     * @var string
     *
     * @Serializer\Groups({"category_output_admin", "category_input_admin"})
     * @ORM\Column(name="handler_uuid", type="guid", nullable=true)
     * Assert\NotBlank
     * Assert\Uuid
     */
    protected $handlerUuid; use Accessor\HandlerUuid;

    /**
     * @var string
     *
     * @Serializer\Groups({"category_output", "category_input_admin"})
     * @ORM\Column(name="title", type="string")
     * @Assert\NotBlank
     */
    protected $title; use Accessor\Title;

    /**
     * @var string
     *
     * @Serializer\Groups({"category_output", "category_input_admin"})
     * @ORM\Column(name="description", type="text")
     * @Assert\NotBlank
     */
    protected $description; use Accessor\Description;

    /**
     * @var \Doctrine\Common\Collections\ArrayCollection
     *
     * @Serializer\Groups({"category_input_admin"})
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
            $service->addCategory($this);
            $this->services->add($service);
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
            $service->removeCategory($this);
            $this->services->removeElement($service);
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
     *
     * @Serializer\Groups({"category_output_admin", "category_input_admin"})
     * @ORM\Column(name="enabled", type="boolean")
     * @Assert\NotBlank
     */
    protected $enabled; use Accessor\Enabled;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->services = new ArrayCollection;
    }
}
