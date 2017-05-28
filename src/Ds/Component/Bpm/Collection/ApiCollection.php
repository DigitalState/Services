<?php

namespace Ds\Component\Bpm\Collection;

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
     * @return \Ds\Component\Bpm\Collection\ApiCollection
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
