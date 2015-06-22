<?php

namespace Starkerxp\EcommerceBundle\Services\Persistence\Marque\Read;

use Starkerxp\EcommerceBundle\Services\Domain\Marque\MarqueDTO;

class MarqueRepository
{

    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function lister()
    {
        $stmt = $this->pdo->query('SELECT * FROM marques');
        $stmt->execute();
        $marques = [];
        $resultSets = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        foreach ($resultSets as $row) {
            $marques[] = new MarqueDTO($row['id'], $row['libelle']);
        }
        return $marques;
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
