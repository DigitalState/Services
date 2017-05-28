<?php

namespace Ds\Bundle\ServiceBundle\Accessor;

use Ds\Bundle\ServiceBundle\Entity\Scenario as ScenarioEntity;

/**
 * Trait Scenario
 */
trait Scenario
{
    /**
     * Set scenario
     *
     * @param \Ds\Bundle\ServiceBundle\Entity\Scenario $scenario
     * @return object
     */
    public function setScenario(ScenarioEntity $scenario = null)
    {
        $this->scenario = $scenario;

        return $this;
    }

    /**
     * Get scenario
     *
     * @return \Ds\Bundle\ServiceBundle\Entity\Scenario
     */
    public function getScenario()
    {
        return $this->scenario;
    }
}
