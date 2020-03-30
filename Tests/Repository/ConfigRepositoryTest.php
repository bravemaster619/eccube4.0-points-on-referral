<?php

namespace Plugin\PointsOnReferral\Tests\Repository;

use Eccube\Tests\EccubeTestCase;
use Plugin\PointsOnReferral\Entity\Config;
use Plugin\PointsOnReferral\Repository\ConfigRepository;

class ConfigRepositoryTest extends EccubeTestCase {

    /**
     * @var ConfigRepository
     */
    protected $configRepository;

    public function setUp() {
        parent::setUp();
        $this->configRepository = $this->container->get(Config::class);
        $this->deleteAllRows(['plg_points_on_referral_config']);
    }

    public function testGet() {
        $this->assertNotNull($this->configRepository);
        $Config = $this->configRepository->get(1);
        $this->expected = null;
        $this->actual = $Config;
        $this->verify("should return null when table is empty");
        $Config = new Config();
        $Config->setReferrerRewardsEnabled(true)
            ->setReferrerRewards(1500)
            ->setReferrerRewardsEnabled(false)
            ->setRefereeRewards(1000);
        $this->configRepository->save($Config);
        $this->entityManager->flush();

        $PersistedConfig = $this->configRepository->get();
        $this->assertNotNull($PersistedConfig, "should return a Config entity after insert");
        $this->assertEquals($Config->getReferrerRewardsEnabled(), $PersistedConfig->getReferrerRewardsEnabled());
        $this->assertEquals($Config->getRefereeRewardsEnabled(), $PersistedConfig->getRefereeRewardsEnabled());
        $this->assertEquals($Config->getReferrerRewards(), $PersistedConfig->getReferrerRewards());
        $this->assertEquals($Config->getRefereeRewards(), $PersistedConfig->getRefereeRewards());
    }

}
