<?php

namespace Starkerxp\EcommerceBundle\Services\Persistence\Lecture;

use PDO;
use Starkerxp\EcommerceBundle\Services\Domain\Produit\ProduitCollection;
use Starkerxp\EcommerceBundle\Services\Domain\Produit\ProduitPOPO;
use Starkerxp\EcommerceBundle\Services\Persistence\Lecture\MarqueRepository;

class ProduitRepository
{

    private $pdo;
    private $marqueRepository;

    public function __construct($pdo, MarqueRepository $marqueRepository)
    {
        $this->pdo = $pdo;
        $this->marqueRepository = $marqueRepository;
    }

    /**
     * On récupère la liste des produits.
     *
     * @return ProduitCollection
     */
    public function lister()
    {
        $produitCollection = new ProduitCollection();
        $stmt = $this->pdo->query('SELECT * FROM produits');
        $stmt->execute();
        $resultSets = $stmt->fetchAll(PDO::FETCH_ASSOC);
        foreach ($resultSets as $row) {
            $produitCollection->ajouter($this->_buildFromData($row));
        }
        return $produitCollection;
    }

    /**
     * On récupère une produit en particulier.
     *
     * @param type $produitId L'id du produit.
     *
     * @return ProduitPOPO
     */
    public function get($produitId)
    {
        $sql = "SELECT * FROM produits WHERE id = :produit_id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue("produit_id", $produitId);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $produitPOPO = $this->_buildFromData($row);
        return $produitPOPO;
    }

    /**
     * On génère un nouvel objet produitPOPO à partir des données issus de la base de données.
     *
     * @param array $row
     * 
     * @return ProduitPOPO
     */
    private function _buildFromData($row)
    {
        $produitPOPO = new ProduitPOPO($row['id'], $row['marque_id'], $row['libelle'], $row['description'], $row['prix'], $row['quantite'], $row['sku']);
        $produitPOPO->setMarqueRepository($this->marqueRepository);
        return $produitPOPO;
    }

}
