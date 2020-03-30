<?php

namespace Plugin\PointsOnReferral\Tests\Repository;

use Plugin\PointsOnReferral\Entity\Config;
use Plugin\PointsOnReferral\Repository\ConfigRepository;
use Plugin\PointsOnReferral\Tests\PointsOnReferralBaseTestCase;

class ConfigRepositoryTest extends PointsOnReferralBaseTestCase {

    /**
     * @var ConfigRepository
     */
    protected $configRepository;

    public function setUp() {
        parent::setUp();
        $this->configRepository = $this->container->get(Config::class);

    }

    public function testGetConfig() {
        $this->deleteAllRows(['plg_points_on_referral_config']);
        $Config = $this->configRepository->getConfig();
        $this->expected = null;
        $this->actual = $Config;
        $this->verify("should return null when table is empty");
        $Config = new Config();
        $Config->setReferrerRewardsEnabled(true)
            ->setReferrerRewards(1500)
            ->setRefereeRewardsEnabled(false)
            ->setRefereeRewards(1000);

        $this->entityManager->persist($Config);
        $this->entityManager->flush();

        $PersistedConfig = $this->configRepository->getConfig();
        $this->assertNotNull($PersistedConfig, "should return a Config entity after insert");
        $this->assertEquals($Config->getReferrerRewardsEnabled(), $PersistedConfig->getReferrerRewardsEnabled());
        $this->assertEquals($Config->getRefereeRewardsEnabled(), $PersistedConfig->getRefereeRewardsEnabled());
        $this->assertEquals($Config->getReferrerRewards(), $PersistedConfig->getReferrerRewards());
        $this->assertEquals($Config->getRefereeRewards(), $PersistedConfig->getRefereeRewards());
    }

}
