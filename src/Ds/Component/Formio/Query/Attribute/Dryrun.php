<?php

namespace Ds\Component\Formio\Query\Attribute;

/**
 * Trait Dryrun
 */
trait Dryrun
{
    /**
     * @var string
     */
    protected $dryrun; # region accessors

    /**
     * Set dryrun
     *
     * @param string $dryrun
     * @return object
     */
    public function setDryrun($dryrun)
    {
        $this->dryrun = $dryrun;
        $this->_dryrun = true;

        return $this;
    }

    /**
     * Get dryrun
     *
     * @return string
     */
    public function getDryrun()
    {
        return $this->dryrun;
    }

    # endregion

    /**
     * @var boolean
     */
    protected $_dryrun;
}
