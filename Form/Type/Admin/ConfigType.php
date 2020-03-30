<?php

namespace Plugin\PointsOnReferral\Form\Type\Admin;

use Eccube\Form\Type\ToggleSwitchType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints as Assert;
class ConfigType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {

        $builder->add('referrer_rewards_enabled', ToggleSwitchType::class, array(
            'required' => false,
            'label' => 'points_on_referral.admin.config.form.referrer.enabled.label',
            'mapped' => true,
        ))->add('referrer_rewards', IntegerType::class, array(
            'required' => true,
            'label' => 'points_on_referral.admin.config.form.referrer.point.label',
            'mapped' => true,
            'attr' => array(
                'placeholder' => 'points_on_referral.admin.config.form.referrer.point.placeholder'
            ),
            'constraints' => array(
                new Assert\NotBlank(),
                new Assert\GreaterThanOrEqual(0)
            )
        ))->add('referee_rewards_enabled', ToggleSwitchType::class, array(
            'required' => false,
            'label' => 'points_on_referral.admin.config.form.referee.enabled.label',
            'mapped' => true
        ))->add('referee_rewards', IntegerType::class, array(
            'required' => true,
            'label' => 'points_on_referral.admin.config.form.referee.point.label',
            'mapped' => true,
            'attr' => array(
                'placeholder' => 'points_on_referral.admin.config.form.referee.point.placeholder'
            ),
            'constraints' => array(
                new Assert\NotBlank(),
                new Assert\GreaterThanOrEqual(0)
            )
        ));
    }

}
