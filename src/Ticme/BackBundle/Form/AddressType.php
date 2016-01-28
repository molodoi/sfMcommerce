<?php

namespace Ticme\BackBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;

class AddressType extends AbstractType
{
    private $em;

    public function __construct($em)
    {
        $this->em = $em;
    }

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('lastname')
            ->add('phone')
            ->add('address')
            ->add('zipcode',null,
                array(
                    'attr' =>
                        array(
                            'class' => 'zipcode',
                            'maxlength' => 5
                        )
                )
            )
            /*->add('city','choice',
                array(
                    'choices' =>
                        array(
                            'Bailleul' => 'Bailleul',
                            'Saint-Jans Cappel' => 'Saint-Jans Cappel',
                            'Meteren' => 'Meteren',
                        ),
                        'choices_as_values' => true,
                        'attr' => array(
                            'class' => 'city'
                        )
                )
            )*/
            ->add('city', 'choice', array('attr' => array( 'class' => 'city' ) ) )
            ->add('country')
            ->add('complement',null,array('required' => false))
            //->add('user')
        ;


        $city = function(FormInterface $form, $zipcode) {
            $cityZipcode = $this->em->getRepository('TicmeUserBundle:City')->findBy(
                array('cityZipcode' => $zipcode)
            );

            if ($cityZipcode) {
                $cities = array();
                foreach($cityZipcode as $city) {
                    $cities[$city->getCityName()] = $city->getCityName();
                }
            } else {
                $cities = null;
            }

            $form->add('city','choice', array('attr' => array('class'   => 'city'),
                'choices' => $cities));
        };

        /*
         * How to Dynamically Modify Forms Using Form Events
         * http://symfony.com/doc/current/cookbook/form/dynamic_form_modification.html
        */
        $builder->get('zipcode')->addEventListener(FormEvents::POST_SUBMIT, function(FormEvent $event) use ($city) {
            $city($event->getForm()->getParent(),$event->getForm()->getData());
        });

    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Ticme\BackBundle\Entity\Address'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'ticme_backbundle_address';
    }
}