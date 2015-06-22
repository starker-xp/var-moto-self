<?php

namespace Starkerxp\EcommerceBundle\Forms\Produit;

use Starkerxp\EcommerceBundle\Services\Adaptateur\Marque\CollectionVersChoixSelectElement;
use Starkerxp\EcommerceBundle\Services\Persistence\Lecture\Marque\MarqueRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class CreationProduitForm extends AbstractType
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

        $builder->setMethod('POST')
                ->add('libelle', 'text', ['label' => "Choisissez un libellé : ", 'constraints' => [new NotBlank(), new Length(['min' => 3])]])
                ->add('marqueId', 'choice', [
                    'label' => "Choisissez une marque : ",
                    'choices' => $marqueQueryChoices($this->marqueRepository),
                    'empty_value' => 'Sélectionner une marque',
                ])
                ->add('prix', 'text', ['label' => "Choisissez un prix : ", 'constraints' => [new NotBlank()]])
                ->add('description', 'textarea', ['label' => "Description de votre produit : ", 'constraints' => [new NotBlank()]])
                ->add('quantite', 'text', ['label' => "Stock disponible : ", 'constraints' => [new NotBlank()]])
                ->add('save', 'submit', ['label' => "Créer"]);
    }

    public function getName()
    {
        return 'form_creation_produit';
    }

}
