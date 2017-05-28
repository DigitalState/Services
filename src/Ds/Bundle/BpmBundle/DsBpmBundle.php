<?php

namespace Ds\Bundle\BpmBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Ds\Bundle\BpmBundle\DependencyInjection\Compiler;

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
        $container->addCompilerPass(new Compiler\ConfigPass);
    }
}
