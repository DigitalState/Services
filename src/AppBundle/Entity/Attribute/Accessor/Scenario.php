<?php

namespace AppBundle\Entity\Attribute\Accessor;

use AppBundle\Entity\Scenario as ScenarioEntity;

/**
 * Trait Scenario
 */
trait Scenario
{
    /**
     * Set scenario
     *
     * @param \AppBundle\Entity\Scenario $scenario
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
     * @return \AppBundle\Entity\Scenario
     */
    public function getScenario()
    {
        return $this->scenario;
    }
}
