<?php

namespace Ds\Bundle\ServiceBundle\Entity;

use Ds\Component\Entity\Entity\Uuidentifiable;
use Ds\Component\Entity\Entity\Accessor;

use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Annotation\ApiProperty;
use Symfony\Component\Serializer\Annotation As Serializer;
use Gedmo\Mapping\Annotation as Behavior;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints as ORMAssert;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class Submission
 *
 * @ApiResource(
 *     attributes={
 *         "filters"={"ds_service.submission.filter"},
 *         "normalization_context"={"groups"={"submission_output"}},
 *         "denormalization_context"={"groups"={"submission_input"}}
 *     }
 * )
 * @ORM\Entity(repositoryClass="Ds\Bundle\ServiceBundle\Repository\SubmissionRepository")
 * @ORM\Table(name="ds_submission")
 * @ORM\InheritanceType("JOINED")
 * @ORM\DiscriminatorColumn(name="discriminator", type="string")
 * @ORM\HasLifecycleCallbacks
 * @ORMAssert\UniqueEntity(fields="uuid")
 */
class Submission implements Uuidentifiable
{
    /**
     * @var integer
     *
     * @ApiProperty(identifier=false)
     * @Serializer\Groups({"submission_output_admin"})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(name="id", type="integer")
     */
    protected $id; use Accessor\Id;

    /**
     * @var string
     *
     * @ApiProperty(identifier=true)
     * @Serializer\Groups({"submission_output"})
     * @ORM\Column(name="uuid", type="guid", unique=true)
     * @Assert\Uuid
     */
    protected $uuid; use Accessor\Uuid;

    /**
     * @var \DateTime
     *
     * @Serializer\Groups({"submission_output_admin"})
     * @Behavior\Timestampable(on="create")
     * @ORM\Column(name="created_at", type="datetime")
     */
    protected $createdAt; use Accessor\CreatedAt;

    /**
     * @var \DateTime
     *
     * @Serializer\Groups({"submission_output_admin"})
     * @Behavior\Timestampable(on="update")
     * @ORM\Column(name="updated_at", type="datetime")
     */
    protected $updatedAt; use Accessor\UpdatedAt;

    /**
     * @var string
     *
     * @Serializer\Groups({"submission_output_admin", "submission_input_admin"})
     * @ORM\Column(name="`handler`", type="string")
     */
    protected $handler; use Accessor\Handler;

    /**
     * @var string
     *
     * @Serializer\Groups({"submission_output_admin", "submission_input_admin"})
     * @ORM\Column(name="handler_uuid", type="guid")
     * @Assert\Uuid
     */
    protected $handlerUuid; use Accessor\HandlerUuid;

    /**
     * @var \Ds\Bundle\ServiceBundle\Entity\Service
     *
     * @Serializer\Groups({"submission_output", "submission_input"})
     * @ORM\ManyToOne(targetEntity="Service", inversedBy="submissions")
     * @ORM\JoinColumn(name="service_id", referencedColumnName="id")
     * @Assert\Valid
     */
    protected $service; # region accessors

    /**
     * Set service
     *
     * @param \Ds\Bundle\ServiceBundle\Entity\Service $service
     * @return \Ds\Bundle\ServiceBundle\Entity\Submission
     */
    public function setService(Service $service)
    {
        $this->service = $service;

        return $this;
    }

    /**
     * Get service
     *
     * @return \Ds\Bundle\ServiceBundle\Entity\Service
     */
    public function getService()
    {
        return $this->service;
    }

    # endregion

    /**
     * @var array
     *
     * @Serializer\Groups({"submission_output", "submission_input"})
     * @ORM\Column(name="data", type="json_array")
     */
    protected $data; use Accessor\Data;

    /**
     * @var array
     *
     * @Serializer\Groups({"submission_output", "submission_input"})
     * @ORM\Column(name="draft", type="json_array")
     */
    protected $draft; # region accessors

    /**
     * Set draft
     *
     * @param array $draft
     * @return \Ds\Bundle\ServiceBundle\Entity\Submission
     */
    public function setDraft($draft)
    {
        $this->draft = $draft;

        return $this;
    }

    /**
     * Get draft
     *
     * @param string $property
     * @return array
     * @throws \OutOfRangeException
     */
    public function getDraft($property = null)
    {
        if (null === $property) {
            return $this->draft;
        }

        if (!array_key_exists($property, $this->draft)) {
            throw new OutOfRangeException('Array property does not exist.');
        }

        return $this->draft[$property];
    }

    # endregion

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->data = [];
        $this->draft = [];
    }
}
