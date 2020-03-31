<?php

namespace Plugin\PointsOnReferral;

use Doctrine\ORM\EntityManagerInterface;
use Eccube\Entity\Customer;
use Eccube\Plugin\AbstractPluginManager;
use Plugin\PointsOnReferral\Entity\Config;
use Plugin\PointsOnReferral\Entity\Referral;
use Symfony\Component\DependencyInjection\ContainerInterface;

class PluginManager extends AbstractPluginManager {

    public function enable(array $meta, ContainerInterface $container) {
        $em = $container->get('doctrine.orm.entity_manager');
        $Config = $this->createConfig($em);
        $this->updateReferrals($em);
    }

    /**
     * @param EntityManagerInterface $em
     * @return object|Config
     */
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

    /**
     * @param EntityManagerInterface $em
     */
    protected function updateReferrals(EntityManagerInterface $em) {
        $Customers = $em->getRepository(Customer::class)->findAll();
        $processedCustomerIds = [];
        foreach($Customers as $Customer) {
            $em->getRepository(Referral::class)->findOrCreateByCustomer($Customer);
            $processedCustomerIds[] = $Customer->getId();
        }
        if ($processedCustomerIds) {
            $qb = $em->createQueryBuilder();
            $query = $qb->from(Referral::class, 'r')
                ->where('r.customer_id NOT IN (:processed_ids)')
                ->setParameter('processed_ids', $processedCustomerIds, \Doctrine\DBAL\Connection::PARAM_STR_ARRAY)
                ->delete()
                ->getQuery();
            $query->execute();
            $em->flush();
        }
    }
}
