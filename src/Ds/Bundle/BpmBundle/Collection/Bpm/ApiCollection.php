<?php

namespace Ds\Bundle\BpmBundle\Collection\Bpm;

use Doctrine\Common\Collections\ArrayCollection;
use Ds\Component\Bpm\Api\Api;

/**
 * Class ApiCollection
 */
class ApiCollection extends ArrayCollection
{
    /**
     * Add api
     *
     * @param \Ds\Component\Bpm\Api\Api $api
     * @param string $alias
     * @return \Ds\Bundle\BpmBundle\Collection\Bpm\ApiCollection
     */
    public function addApi(Api $api, $alias = null)
    {
        $this->add([
            'api' => $api,
            'alias' => $alias
        ]);

        return $this;
    }
}
