<?php

namespace Starkerxp\EcommerceBundle\Services\Persistence\Lecture;

use PDO;
use Starkerxp\EcommerceBundle\Services\Domain\Produit\ProduitImagePOPO;

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
     * @return ProduitImagePOPO
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

    /**
     * On récupère l'image par défaut d'un produit.
     *
     * @param type $produitId
     *
     * @return ProduitImagePOPO
     */
    public function getImageParDefautPourCeProduit($produitId)
    {
        $sql = "SELECT * FROM produits_images WHERE produit_id = :produit_id AND affichage_par_defaut = :affichage_par_defaut";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue("produit_id", $produitId);
        $stmt->bindValue("affichage_par_defaut", 1);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $produitImagePOPO = $this->_buildFromData($row);
        return $produitImagePOPO;
    }

    /**
     * On génère un nouvel objet produitPOPO à partir des données issus de la base de données.
     *
     * @param array $row
     *
     * @return ProduitImagePOPO
     */
    private function _buildFromData($row)
    {
        $produitImagePOPO = new ProduitImagePOPO($row['id'], $row['produit_id'], $row['url'], $row['affichage_par_defaut']);
        return $produitImagePOPO;
    }

}
