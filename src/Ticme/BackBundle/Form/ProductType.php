<?php

namespace Ticme\BackBundle\Form;

use Doctrine\ORM\EntityRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Ticme\BackBundle\Entity\Tva;
use Ticme\BackBundle\Entity\Category;


class ProductType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', 'text')
            ->add('description', 'textarea')
            ->add('priceHt', 'number')
            ->add('available', 'checkbox', array(
                'label'     => 'Afficher publiquement ?',
                'required'  => false,
            ))
        ;
        //Le bouton submit est à ajouter de préférence en static dans les vues
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Ticme\BackBundle\Entity\Product'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'ticme_backbundle_product';
    }
}
