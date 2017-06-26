<?php

namespace Ds\Bundle\ServiceBundle\Entity;

use Ds\Component\Model\Type\Identifiable;
use Ds\Component\Model\Type\Uuidentifiable;
use Ds\Component\Model\Type\Ownable;
use Ds\Component\Model\Type\Identitiable;
use Ds\Component\Model\Type\Versionable;
use Ds\Component\Model\Attribute\Accessor;
use Ds\Bundle\ServiceBundle\Attribute\Accessor as ServiceAccessor;
use Knp\DoctrineBehaviors\Model as Behavior;

use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Annotation\ApiProperty;
use Symfony\Component\Serializer\Annotation as Serializer;
use Symfony\Component\Validator\Constraints as Assert;
use Ds\Component\Model\Annotation\Translate;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints as ORMAssert;

/**
 * Class Submission
 *
 * @ApiResource(
 *     attributes={
 *         "filters"={"ds.submission.search", "ds.submission.date", "ds.submission.boolean"},
 *         "normalization_context"={
 *             "groups"={"submission_output"}
 *         },
 *         "denormalization_context"={
 *             "groups"={"submission_input"}
 *         }
 *     }
 * )
 * @ORM\Entity(repositoryClass="Ds\Bundle\ServiceBundle\Repository\SubmissionRepository")
 * @ORM\Table(name="ds_submission")
 * @ORM\HasLifecycleCallbacks
 * @ORMAssert\UniqueEntity(fields="uuid")
 */
class Submission implements Identifiable, Uuidentifiable, Ownable, Identitiable, Versionable
{
    use Behavior\Timestampable\Timestampable;
    use Behavior\SoftDeletable\SoftDeletable;

    use Accessor\Id;
    use Accessor\Uuid;
    use Accessor\Owner;
    use Accessor\OwnerUuid;
    use Accessor\Identity;
    use Accessor\IdentityUuid;
    use Accessor\Data;
    use Accessor\State;
    use Accessor\Version;
    use ServiceAccessor\Scenario;

    /**
     * @const integer
     */
    const STATE_DRAFT = 0;
    const STATE_SUBMITTED = 1;

    /**
     * @var integer
     * @ApiProperty(identifier=false, writable=false)
     * @Serializer\Groups({"submission_output"})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(name="id", type="integer")
     */
    protected $id;

    /**
     * @var string
     * @ApiProperty(identifier=true, writable=false)
     * @Serializer\Groups({"submission_output"})
     * @ORM\Column(name="uuid", type="guid", unique=true)
     * @Assert\Uuid
     */
    protected $uuid;

    /**
     * @var \DateTime
     * @ApiProperty(writable=false)
     * @Serializer\Groups({"submission_output"})
     */
    protected $createdAt;

    /**
     * @var \DateTime
     * @ApiProperty(writable=false)
     * @Serializer\Groups({"submission_output"})
     */
    protected $updatedAt;

    /**
     * @var \DateTime
     * @ApiProperty(writable=false)
     * @Serializer\Groups({"submission_output"})
     */
    protected $deletedAt;

    /**
     * @var string
     * @ApiProperty
     * @Serializer\Groups({"submission_output", "submission_input"})
     * @ORM\Column(name="`owner`", type="string", length=255, nullable=true)
     */
    protected $owner;

    /**
     * @var string
     * @ApiProperty
     * @Serializer\Groups({"submission_output", "submission_input"})
     * @ORM\Column(name="owner_uuid", type="guid", nullable=true)
     * @Assert\Uuid
     */
    protected $ownerUuid;

    /**
     * @var string
     * @ApiProperty
     * @Serializer\Groups({"submission_output", "submission_input"})
     * @ORM\Column(name="identity", type="string", length=255, nullable=true)
     */
    protected $identity;

    /**
     * @var string
     * @ApiProperty
     * @Serializer\Groups({"submission_output", "submission_input"})
     * @ORM\Column(name="identity_uuid", type="guid", nullable=true)
     * @Assert\Uuid
     */
    protected $identityUuid;

    /**
     * @var \Ds\Bundle\ServiceBundle\Entity\Scenario
     * @Serializer\Groups({"submission_output", "submission_input"})
     * @ORM\ManyToOne(targetEntity="Scenario", inversedBy="submissions")
     * @ORM\JoinColumn(name="scenario_id", referencedColumnName="id")
     * @Assert\Valid
     */
    protected $scenario;

    /**
     * @var array
     * @Serializer\Groups({"submission_output", "submission_input"})
     * @ORM\Column(name="data", type="json_array")
     * @Assert\Type("array")
     */
    protected $data;

    /**
     * @var integer
     * @ApiProperty
     * @Serializer\Groups({"submission_output", "submission_input"})
     * @ORM\Column(name="state", type="smallint", options={"unsigned"=true})
     */
    protected $state;

    /**
     * @var integer
     * @ApiProperty
     * @Serializer\Groups({"submission_output", "submission_input"})
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
        $this->data = [];
        $this->state = static::STATE_DRAFT;
    }
}
