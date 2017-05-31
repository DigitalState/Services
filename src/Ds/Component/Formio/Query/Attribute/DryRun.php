<?php

namespace Ds\Component\Formio\Query\Attribute;

/**
 * Trait DryRun
 */
trait DryRun
{
    /**
     * @var string
     */
    protected $dryRun; # region accessors

    /**
     * Set dryRun
     *
     * @param string $dryRun
     * @return object
     */
    public function setDryRun($dryRun)
    {
        $this->dryRun = $dryRun;
        $this->_dryRun = true;

        return $this;
    }

    /**
     * Get dryRun
     *
     * @return string
     */
    public function getDryRun()
    {
        return $this->dryRun;
    }

    # endregion

    /**
     * @var boolean
     */
    protected $_dryRun;
}
