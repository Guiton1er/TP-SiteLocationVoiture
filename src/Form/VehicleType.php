<?php

namespace App\Form;

use App\Entity\Model;
use App\Entity\Option;
use App\Entity\Type;
use App\Entity\Vehicle;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class VehicleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('capacity')
            ->add('price')
            ->add('numberKilometers')
            ->add('numberPlate')
            ->add('yearOfVehicle')
            ->add('picturePath')
            ->add('type', EntityType::class, [
                'class' => Type::class,
'choice_label' => 'id',
            ])
            ->add('model', EntityType::class, [
                'class' => Model::class,
'choice_label' => 'id',
            ])
            ->add('options', EntityType::class, [
                'class' => Option::class,
'choice_label' => 'id',
'multiple' => true,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Vehicle::class,
        ]);
    }
}
