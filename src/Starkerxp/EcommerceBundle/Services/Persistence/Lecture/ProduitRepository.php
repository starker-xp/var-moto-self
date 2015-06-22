<?php

namespace Starkerxp\EcommerceBundle\Services\Persistence\Lecture;

use PDO;
use Starkerxp\EcommerceBundle\Services\Domain\Marque\MarqueDTO;
use Starkerxp\EcommerceBundle\Services\Domain\Produit\ProduitCollection;
use Starkerxp\EcommerceBundle\Services\Domain\Produit\ProduitDTO;

class ProduitRepository
{

    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function lister()
    {
        $produitCollection = new ProduitCollection();
        $stmt = $this->pdo->query('SELECT * FROM produits');
        $stmt->execute();
        $resultSets = $stmt->fetchAll(PDO::FETCH_ASSOC);
        foreach ($resultSets as $row) {
            $produitDto = new ProduitDTO($row['id'], new MarqueDTO($row['marque_id'], null), $row['libelle'], $row['description'], $row['prix'], $row['quantite'], $row['sku']);
            $produitCollection->ajouter($produitDto);
        }
        return $produitCollection;
    }

    public function get($produitId)
    {
        $sql = "SELECT * FROM produits WHERE id = :produit_id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue("produit_id", $produitId);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return new ProduitDTO($row['id'], new MarqueDTO($row['marque_id'], null), $row['libelle'], $row['description'], $row['prix'], $row['quantite'], $row['sku']);
    }

}
