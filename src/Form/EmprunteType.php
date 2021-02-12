<?php

namespace App\Form;

use App\Entity\Emprunte;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use App\Entity\Abonnee;
use App\Entity\Livre;

class EmprunteType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder

            ->add('livres',EntityType::class,
                ['attr'=>['class'=>'form-control'],'label'=>"Livre",
                    'class'=>Livre::class,'multiple'=>true,'expanded'=>false,'choice_label'=>'titre'])
            ->add('dateEmprunte',DateType::class,['widget'=>'single_text','attr'=>['class'=>'form-control'],'label'=>'Date emprunte'])
            ->add('dateRetour',DateType::class,['widget'=>'single_text','attr'=>['class'=>'form-control'],'label'=>'Date retour'])

        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Emprunte::class,
        ]);
    }
}
