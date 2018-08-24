<?php

namespace AppBundle\Entity\Attribute\Accessor;

use AppBundle\Entity\Scenario;

/**
 * Trait Scenarios
 */
trait Scenarios
{
    /**
     * Add scenario
     *
     * @param \AppBundle\Entity\Scenario $scenario
     * @return object
     */
    public function addScenario(Scenario $scenario)
    {
        if (!$this->scenarios->contains($scenario)) {
            $this->scenarios->add($scenario);
        }

        return $this;
    }

    /**
     * Remove scenario
     *
     * @param \AppBundle\Entity\Scenario $scenario
     * @return object
     */
    public function removeScenario(Scenario $scenario)
    {
        if ($this->scenarios->contains($scenario)) {
            $this->scenarios->removeElement($scenario);
        }

        return $this;
    }

    /**
     * Get scenarios
     *
     * @return \Doctrine\Common\Collections\ArrayCollection
     */
    public function getScenarios()
    {
        return $this->scenarios;
    }
}
