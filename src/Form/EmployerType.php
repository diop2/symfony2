<?php

namespace App\Form;

use App\Entity\Employe;
use App\Entity\Service;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;

class EmployerType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('matricule')
            ->add('NomComplet')
            ->add('dateNaissance', DateType::class,[
                'widget'=>'single_text',
                'format'=>'yyyy-MM-dd',
                'emty_date'=>'*'])
            ->add('salaire')
            ->add('service', EntityType::class, [
                'class' => Service::class, 'choice_label'=>'libelle'
                ]);
        
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Employe::class,
        ]);
    }
}
