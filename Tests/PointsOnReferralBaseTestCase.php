<?php

namespace Plugin\PointsOnReferral\Tests;

use Eccube\Tests\EccubeTestCase;
use Plugin\PointsOnReferral\Entity\Config;

abstract class PointsOnReferralBaseTestCase extends EccubeTestCase {

    public function setUp() {
        parent::setUp();
        $this->container->set(Config::class, $this->entityManager->getRepository(Config::class));
    }

}
