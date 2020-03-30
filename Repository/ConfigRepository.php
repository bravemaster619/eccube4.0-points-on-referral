<?php

namespace Plugin\PointsOnReferral\Repository;

use Eccube\Repository\AbstractRepository;
use Plugin\PointsOnSignUp\Entity\Config;
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
     * @param int $id
     * @return \Plugin\PointsOnReferral\Entity\Config|null
     */
    public function get($id = 1) {
        return $this->find($id);
    }

}
