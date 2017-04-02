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
 * Class Service
 *
 * @ApiResource(
 *     attributes={
 *         "filters"={"ds_service.service.filter"},
 *         "normalization_context"={"groups"={"service_output"}},
 *         "denormalization_context"={"groups"={"service_input"}}
 *     }
 * )
 * @ORM\Entity(repositoryClass="Ds\Bundle\ServiceBundle\Repository\ServiceRepository")
 * @ORM\Table(name="ds_service")
 * @ORM\InheritanceType("JOINED")
 * @ORM\DiscriminatorColumn(name="discriminator", type="string")
 * @ORM\HasLifecycleCallbacks
 * @ORMAssert\UniqueEntity(fields="uuid")
 */
class Service implements Uuidentifiable
{
    /**
     * @var integer
     *
     * @ApiProperty(identifier=false)
     * @Serializer\Groups({"service_output_admin"})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(name="id", type="integer")
     */
    protected $id; use Accessor\Id;

    /**
     * @var string
     *
     * @ApiProperty(identifier=true)
     * @Serializer\Groups({"service_output"})
     * @ORM\Column(name="uuid", type="guid", unique=true)
     * @Assert\Uuid
     */
    protected $uuid; use Accessor\Uuid;

    /**
     * @var \DateTime
     *
     * @Serializer\Groups({"service_output_admin"})
     * @Behavior\Timestampable(on="create")
     * @ORM\Column(name="created_at", type="datetime")
     */
    protected $createdAt; use Accessor\CreatedAt;

    /**
     * @var \DateTime
     *
     * @Serializer\Groups({"service_output_admin"})
     * @Behavior\Timestampable(on="update")
     * @ORM\Column(name="updated_at", type="datetime")
     */
    protected $updatedAt; use Accessor\UpdatedAt;

    /**
     * @var string
     *
     * @Serializer\Groups({"service_output_admin", "service_input_admin"})
     * @ORM\Column(name="`handler`", type="string")
     * @Assert\NotBlank
     */
    protected $handler; use Accessor\Handler;

    /**
     * @var string
     *
     * @Serializer\Groups({"service_output_admin", "service_input_admin"})
     * @ORM\Column(name="handler_uuid", type="guid")
     * @Assert\NotBlank
     * @Assert\Uuid
     */
    protected $handlerUuid; use Accessor\HandlerUuid;

    /**
     * @var string
     *
     * @Serializer\Groups({"service_output", "service_input_admin"})
     * @ORM\Column(name="title", type="string")
     * @Assert\NotBlank
     */
    protected $title; use Accessor\Title;

    /**
     * @var string
     *
     * @Serializer\Groups({"service_output", "service_input_admin"})
     * @ORM\Column(name="description", type="text")
     * @Assert\NotBlank
     */
    protected $description; use Accessor\Description;

    /**
     * @var string
     *
     * @Serializer\Groups({"service_output", "service_input_admin"})
     * @ORM\Column(name="presentation", type="text")
     * @Assert\NotBlank
     */
    protected $presentation; use Accessor\Presentation;

    /**
     * @var \Doctrine\Common\Collections\ArrayCollection
     *
     * @Serializer\Groups({"service_input_admin"})
     * @ORM\ManyToMany(targetEntity="Category", inversedBy="services")
     * @ORM\JoinTable(
     *     name="ds_service_category",
     *     joinColumns={@ORM\JoinColumn(name="service_id", referencedColumnName="id")},
     *     inverseJoinColumns={@ORM\JoinColumn(name="category_id", referencedColumnName="id")}
     * )
     */
    protected $categories; # region accessors

    /**
     * Add category
     *
     * @param \Ds\Bundle\ServiceBundle\Entity\Category $category
     * @return \Ds\Bundle\ServiceBundle\Entity\Service
     */
    public function addCategory(Category $category)
    {
        if (!$this->categories->contains($category)) {
            $category->addService($this);
            $this->categories->add($category);
        }

        return $this;
    }
    /**
     * Remove category
     *
     * @param \Ds\Bundle\ServiceBundle\Entity\Category $category
     * @return \Ds\Bundle\ServiceBundle\Entity\Service
     */
    public function removeCategory(Category $category)
    {
        if ($this->categories->contains($category)) {
            $category->removeService($this);
            $this->categories->removeElement($category);
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
     *
     * @Serializer\Groups({"service_output_admin"})
     * @ORM\OneToMany(targetEntity="Submission", mappedBy="service")
     */
    protected $submissions; # region accessors

    /**
     * Add submission
     *
     * @param \Ds\Bundle\ServiceBundle\Entity\Submission $submission
     * @return \Ds\Bundle\ServiceBundle\Entity\Service
     */
    public function addSubmission(Submission $submission)
    {
        if (!$this->submissions->contains($submission)) {
            $submission->addService($this);
            $this->submissions->add($submission);
        }

        return $this;
    }
    /**
     * Remove submission
     *
     * @param \Ds\Bundle\ServiceBundle\Entity\Submission $submission
     * @return \Ds\Bundle\ServiceBundle\Entity\Service
     */
    public function removeSubmission(Submission $submission)
    {
        if ($this->submissions->contains($submission)) {
            $submission->removeService($this);
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
     *
     * @Serializer\Groups({"service_output_admin", "service_input_admin"})
     * @ORM\Column(name="enabled", type="boolean")
     * @Assert\NotBlank
     */
    protected $enabled; use Accessor\Enabled;

    /**
     * @var string
     *
     * @ORM\Column(name="form", type="string")
     */
    protected $form; # region accessors

    /**
     * Set form
     *
     * @param string $form
     * @return \Ds\Bundle\ServiceBundle\Entity\Service
     */
    public function setForm($form)
    {
        $this->form = $form;

        return $this;
    }

    /**
     * Get form
     *
     * @return string
     */
    public function getForm()
    {
        return $this->form;
    }

    # endregion

    /**
     * @var array
     *
     * @ApiProperty()
     * @Serializer\Groups({"service_output"})
     */
    protected $formMeta; # region accessors

    /**
     * Set form meta
     *
     * @param array $formMeta
     * @return \Ds\Bundle\ServiceBundle\Entity\Service
     */
    public function setFormMeta($formMeta)
    {
        $this->formMeta = $formMeta;

        return $this;
    }

    /**
     * Get form meta
     *
     * @param string $property
     * @return array
     * @throws \OutOfRangeException
     */
    public function getFormMeta($property = null)
    {
        if (null === $property) {
            return $this->formMeta;
        }

        if (!array_key_exists($property, $this->formMeta)) {
            throw new OutOfRangeException('Array property does not exist.');
        }

        return $this->formMeta[$property];
    }

    # endregion

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->categories = new ArrayCollection;
        $this->submissions = new ArrayCollection;
    }
}
