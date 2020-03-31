<?php


namespace Plugin\PointsOnReferral\Repository;


use Eccube\Entity\Customer;
use Eccube\Repository\AbstractRepository;
use Plugin\PointsOnReferral\Entity\Config;
use Plugin\PointsOnReferral\Entity\History;
use Symfony\Bridge\Doctrine\RegistryInterface;

class HistoryRepository extends AbstractRepository {
    /**
     * ConfigRepository constructor
     *
     * @param RegistryInterface $registry
     */
    public function __construct(RegistryInterface $registry) {
        parent::__construct($registry, History::class);
    }

    /**
     * @param Customer $Referrer
     * @param Customer $Referee
     * @param Config $Config
     */
    public function create(Customer $Referrer, Customer $Referee, Config $Config) {
        $History = new History();
        $History->setReferrerId($Referrer->getId())
            ->setReferrerEmail($Referrer->getEmail())
            ->setReferrerName01($Referrer->getName01())
            ->setReferrerName02($Referrer->getName02())
            ->setReferrerKana01($Referrer->getKana01())
            ->setReferrerKana02($Referrer->getKana02())
            ->setRefereeId($Referee->getId())
            ->setRefereeEmail($Referee->getEmail())
            ->setRefereeName01($Referee->getName01())
            ->setRefereeName02($Referee->getName02())
            ->setRefereeKana01($Referee->getKana01())
            ->setRefereeKana02($Referee->getKana02())
            ->setReferrerReadDate(null)
            ->setRefereeReadDate(null)
            ->setVisibleToReferrer(true)
            ->setVisibleToReferee(true)
            ->setReferrerRewards(0)
            ->setRefereeRewards(0)
            ->setCreateDate(date_create());
        if ($Config->getReferrerRewardsEnabled() && $Config->getReferrerRewards()) {
            $History->setReferrerRewards($Config->getReferrerRewards());
        }
        if ($Config->getRefereeRewardsEnabled() && $Config->getRefereeRewards()) {
            $History->setRefereeRewards($Config->getRefereeRewards());
        }
        $this->getEntityManager()->persist($History);
        $this->getEntityManager()->flush();
        return $History;
    }
}
