<?php

namespace App\Entity;

use Ds\Component\Model\Attribute\Accessor;
use Ds\Component\Model\Type\Deletable;
use Ds\Component\Model\Type\Identifiable;
use Ds\Component\Model\Type\Uuidentifiable;
use Ds\Component\Model\Type\Ownable;
use Ds\Component\Model\Type\Identitiable;
use Ds\Component\Model\Type\Versionable;
use App\Entity\Attribute\Accessor as ServiceAccessor;
use Ds\Component\Tenant\Model\Attribute\Accessor as TenantAccessor;
use Ds\Component\Tenant\Model\Type\Tenantable;
use Knp\DoctrineBehaviors\Model as Behavior;

use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Annotation\ApiProperty;
use Symfony\Component\Serializer\Annotation as Serializer;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints as ORMAssert;

/**
 * Class Submission
 *
 * @ApiResource(
 *     attributes={
 *         "normalization_context"={
 *             "groups"={"submission_output"}
 *         },
 *         "denormalization_context"={
 *             "groups"={"submission_input"}
 *         },
 *         "filters"={
 *             "ds.submission.search",
 *             "ds.submission.date",
 *             "ds.submission.boolean",
 *             "ds.submission.order"
 *         }
 *     }
 * )
 * @ORM\Entity(repositoryClass="App\Repository\SubmissionRepository")
 * @ORM\Table(name="app_submission")
 * @ORM\Cache(usage="NONSTRICT_READ_WRITE")
 * @ORMAssert\UniqueEntity(fields="uuid")
 */
class Submission implements Identifiable, Uuidentifiable, Ownable, Identitiable, Deletable, Versionable, Tenantable
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
    use Accessor\Deleted;
    use Accessor\Version;
    use ServiceAccessor\Scenario;
    use TenantAccessor\Tenant;

    /**
     * @const integer
     */
    const STATE_DRAFT = 0;
    const STATE_SUBMITTED = 1;
    const STATE_TRANSFERRED = 2;

    /**
     * @var integer
     * @ApiProperty(identifier=false, writable=false)
     * @Serializer\Groups({"submission_output"})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(name="id", type="integer")
     */
    private $id;

    /**
     * @var string
     * @ApiProperty(identifier=true, writable=false)
     * @Serializer\Groups({"submission_output"})
     * @ORM\Column(name="uuid", type="guid", unique=true)
     * @Assert\Uuid
     */
    private $uuid;

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
    private $owner;

    /**
     * @var string
     * @ApiProperty
     * @Serializer\Groups({"submission_output", "submission_input"})
     * @ORM\Column(name="owner_uuid", type="guid", nullable=true)
     * @Assert\Uuid
     */
    private $ownerUuid;

    /**
     * @var string
     * @ApiProperty
     * @Serializer\Groups({"submission_output", "submission_input"})
     * @ORM\Column(name="identity", type="string", length=255, nullable=true)
     */
    private $identity;

    /**
     * @var string
     * @ApiProperty
     * @Serializer\Groups({"submission_output", "submission_input"})
     * @ORM\Column(name="identity_uuid", type="guid", nullable=true)
     * @Assert\Uuid
     */
    private $identityUuid;

    /**
     * @var \App\Entity\Scenario
     * @Serializer\Groups({"submission_output", "submission_input"})
     * @ORM\ManyToOne(targetEntity="Scenario", inversedBy="submissions")
     * @ORM\JoinColumn(name="scenario_id", referencedColumnName="id")
     * @Assert\Valid
     */
    private $scenario;

    /**
     * @var array
     * @ApiProperty
     * @Serializer\Groups({"submission_output", "submission_input"})
     * @ORM\Column(name="data", type="json_array")
     * @Assert\Type("array")
     */
    private $data;

    /**
     * @var integer
     * @ApiProperty
     * @Serializer\Groups({"submission_output", "submission_input"})
     * @ORM\Column(name="state", type="smallint", options={"unsigned"=true})
     */
    private $state;

    /**
     * @var integer
     * @ApiProperty
     * @Serializer\Groups({"submission_output", "submission_input"})
     * @ORM\Column(name="version", type="integer")
     * @ORM\Version
     * @Assert\NotBlank
     * @Assert\Type("integer")
     */
    private $version;

    /**
     * @var string
     * @ApiProperty(writable=false)
     * @Serializer\Groups({"submission_output"})
     * @ORM\Column(name="tenant", type="guid")
     * @Assert\Uuid
     */
    private $tenant;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->data = [];
        $this->state = static::STATE_DRAFT;
    }
}
