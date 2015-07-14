<?php

namespace Starkerxp\UtilisateurBundle\Forms\Utilisateur;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class CreerUtilisateurForm extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->setMethod('POST')
                ->add('role', 'choice', [
                    'label' => "Choisissez un rôle : ",
                    'choices' => ['ROLE_USER' => 'Utilisateur', "ROLE_ADMIN" => "Administrateur"],
                    'empty_value' => 'Sélectionner un rôle',
                ])
                ->add('email', 'email', ['label' => "Adresse email : ", 'constraints' => [new NotBlank(), new Length(['min' => 3])]])
                ->add('nom', 'text', ['label' => "Nom : ", 'constraints' => [new NotBlank(), new Length(['min' => 3])]])
                ->add('prenom', 'text', ['label' => "Prénom : ", 'constraints' => [new NotBlank(), new Length(['min' => 3])]])
                ->add('motDePasse', 'password', ['label' => "Mot de passe : ", 'constraints' => [new NotBlank(), new Length(['min' => 3])]])
                ->add('save', 'submit', ['label' => "Créer"]);
    }

    public function getName()
    {
        return 'form_creation_utilisateur';
    }

}
