<?php

namespace App\Stat\Submission;

use App\Service\SubmissionService;
use Ds\Component\Model\Attribute;
use Ds\Component\Statistic\Model\Datum;
use Ds\Component\Statistic\Stat\Stat;

/**
 * Class CountStat
 */
final class CountStat implements Stat
{
    use Attribute\Alias;

    /**
     * @var \App\Service\SubmissionService
     */
    private $submissionService;

    /**
     * Constructor
     *
     * @param \App\Service\SubmissionService $submissionService
     */
    public function __construct(SubmissionService $submissionService)
    {
        $this->submissionService = $submissionService;
    }

    /**
     * {@inheritdoc}
     */
    public function get(): Datum
    {
        $datum = new Datum;
        $datum
            ->setAlias($this->alias)
            ->setValue($this->submissionService->getRepository()->getCount([]));

        return $datum;
    }
}
