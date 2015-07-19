<?php

namespace Starkerxp\EcommerceBundle\Forms\Produit;

use Starkerxp\DocumentBundle\Forms\Type\FilesType;
use Starkerxp\EcommerceBundle\Services\Adaptateur\Marque\CollectionVersChoixSelectElement;
use Starkerxp\EcommerceBundle\Services\Adaptateur\Produit\ArrayVersChoixRadioElement;
use Starkerxp\EcommerceBundle\Services\Persistence\Lecture\MarqueRepository;
use Starkerxp\EcommerceBundle\Services\Persistence\Lecture\ProduitRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class ModificationProduitForm extends AbstractType
{

    private $marqueRepository;
    private $produitRepository;

    public function __construct(MarqueRepository $marqueRepository, ProduitRepository $produitRepository)
    {
        $this->marqueRepository = $marqueRepository;
        $this->produitRepository = $produitRepository;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $marqueQueryChoices = function(MarqueRepository $marqueRepository) {
            $marqueCollection = $marqueRepository->lister();
            $collectionVersElement = new CollectionVersChoixSelectElement($marqueCollection);
            $donnees = $collectionVersElement->versDonneesFormulaire();
            return $donnees;
        };

        $imageParDefautChoices = function(ProduitRepository $produitRepository, $produitId) {
            $produitPOPO = $produitRepository->get($produitId);
            $images = $produitPOPO->getImages();
            $collectionVersElement = new ArrayVersChoixRadioElement($images);
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
                ->add('prix', 'integer', ['label' => "Modifier le prix : ", 'constraints' => [new NotBlank()]])
                ->add('description', 'textarea', ['label' => "Modifier la description de votre produit : ", 'constraints' => [new NotBlank()]])
                ->add('quantite', 'integer', ['label' => "Modifier la quantité disponible : ", 'constraints' => [new NotBlank()]])
                ->add('images', new FilesType(), ['required' => false])
                ->add('imagesParDefaut', 'choice', [
                    'label' => '',
                    'choices' => $imageParDefautChoices($this->produitRepository, $builder->getData()->getProduitId()),
                    'expanded' => true,
                    'multiple' => false
                ])
                ->add('save', 'submit', ['label' => "Modifier"]);
    }

    public function getName()
    {
        return 'form_modification_produit';
    }

}
