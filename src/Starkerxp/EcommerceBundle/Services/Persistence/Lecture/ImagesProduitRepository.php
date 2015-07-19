<?php

namespace Starkerxp\EcommerceBundle\Services\Persistence\Lecture;

use PDO;
use Starkerxp\EcommerceBundle\Services\Domain\Produit\ProduitPOPO;

class ImagesProduitRepository
{

    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    /**
     * On récupère une produit en particulier.
     *
     * @param type $produitId L'id du produit.
     *
     * @return ProduitPOPO
     */
    public function getToutesLesImagesPourCeProduitId($produitId)
    {
        $sql = "SELECT * FROM produits_images WHERE produit_id = :produit_id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue("produit_id", $produitId);
        $stmt->execute();
        $resultSets = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $resultSets;
    }

}
