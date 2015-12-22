<?php

namespace Ticme\BackBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
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
            ->add('zipcode',null, array('attr' => array('class' => 'cp',
                'maxlength' => 5)))
            ->add('city','choice', array(
                'choices' => array(
                    'Bailleul' => 'Bailleul',
                    'Saint-Jans Cappel' => 'Saint-Jans Cappel',
                    'Meteren' => 'Meteren',
                ),
                'choices_as_values' => true,
                'attr' => array('class' => 'ville')))
            ->add('country')
            ->add('complement',null,array('required' => false))
            //->add('user')
        ;

        /*
        $city = function(FormInterface $form, $cp) {
            $villeCodePostal = $this->em->getRepository('UtilisateursBundle:Villes')->findBy(array('villeCodePostal' => $cp));

            if ($villeCodePostal) {
                $villes = array();
                foreach($villeCodePostal as $ville) {
                    $villes[$ville->getVilleNom()] = $ville->getVilleNom();
                }
            } else {
                $villes = null;
            }

            $form->add('city','choice', array('attr' => array('class'   => 'ville'),
                'choices' => $villes));
        };

        $builder->get('zipcode')->addEventListener(FormEvents::POST_SUBMIT, function(FormEvent $event) use ($city) {
            $city($event->getForm()->getParent(),$event->getForm()->getData());
        });
        */
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
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