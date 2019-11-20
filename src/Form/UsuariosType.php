<?php

namespace App\Form;

use App\Entity\Usuarios;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UsuariosType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nombres')
            ->add('apellidos')
            ->add('cedula', TextType::class, array(
                'attr' => array('class' => 'input-number','autocomplete'=>'off')
            ))
            ->add('correo', EmailType::class, array(
                'attr' => array('class' => 'email','autocomplete'=>'off')
            ))
            ->add('telefono', TextType::class, array(
                'attr' => array('class' => 'input-number','autocomplete'=>'off')
            ))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Usuarios::class,
        ]);
    }
}
