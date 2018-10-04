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
            new Symfony\Bundle\FrameworkBundle\FrameworkBundle,
            new Symfony\Bundle\SecurityBundle\SecurityBundle,
            new Symfony\Bundle\TwigBundle\TwigBundle,
            new Symfony\Bundle\MonologBundle\MonologBundle,
            new Symfony\Bundle\SwiftmailerBundle\SwiftmailerBundle,
            new Doctrine\Bundle\DoctrineBundle\DoctrineBundle,
            new Doctrine\Bundle\DoctrineCacheBundle\DoctrineCacheBundle,
            new Doctrine\Bundle\MigrationsBundle\DoctrineMigrationsBundle,
            new Sensio\Bundle\FrameworkExtraBundle\SensioFrameworkExtraBundle,
            new Dunglas\ActionBundle\DunglasActionBundle,
            new ApiPlatform\Core\Bridge\Symfony\Bundle\ApiPlatformBundle,
            new Nelmio\CorsBundle\NelmioCorsBundle,
            new Knp\DoctrineBehaviors\Bundle\DoctrineBehaviorsBundle,
            new Lexik\Bundle\JWTAuthenticationBundle\LexikJWTAuthenticationBundle,
//            new Dunglas\DoctrineJsonOdm\Bundle\DunglasDoctrineJsonOdmBundle,
            new Craue\FormFlowBundle\CraueFormFlowBundle,
            new Snc\RedisBundle\SncRedisBundle,
            new Ds\Component\Api\DsApiBundle,
            new Ds\Component\Cache\DsCacheBundle,
            new Ds\Component\Config\DsConfigBundle,
            new Ds\Component\Container\DsContainerBundle,
            new Ds\Component\Discovery\DsDiscoveryBundle,
            new Ds\Component\Encryption\DsEncryptionBundle,
            new Ds\Component\Entity\DsEntityBundle,
            new Ds\Component\Form\DsFormBundle,
            new Ds\Component\Func\DsFuncBundle,
            new Ds\Component\Health\DsHealthBundle,
            new Ds\Component\Identity\DsIdentityBundle,
            new Ds\Component\Locale\DsLocaleBundle,
            new Ds\Component\Log\DsLogBundle,
            new Ds\Component\Metadata\DsMetadataBundle,
            new Ds\Component\Resolver\DsResolverBundle,
            new Ds\Component\Security\DsSecurityBundle,
            new Ds\Component\Session\DsSessionBundle,
            new Ds\Component\Statistic\DsStatisticBundle,
            new Ds\Component\System\DsSystemBundle,
            new Ds\Component\Tenant\DsTenantBundle,
            new Ds\Component\Translation\DsTranslationBundle,
            new AppBundle\AppBundle,
        ];

        if (in_array($this->getEnvironment(), ['prod'], true)) {
            $bundles[] = new Ds\Component\Exception\DsExceptionBundle;
        }

        if (in_array($this->getEnvironment(), ['dev', 'test'], true)) {
            $bundles[] = new Symfony\Bundle\DebugBundle\DebugBundle;
            $bundles[] = new Symfony\Bundle\WebProfilerBundle\WebProfilerBundle;
            $bundles[] = new Sensio\Bundle\DistributionBundle\SensioDistributionBundle;
            $bundles[] = new Sensio\Bundle\GeneratorBundle\SensioGeneratorBundle;
            $bundles[] = new Doctrine\Bundle\FixturesBundle\DoctrineFixturesBundle;
            $bundles[] = new Ds\Component\Debug\DsDebugBundle;
            $bundles[] = new Ds\Component\Discovery\Test\DsDiscoveryTestBundle;
            $bundles[] = new Ds\Component\Identity\Test\DsIdentityTestBundle;
            $bundles[] = new Ds\Component\System\Test\DsSystemTestBundle;
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
