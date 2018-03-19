<?php

namespace App\Form;

use App\Entity\Port;
use App\Entity\Review;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ReviewType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('review')
            ->add('placeOfPurchase')
            ->add('pricePaid')
            ->add('numOfStars')
            ->add('user')
            ->add('date')
        //    ->add('port');
            ->add('port', Port::class, [
            // list objects from this class
            'class' => 'App:Port',

            // use the 'Category.name' property as the visible option string
            'choice_label' => 'portName',
    ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Review::class,
        ]);
    }
}
