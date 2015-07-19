<?php

namespace Starkerxp\EcommerceBundle\Services\Persistence\Ecriture\Produit;

use Starkerxp\CQRSESBundle\Services\Persistence\AbstractProjection;
use Starkerxp\EcommerceBundle\Services\Domain\Produit\Event\ProduitAEteCree;
use Starkerxp\EcommerceBundle\Services\Domain\Produit\Event\ProduitAEteCreeV2;
use Starkerxp\EcommerceBundle\Services\Domain\Produit\Event\UneModificationDeLaDescriptionProduit;
use Starkerxp\EcommerceBundle\Services\Domain\Produit\Event\UneModificationDeLaMarqueProduit;
use Starkerxp\EcommerceBundle\Services\Domain\Produit\Event\UneModificationDeLaQuantiteProduit;
use Starkerxp\EcommerceBundle\Services\Domain\Produit\Event\UneModificationDeLImageParDefautDuProduit;
use Starkerxp\EcommerceBundle\Services\Domain\Produit\Event\UneModificationDuLibelleProduit;
use Starkerxp\EcommerceBundle\Services\Domain\Produit\Event\UneModificationDuPrixProduit;
use Starkerxp\EcommerceBundle\Services\Domain\Produit\Event\UneNouvellePhotoAEteAjoute;
use Starkerxp\EcommerceBundle\Services\Domain\Produit\Event\UnProduitAEteSupprime;

class ProduitProjection extends AbstractProjection
{

    public function projectProduitAEteCree(ProduitAEteCree $event)
    {
        $sql = 'INSERT INTO produits (id, marque_id, libelle, description, prix, quantite) VALUES (:produit_id, :marque_id,  :libelle, :description, :prix, :quantite)';
        $stmt = $this->getPdo()->prepare($sql);
        $stmt->execute([
            ':produit_id' => $event->getAggregateId(),
            ':marque_id' => $event->getMarqueId(),
            ':libelle' => $event->getLibelle(),
            ':description' => $event->getDescription(),
            ':prix' => $event->getPrix(),
            ':quantite' => $event->getQuantite(),
        ]);
    }

    public function projectProduitAEteCreeV2(ProduitAEteCreeV2 $event)
    {
        $sql = 'INSERT INTO produits (id, marque_id, libelle, description, prix, quantite) VALUES (:produit_id, :marque_id,  :libelle, :description, :prix, :quantite)';
        $stmt = $this->getPdo()->prepare($sql);
        $stmt->execute([
            ':produit_id' => $event->getAggregateId(),
            ':marque_id' => $event->getMarqueId(),
            ':libelle' => $event->getLibelle(),
            ':description' => $event->getDescription(),
            ':prix' => $event->getPrix(),
            ':quantite' => $event->getQuantite(),
        ]);
    }

    public function projectUneNouvellePhotoAEteAjoute(UneNouvellePhotoAEteAjoute $event)
    {
        $sqlImages = 'INSERT INTO produits_images (id, produit_id, url, affichage_par_defaut) VALUES (:id, :produit_id, :url, :affichage_par_defaut)';
        $stmtImages = $this->getPdo()->prepare($sqlImages);
        $stmtImages->execute([
            ':id' => $event->getImageProduitId(),
            ':produit_id' => $event->getAggregateId(),
            ':url' => $event->getUrl(),
            ':affichage_par_defaut' => $event->getAffichageParDefaut(),
        ]);
    }

    public function projectUneModificationDeLImageParDefautDuProduit(UneModificationDeLImageParDefautDuProduit $event)
    {
        $sqlImages = "UPDATE produits_images SET affichage_par_defaut=:affichage_par_defaut WHERE produit_id= :produit_id";
        $stmtImages = $this->getPdo()->prepare($sqlImages);
        $stmtImages->execute([
            ':produit_id' => $event->getAggregateId(),
            ':affichage_par_defaut' => 0,
        ]);

        $sql = 'UPDATE produits_images SET affichage_par_defaut=:affichage_par_defaut WHERE produit_id= :produit_id AND id=:id';
        $stmt = $this->getPdo()->prepare($sql);
        $stmt->execute([
            ':produit_id' => $event->getAggregateId(),
            ':id' => $event->getImagesParDefaut(),
            ':affichage_par_defaut' => 1,
        ]);
    }

    public function projectUneModificationDeLaMarqueProduit(UneModificationDeLaMarqueProduit $event)
    {
        $sql = 'UPDATE produits SET marque_id= :marque_id WHERE id= :produit_id';
        $stmt = $this->getPdo()->prepare($sql);
        $stmt->execute([
            ':produit_id' => $event->getAggregateId(),
            ':marque_id' => $event->getMarqueId(),
        ]);
    }

    public function projectUneModificationDeLaDescriptionProduit(UneModificationDeLaDescriptionProduit $event)
    {
        $sql = 'UPDATE produits SET description= :description WHERE id= :produit_id';
        $stmt = $this->getPdo()->prepare($sql);
        $stmt->execute([
            ':produit_id' => $event->getAggregateId(),
            ':description' => $event->getDescription(),
        ]);
    }

    public function projectUneModificationDeLaQuantiteProduit(UneModificationDeLaQuantiteProduit $event)
    {
        $sql = 'UPDATE produits SET quantite= :quantite WHERE id= :produit_id';
        $stmt = $this->getPdo()->prepare($sql);
        $stmt->execute([
            ':produit_id' => $event->getAggregateId(),
            ':quantite' => $event->getQuantite(),
        ]);
    }

    public function projectUneModificationDuLibelleProduit(UneModificationDuLibelleProduit $event)
    {
        $sql = 'UPDATE produits SET libelle= :libelle WHERE id= :produit_id';
        $stmt = $this->getPdo()->prepare($sql);
        $stmt->execute([
            ':produit_id' => $event->getAggregateId(),
            ':libelle' => $event->getLibelle(),
        ]);
    }

    public function projectUneModificationDuPrixProduit(UneModificationDuPrixProduit $event)
    {
        $sql = 'UPDATE produits SET prix= :prix WHERE id= :produit_id';
        $stmt = $this->getPdo()->prepare($sql);
        $stmt->execute([
            ':produit_id' => $event->getAggregateId(),
            ':prix' => $event->getPrix(),
        ]);
    }

    public function projectUnProduitAEteSupprime(UnProduitAEteSupprime $event)
    {
        $sql = 'DELETE FROM produits WHERE id= :produit_id';
        $stmt = $this->getPdo()->prepare($sql);
        $stmt->execute([
            ':produit_id' => $event->getAggregateId()
        ]);
    }

}
