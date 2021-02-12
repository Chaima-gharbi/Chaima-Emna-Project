<?php

namespace App\Form;

use App\Entity\Abonnee;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AbonneeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('prenom',TextType::class,['attr'=>['class'=>'form-control'],'label'=>'Prenom'])
            ->add('nom',TextType::class,['attr'=>['class'=>'form-control'],'label'=>'Nom'])
            ->add('email',TextType::class,['attr'=>['class'=>'form-control'],'label'=>'Email'])
            ->add('motDePasse',TextType::class,['attr'=>['class'=>'form-control'],'label'=>'MotDepasse'])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Abonnee::class,
        ]);
    }
}
