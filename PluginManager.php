<?php

namespace Plugin\PointsOnReferral;

use Doctrine\ORM\EntityManagerInterface;
use Eccube\Plugin\AbstractPluginManager;
use Plugin\PointsOnReferral\Entity\Config;
use Symfony\Component\DependencyInjection\ContainerInterface;

class PluginManager extends AbstractPluginManager {

    public function enable(array $meta, ContainerInterface $container) {
        $em = $container->get('doctrine.orm.entity_manager');

        // プラグイン設定を追加
        $Config = $this->createConfig($em);
    }

    protected function createConfig(EntityManagerInterface $em) {
        $Config = $em->find(Config::class, 1);
        if ($Config) {
            return $Config;
        }
        $Config = new Config();
        $Config->setRefereeRewardsEnabled(true)
            ->setRefereeRewards(0)
            ->setReferrerRewardsEnabled(true)
            ->setReferrerRewards(0);
        $em->persist($Config);
        $em->flush();
        return $Config;
    }

}
