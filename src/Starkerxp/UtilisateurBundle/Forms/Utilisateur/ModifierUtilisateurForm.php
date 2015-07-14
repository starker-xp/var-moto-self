<?php

namespace Starkerxp\UtilisateurBundle\Forms\Utilisateur;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class ModifierUtilisateurForm extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->setMethod('PUT')
                ->add('role', 'choice', [
                    'label' => "Choisissez un rôle : ",
                    'choices' => ['ROLE_USER' => 'Utilisateur', "ROLE_ADMIN" => "Administrateur"],
                    'empty_value' => 'Sélectionner un rôle',
                ])
                ->add('email', 'email', ['label' => "Adresse email : ", 'constraints' => [new NotBlank(), new Length(['min' => 3])], 'attr' => ['class' => 'calendar']])
                ->add('nom', 'text', ['label' => "Nom : ", 'constraints' => [new NotBlank(), new Length(['min' => 3])]])
                ->add('prenom', 'text', ['label' => "Prénom : ", 'constraints' => [new NotBlank(), new Length(['min' => 3])]])
                ->add('motDePasse', 'password', ['label' => "Définir un nouveau mot de passe : ", 'required' => false])
                ->add('estActif', 'checkbox', ['label' => 'Compte actif ?', 'required' => false,])
                ->add('save', 'submit', ['label' => "Modifier"]);
    }

    public function getName()
    {
        return 'form_creation_utilisateur';
    }

}
