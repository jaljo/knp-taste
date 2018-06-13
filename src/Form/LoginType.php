<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;

class LoginType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add("_email", EmailType::class)
            ->add("_password", PasswordType::class);
    }

    /**
     * We override this so fields name don't get encapsulated in array
     */
    public function getBlockPrefix()
    {
        return null;
    }
}
