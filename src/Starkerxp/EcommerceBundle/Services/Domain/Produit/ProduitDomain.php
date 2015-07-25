<?php

namespace Starkerxp\EcommerceBundle\Services\Domain\Produit;

use Starkerxp\CQRSESBundle\Services\Domain\DomainEvents;
use Starkerxp\EcommerceBundle\Services\Command\Produit\ModifierProduitCommand;
use Starkerxp\EcommerceBundle\Services\Command\Produit\SupprimerImageProduitCommand;
use Starkerxp\EcommerceBundle\Services\Command\Produit\SupprimerProduitCommand;
use Starkerxp\EcommerceBundle\Services\Domain\Produit\Event\ProduitAEteCreeV2;
use Starkerxp\EcommerceBundle\Services\Domain\Produit\Event\UneImageProduitAEteSupprime;
use Starkerxp\EcommerceBundle\Services\Domain\Produit\Event\UneModificationDeLaDescriptionProduit;
use Starkerxp\EcommerceBundle\Services\Domain\Produit\Event\UneModificationDeLaMarqueProduit;
use Starkerxp\EcommerceBundle\Services\Domain\Produit\Event\UneModificationDeLaQuantiteProduit;
use Starkerxp\EcommerceBundle\Services\Domain\Produit\Event\UneModificationDeLImageParDefautDuProduit;
use Starkerxp\EcommerceBundle\Services\Domain\Produit\Event\UneModificationDuLibelleProduit;
use Starkerxp\EcommerceBundle\Services\Domain\Produit\Event\UneModificationDuPrixProduit;
use Starkerxp\EcommerceBundle\Services\Domain\Produit\Event\UneNouvellePhotoAEteAjoute;
use Starkerxp\EcommerceBundle\Services\Domain\Produit\Event\UnProduitAEteSupprime;

class ProduitDomain extends DomainEvents
{

    private $produitId;
    private $libelle;
    private $description;
    private $prix;
    private $quantite;
    private $marqueId;
    private $images = [];
    private $imagesParDefaut;

    private function __construct($produitId, $marqueId, $libelle, $description, $prix, $quantite)
    {
        $this->produitId = $produitId;
        $this->marqueId = $marqueId;
        $this->libelle = $libelle;
        $this->description = $description;
        $this->prix = $prix;
        $this->quantite = $quantite;
    }

    public function getAggregateId()
    {
        return $this->produitId;
    }

    public static function cree($produitId, $marqueId, $libelle, $description, $prix, $quantite, $images)
    {
        $nouveauProduit = new ProduitDomain($produitId, $marqueId, $libelle, $description, $prix, $quantite);
        $nouveauProduit->enregistrementEvenement(new ProduitAEteCreeV2($produitId, $marqueId, $libelle, $description, $prix, $quantite));
        $version = 2;
        if (empty($images)) {
            return $nouveauProduit;
        }
        foreach ($images as $key => $imagePOPO) {
            $eventImage = new UneNouvellePhotoAEteAjoute($imagePOPO->getId(), $produitId, $imagePOPO->getUrl(), $imagePOPO->getAffichageParDefaut());
            $eventImage->setVersion($version);
            $nouveauProduit->enregistrementEvenement($eventImage);
            $version++;
            if ($key == 0) {
                $eventImage = new UneModificationDeLImageParDefautDuProduit($produitId, $imagePOPO->getId());
                $eventImage->setVersion($version);
                $nouveauProduit->enregistrementEvenement($eventImage);
                $version++;
            }
        }
        return $nouveauProduit;
    }

    public static function creeVide($produitId)
    {
        return new ProduitDomain($produitId, null, null, null, null, null, null);
    }

    public function applyProduitAEteCree($event)
    {
        $this->marqueId = $event->getMarqueId();
        $this->libelle = $event->getLibelle();
        $this->description = $event->getDescription();
        $this->prix = $event->getPrix();
        $this->quantite = $event->getQuantite();
    }

    public function applyProduitAEteCreeV2($event)
    {
        $this->applyProduitAEteCree($event);
    }

    public function modifierLeLibelle($libelle)
    {
        $event = new UneModificationDuLibelleProduit($this->produitId, $libelle);
        $event->setVersion($this->getUpdateVersion());
        $this->enregistrementEvenement($event);
        $this->apply($event);
    }

    public function applyUneModificationDuLibelleProduit(UneModificationDuLibelleProduit $event)
    {
        $this->libelle = $event->getLibelle();
    }

    public function modifierLaDescription($description)
    {
        $event = new UneModificationDeLaDescriptionProduit($this->produitId, $description);
        $event->setVersion($this->getUpdateVersion());
        $this->enregistrementEvenement($event);
        $this->apply($event);
    }

    public function applyUneModificationDeLaDescriptionProduit(UneModificationDeLaDescriptionProduit $event)
    {
        $this->description = $event->getDescription();
    }

    public function modifierLePrix($prix)
    {
        $event = new UneModificationDuPrixProduit($this->produitId, $prix);
        $event->setVersion($this->getUpdateVersion());
        $this->enregistrementEvenement($event);
        $this->apply($event);
    }

    public function applyUneModificationDuPrixProduit(UneModificationDuPrixProduit $event)
    {
        $this->prix = $event->getPrix();
    }

    public function modifierLaQuantite($quantite)
    {
        $event = new UneModificationDeLaQuantiteProduit($this->produitId, $quantite);
        $event->setVersion($this->getUpdateVersion());
        $this->enregistrementEvenement($event);
        $this->apply($event);
    }

    public function applyUneModificationDeLaQuantiteProduit(UneModificationDeLaQuantiteProduit $event)
    {
        $this->quantite = $event->getQuantite();
    }

    public function modifierLaMarque($marqueId)
    {
        $event = new UneModificationDeLaMarqueProduit($this->produitId, $marqueId);
        $event->setVersion($this->getUpdateVersion());
        $this->enregistrementEvenement($event);
        $this->apply($event);
    }

    public function applyUneModificationDeLaMarqueProduit(UneModificationDeLaMarqueProduit $event)
    {
        $this->marqueId = $event->getMarqueId();
    }

    public function modifierLeProduit(ModifierProduitCommand $command)
    {
        if ($this->prix != ($prix = $command->getPrix())) {
            $this->modifierLePrix($prix);
        }

        if ($this->libelle != ($libelle = $command->getLibelle())) {
            $this->modifierLeLibelle($libelle);
        }

        if ($this->description != ($description = $command->getDescription())) {
            $this->modifierLaDescription($description);
        }

        if ($this->prix != ($prix = $command->getPrix())) {
            $this->modifierLePrix($prix);
        }

        if ($this->quantite != ($quantite = $command->getQuantite())) {
            $this->modifierLaQuantite($quantite);
        }

        if ($this->marqueId != ($marqueId = $command->getMarqueId())) {
            $this->modifierLaMarque($marqueId);
        }
        if ($this->imagesParDefaut != ($imagesParDefaut = $command->getImagesParDefaut())) {
            $this->modifierImageParDefaut($imagesParDefaut);
        }
    }

    public function applyUneNouvellePhotoAEteAjoute(UneNouvellePhotoAEteAjoute $event)
    {
        $this->images[$event->getImageProduitId()] = $event->versTableau();
    }

    public function modifierImageParDefaut($imagesParDefaut)
    {
        $event = new UneModificationDeLImageParDefautDuProduit($this->produitId, $imagesParDefaut);
        $event->setVersion($this->getUpdateVersion());
        $this->enregistrementEvenement($event);
        $this->apply($event);
    }

    public function applyUneModificationDeLImageParDefautDuProduit(UneModificationDeLImageParDefautDuProduit $event)
    {
        $this->imagesParDefaut = $event->getImagesParDefaut();
    }

    public function supprimerUnProduit(SupprimerProduitCommand $command)
    {
        $event = new UnProduitAEteSupprime($this->produitId);
        $event->setVersion($this->getUpdateVersion());
        $this->enregistrementEvenement($event);
    }

    public function applyUnProduitAEteSupprime(UnProduitAEteSupprime $event)
    {

    }

    /**
     * Permet de déclencher l'évènement de suppression d'image produit.
     *
     * @param SupprimerImageProduitCommand $command
     * @param string                       $repertoire
     *
     */
    public function supprimerUneImageProduit(SupprimerImageProduitCommand $command, $repertoire)
    {
        $event = new UneImageProduitAEteSupprime($this->produitId, $command->getImageProduitId(), $repertoire);
        $event->setVersion($this->getUpdateVersion());
        $this->enregistrementEvenement($event);
        $this->apply($event);
    }

    public function applyUneImageProduitAEteSupprime(UneImageProduitAEteSupprime $event)
    {
        $fichier = $event->getRepertoire() . $this->images[$event->getImageProduitId()]['url'];
        if (file_exists($fichier)) {
            unlink($fichier);
        }
        unset($this->images[$event->getImageProduitId()]);
    }

}
