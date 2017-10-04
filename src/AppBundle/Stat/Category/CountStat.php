<?php

namespace AppBundle\Stat\Category;

use AppBundle\Service\CategoryService;
use Ds\Component\Model\Attribute;
use Ds\Component\Statistic\Model\Datum;
use Ds\Component\Statistic\Stat\Stat;

/**
 * Class CountStat
 */
class CountStat implements Stat
{
    use Attribute\Alias;

    /**
     * @var \AppBundle\Service\CategoryService
     */
    protected $categoryService;

    /**
     * Constructor
     *
     * @param \AppBundle\Service\CategoryService $categoryService
     */
    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    /**
     * {@inheritdoc}
     */
    public function get()
    {
        $datum = new Datum;
        $datum
            ->setAlias($this->alias)
            ->setValue($this->categoryService->getRepository()->getCount([]));

        return $datum;
    }
}
