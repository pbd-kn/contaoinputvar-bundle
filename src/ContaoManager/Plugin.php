<?php

declare(strict_types=1);

/*
 * This file is part of [package name].
 *
 * (c) John Doe
 *
 * @license LGPL-3.0-or-later
 */

namespace PBD-KN\\ContaoInputVarBundle\\ContaoManager\\Plugin;
use Contao\CoreBundle\ContaoCoreBundle;
use Contao\ManagerPlugin\Bundle\BundlePluginInterface;
use Contao\ManagerPlugin\Bundle\Config\BundleConfig;
use Contao\ManagerPlugin\Bundle\Parser\ParserInterface;
//use Contao\SkeletonBundle\ContaoSkeletonBundle;
use PBD-KN\\ContaoInputVarBundle\\ContaoManager\\Plugin;

class Plugin implements BundlePluginInterface
{
    public function getBundles(ParserInterface $parser)
    {
        return [
            BundleConfig::create(ContaoInputVarBundle::class)
                ->setLoadAfter([ContaoCoreBundle::class]),
        ];
    }
}

