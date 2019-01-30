<?php

namespace App\Entity\Attribute\Accessor;

use App\Entity\Scenario as ScenarioEntity;

/**
 * Trait Scenario
 */
trait Scenario
{
    /**
     * Set scenario
     *
     * @param \App\Entity\Scenario $scenario
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
     * @return \App\Entity\Scenario
     */
    public function getScenario()
    {
        return $this->scenario;
    }
}
