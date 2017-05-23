<?php
/**
 * @author George Tarkalanov, <g.turkalanov@gmail.com>
 */
namespace gtarkalanov\MigrationExtension\ServiceContainer;

use Behat\EnvironmentLoader;
use Behat\Testwork\ServiceContainer\Extension;
use Behat\Testwork\ServiceContainer\ExtensionManager;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition;

/**
 * Class MigrationExtension.
 *
 * @package Behat\MigrationExtension\ServiceContainer
 */
class MigrationExtension implements Extension
{
    /**
     * {@inheritdoc}
     */
    public function getConfigKey()
    {
        return 'migration';
    }

    /**
     * {@inheritdoc}
     */
    public function initialize(ExtensionManager $extensionManager)
    {
    }

    /**
     * {@inheritdoc}
     */
    public function load(ContainerBuilder $container, array $config)
    {
        $loader = new EnvironmentLoader($this, $container, $config);
        $loader->load();
    }

    /**
     * {@inheritdoc}
     */
    public function process(ContainerBuilder $container)
    {
    }

    /**
     * {@inheritdoc}
     */
    public function configure(ArrayNodeDefinition $builder)
    {
        $config = $builder->children();

        foreach (['migration_map','source_type'] as $param) {
            $config->scalarNode($param)
                ->end();
        }

        $config->end();
    }
}
