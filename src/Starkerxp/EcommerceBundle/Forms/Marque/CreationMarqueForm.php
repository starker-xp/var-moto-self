<?php

namespace Starkerxp\EcommerceBundle\Forms\Marque;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class CreationMarqueForm extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->setMethod('POST')
                ->add('libelle', 'text', ['label' => "Choisissez un libellé : ", 'constraints' => [new NotBlank(), new Length(['min' => 3])]])
                ->add('save', 'submit', ['label' => "Créer"]);
    }

    public function getName()
    {
        return 'form_creation_marque';
    }

}
