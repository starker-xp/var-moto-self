<?php

namespace Starkerxp\EcommerceBundle\Forms\Marque;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class ModificationMarqueForm extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->setMethod('PUT')
                ->add('libelle', 'text', ['label' => "Modifié le nom de la marque : ", 'constraints' => [new NotBlank(), new Length(['min' => 3])]])
                ->add('save', 'submit', ['label' => "Modifier"]);
    }

    public function getName()
    {
        return 'form_creation_marque';
    }

}
