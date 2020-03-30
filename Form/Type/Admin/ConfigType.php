<?php

namespace Plugin\PointsOnReferral\Form\Type\Admin;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints as Assert;
class ConfigType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {

        $builder->add('referrer_rewards_enabled', CheckboxType::class, array(
            'required' => false,
            'label' => 'admin.form.rewards.referrer.enabled.label',
            'mapped' => true,
        ))->add('referrer_rewards', IntegerType::class, array(
            'required' => true,
            'label' => 'admin.form.rewards.referrer.point.label',
            'mapped' => true,
            'attr' => array(
                'placeholder' => 'admin.form.rewards.referrer.point.placeholder'
            ),
            'constraints' => array(
                new Assert\NotBlank(),
                new Assert\GreaterThanOrEqual(0)
            )
        ))->add('referee_rewards_enabled', CheckboxType::class, array(
            'required' => false,
            'label' => 'admin.form.rewards.referee.enabled.label',
            'mapped' => true
        ))->add('referee_rewards', IntegerType::class, array(
            'required' => true,
            'label' => 'admin.form.rewards.referee.point.label',
            'mapped' => true,
            'attr' => array(
                'placeholder' => 'admin.form.rewards.referee.point.placeholder'
            ),
            'constraints' => array(
                new Assert\NotBlank(),
                new Assert\GreaterThanOrEqual(0)
            )
        ));
    }

}
