<?php

namespace Starkerxp\EcommerceBundle\Forms\Produit;

use Starkerxp\EcommerceBundle\Services\Adaptateur\Marque\CollectionVersChoixSelectElement;
use Starkerxp\EcommerceBundle\Services\Persistence\Lecture\MarqueRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class ModificationProduitForm extends AbstractType
{

    private $marqueRepository;

    public function __construct(MarqueRepository $marqueRepository)
    {
        $this->marqueRepository = $marqueRepository;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $marqueQueryChoices = function(MarqueRepository $marqueRepository) {
            $marqueCollection = $marqueRepository->lister();
            $collectionVersElement = new CollectionVersChoixSelectElement($marqueCollection);
            $donnees = $collectionVersElement->versDonneesFormulaire();
            return $donnees;
        };

        $builder->setMethod('PUT')
                ->add('libelle', 'text', ['label' => "Modifier le libellé : ", 'constraints' => [new NotBlank(), new Length(['min' => 3])]])
                ->add('marqueId', 'choice', [
                    'label' => "Modifier une marque : ",
                    'choices' => $marqueQueryChoices($this->marqueRepository),
                    'empty_value' => 'Sélectionner une marque',
                ])
                ->add('prix', 'text', ['label' => "Modifier le prix : ", 'constraints' => [new NotBlank()]])
                ->add('description', 'textarea', ['label' => "Modifier la description de votre produit : ", 'constraints' => [new NotBlank()]])
                ->add('quantite', 'text', ['label' => "Modifier la quantité disponible : ", 'constraints' => [new NotBlank()]])
                ->add('save', 'submit', ['label' => "Modifier"]);
    }

    public function getName()
    {
        return 'form_creation_marque';
    }

}
