<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

/**
 * Defines the form used to create and manipulate blog posts.
 *
 * @author Ryan Weaver <weaverryan@gmail.com>
 * @author Javier Eguiluz <javier.eguiluz@gmail.com>
 */
class PostType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array                $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        // for the full reference of options defined by each form field type
        // see http://symfony.com/doc/current/reference/forms/types.html
        $builder
            ->add('title')
            ->add('summary', 'textarea')
            ->add('content', 'textarea', array(
                'attr' => array('rows' => 20),
            ))
            ->add('authorEmail', 'email')
            ->add('publishedAt', 'datetime', array(
                'widget' => 'single_text',
            ))
        ;
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Post',
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'post';
    }
}
