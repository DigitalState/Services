<?php

namespace Ds\Component\Bpm\Bridge\Symfony\Bundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Ds\Component\Bpm\Bridge\Symfony\Bundle\DependencyInjection\Compiler;

/**
 * Class DsBpmBundle
 */
class DsBpmBundle extends Bundle
{
    /**
     * {@inheritdoc}
     */
    public function build(ContainerBuilder $container)
    {
        parent::build($container);

        $container->addCompilerPass(new Compiler\ApiPass);
    }
}
