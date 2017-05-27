<?php

namespace Ds\Component\Bpm\Model\Attribute;

/**
 * Trait DeploymentId
 */
trait DeploymentId
{
    /**
     * @var string
     */
    protected $deploymentId; # region accessors

    /**
     * Set deploymentId
     *
     * @param string $deploymentId
     * @return object
     */
    public function setDeploymentId($deploymentId)
    {
        $this->deploymentId = $deploymentId;

        return $this;
    }

    /**
     * Get deploymentId
     *
     * @return string
     */
    public function getDeploymentId()
    {
        return $this->deploymentId;
    }

    # endregion
}
