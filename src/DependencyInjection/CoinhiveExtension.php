<?php

namespace CoinhiveBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader;

/**
 * Class CoinhiveExtension
 */
class CoinhiveExtension extends Extension
{
    /**
     * @param array $configs
     * @param ContainerBuilder $container
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        $loader = new Loader\YamlFileLoader($container, new FileLocator(__DIR__ . '/../Resources/config'));
        $loader->load('services.yml');

        $def = $container->getDefinition('coinhive_miner.twig');
        $def->replaceArgument(0, $config['config']['site_key']);

        $def = $container->getDefinition('coinhive_captcha.form');
        $def->replaceArgument(0, $config['config']['site_key']);

        $def = $container->getDefinition('coinhive_captcha.validator');
        $def->replaceArgument(1, $config['config']['site_key']);

        $this->registerWidget($container);
    }

    /**
     * @param ContainerBuilder $container
     */
    protected function registerWidget(ContainerBuilder $container)
    {
        $templatingEngines = $container->getParameter('templating.engines');
        if (in_array('twig', $templatingEngines)) {
            $formRessource = 'MedzonerGlobalBundle:Form:coinhive_captcha_widget.html.twig';
            $container->setParameter('twig.form.resources', array_merge(
                $container->getParameter('twig.form.resources'),
                [$formRessource]
            ));
        }
    }
}
