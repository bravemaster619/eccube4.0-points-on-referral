<?php

namespace Plugin\PointsOnReferral\Repository;

use Eccube\Repository\AbstractRepository;
use Plugin\PointsOnReferral\Entity\Config;
use Symfony\Bridge\Doctrine\RegistryInterface;

class ConfigRepository extends AbstractRepository {

    /**
     * ConfigRepository constructor.
     *
     * @param RegistryInterface $registry
     */
    public function __construct(RegistryInterface $registry) {
        parent::__construct($registry, Config::class);
    }

    /**
     * @return \Plugin\PointsOnReferral\Entity\Config|null
     */
    public function getConfig() {
        return $this->findOneBy([], ['id' => 'desc']);
    }

}
