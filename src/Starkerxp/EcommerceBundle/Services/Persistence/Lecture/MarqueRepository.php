<?php

namespace Starkerxp\EcommerceBundle\Services\Persistence\Lecture;

use Starkerxp\EcommerceBundle\Services\Domain\Marque\MarqueDTO;
use Starkerxp\EcommerceBundle\Services\Domain\Marque\MarqueCollection;

class MarqueRepository
{

    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function lister()
    {
        $marqueCollection = new MarqueCollection();
        $stmt = $this->pdo->query('SELECT * FROM marques');
        $stmt->execute();
        $resultSets = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        foreach ($resultSets as $row) {
            $marqueCollection->ajouter(new MarqueDTO($row['id'], $row['libelle']));
        }
        return $marqueCollection;
    }

    public function get($marqueId)
    {
        $sql = "SELECT * FROM marques WHERE id = :marque_id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue("marque_id", $marqueId);
        $stmt->execute();
        $row = $stmt->fetch(\PDO::FETCH_ASSOC);
        return new MarqueDTO($row['id'], $row['libelle']);
    }

}
