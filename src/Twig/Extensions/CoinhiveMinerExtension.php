<?php

namespace CoinhiveBundle\Twig\Extensions;

use Twig_Environment;

/**
 * Class WidgetExtension.
 */
class CoinhiveMinerExtension extends \Twig_Extension
{
    /**
     * @var
     */
    private $siteKey;

    /**
     * WidgetExtension constructor.
     * @param $siteKey
     * @internal param $key
     */
    public function __construct(
        $siteKey
    )
    {

        $this->siteKey = $siteKey;
    }

    /**
     * @return array
     */
    public function getFunctions()
    {
        return array(
            new \Twig_SimpleFunction('coinhive_miner', [$this, 'coinhiveMiner'], [
                'is_safe' => ['html'],
                'needs_environment' => true,
            ]),
        );
    }

    /**
     * @param Twig_Environment $env
     * @return mixed
     */
    public function coinhiveMiner(Twig_Environment $env)
    {
        return $env->render(
            'CoinhiveBundle::coinhive_miner.html.twig',
            [
                'site_key' => $this->siteKey,
            ]
        );
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'coinhive_miner';
    }
}
