<?php

namespace Ds\Bundle\ServiceBundle\Serializer\ContextBuilder;

use ApiPlatform\Core\Serializer\SerializerContextBuilderInterface;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;
use Symfony\Component\HttpFoundation\Request;
use Ds\Bundle\ServiceBundle\Entity\Submission;

/**
 * Class SubmissionContextBuilder
 */
class SubmissionContextBuilder implements SerializerContextBuilderInterface
{
    /**
     * @var \ApiPlatform\Core\Serializer\SerializerContextBuilderInterface
     */
    protected $decorated;

    /**
     * @var \Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface
     */
    protected $authorizationChecker;

    /**
     * Constructor
     *
     * @param \ApiPlatform\Core\Serializer\SerializerContextBuilderInterface $decorated
     * @param \Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface $authorizationChecker
     */
    public function __construct(SerializerContextBuilderInterface $decorated, AuthorizationCheckerInterface $authorizationChecker)
    {
        $this->decorated = $decorated;
        $this->authorizationChecker = $authorizationChecker;
    }

    /**
     * {@inheritdoc}
     */
    public function createFromRequest(Request $request, bool $normalization, array $extractedAttributes = null) : array
    {
        $context = $this->decorated->createFromRequest($request, $normalization, $extractedAttributes);
        $data = $request->attributes->get('data');

        if (!$data instanceof Submission) {
            return $context;
        }

        if (!$this->authorizationChecker->isGranted('ROLE_ADMIN')) {
            return $context;
        }

        if ($normalization) {
            $context['groups'][] = 'submission_output_admin';
        }
        
        return $context;
    }
}
