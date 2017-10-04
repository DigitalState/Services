<?php

use Symfony\Component\Config\Loader\LoaderInterface;
use Symfony\Component\HttpKernel\Kernel;

/**
 * Class AppKernel
 */
class AppKernel extends Kernel
{
    /**
     * {@inheritdoc}
     */
    public function registerBundles()
    {
        $bundles = [
            new Symfony\Bundle\FrameworkBundle\FrameworkBundle(),
            new Symfony\Bundle\SecurityBundle\SecurityBundle(),
            new Symfony\Bundle\TwigBundle\TwigBundle(),
            new Symfony\Bundle\MonologBundle\MonologBundle(),
            new Symfony\Bundle\SwiftmailerBundle\SwiftmailerBundle(),
            new Doctrine\Bundle\DoctrineBundle\DoctrineBundle(),
            new Doctrine\Bundle\DoctrineCacheBundle\DoctrineCacheBundle(),
            new Doctrine\Bundle\MigrationsBundle\DoctrineMigrationsBundle(),
            new Sensio\Bundle\FrameworkExtraBundle\SensioFrameworkExtraBundle(),
            new Dunglas\ActionBundle\DunglasActionBundle(),
            new ApiPlatform\Core\Bridge\Symfony\Bundle\ApiPlatformBundle(),
            new Nelmio\CorsBundle\NelmioCorsBundle(),
            new Knp\DoctrineBehaviors\Bundle\DoctrineBehaviorsBundle(),
            new Lexik\Bundle\JWTAuthenticationBundle\LexikJWTAuthenticationBundle(),
            new Craue\FormFlowBundle\CraueFormFlowBundle(),
            new Ds\Component\Api\Bridge\Symfony\Bundle\DsApiBundle(),
            new Ds\Component\Camunda\Bridge\Symfony\Bundle\DsCamundaBundle(),
            new Ds\Component\Config\Bridge\Symfony\Bundle\DsConfigBundle(),
            new Ds\Component\Entity\Bridge\Symfony\Bundle\DsEntityBundle(),
            new Ds\Component\Formio\Bridge\Symfony\Bundle\DsFormioBundle(),
            new Ds\Component\Health\Bridge\Symfony\Bundle\DsHealthBundle(),
            new Ds\Component\Locale\Bridge\Symfony\Bundle\DsLocaleBundle(),
            new Ds\Component\Log\Bridge\Symfony\Bundle\DsLogBundle(),
            new Ds\Component\Resolver\Bridge\Symfony\Bundle\DsResolverBundle(),
            new Ds\Component\Security\Bridge\Symfony\Bundle\DsSecurityBundle(),
            new Ds\Component\Session\Bridge\Symfony\Bundle\DsSessionBundle(),
            new Ds\Component\Statistic\Bridge\Symfony\Bundle\DsStatisticBundle(),
            new Ds\Component\Translation\Bridge\Symfony\Bundle\DsTranslationBundle(),
            new AppBundle\AppBundle(),
        ];

        if (in_array($this->getEnvironment(), ['prod'], true)) {
            $bundles[] = new Ds\Component\Exception\Bridge\Symfony\Bundle\DsExceptionBundle();
        }

        if (in_array($this->getEnvironment(), ['dev', 'test'], true)) {
            $bundles[] = new Symfony\Bundle\DebugBundle\DebugBundle();
            $bundles[] = new Symfony\Bundle\WebProfilerBundle\WebProfilerBundle();
            $bundles[] = new Sensio\Bundle\DistributionBundle\SensioDistributionBundle();
            $bundles[] = new Sensio\Bundle\GeneratorBundle\SensioGeneratorBundle();
            $bundles[] = new Doctrine\Bundle\FixturesBundle\DoctrineFixturesBundle();
            $bundles[] = new Ds\Component\Debug\Bridge\Symfony\Bundle\DsDebugBundle();
            $bundles[] = new Ds\Component\Identity\Bridge\Symfony\TestBundle\DsIdentityTestBundle();
        }

        return $bundles;
    }

    /**
     * {@inheritdoc}
     */
    public function getRootDir()
    {
        return __DIR__;
    }

    /**
     * {@inheritdoc}
     */
    public function getCacheDir()
    {
        return dirname(__DIR__).'/var/cache/'.$this->getEnvironment();
    }

    /**
     * {@inheritdoc}
     */
    public function getLogDir()
    {
        return dirname(__DIR__).'/var/logs';
    }

    /**
     * {@inheritdoc}
     */
    public function registerContainerConfiguration(LoaderInterface $loader)
    {
        $loader->load($this->getRootDir().'/config/'.$this->getEnvironment().'/config.yml');
    }
}
