<?php

namespace Starkerxp\EcommerceBundle\Services\Persistence\Ecriture\Produit;

use PDO;
use Starkerxp\EcommerceBundle\Services\Domain\Produit\Event\ProduitAEteCree;

class ProduitProjection
{

    /**
     * @var PDO
     */
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function getPdo()
    {
        return $this->pdo;
    }

    public function project($events)
    {
        foreach ($events as $event) {
            $className = get_class($event);
            $arrayClass = explode("\\", $className);
            $projectMetohd = 'project' . $arrayClass[count($arrayClass) - 1];
            $this->$projectMetohd($event);
        }
    }

    public function projectProduitAEteCree(ProduitAEteCree $event)
    {
        $sql = 'INSERT INTO produits (id, marque_id, libelle, description, prix, quantite) VALUES (:produit_id, :marque_id,  :libelle, :description, :prix, :quantite)';
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            ':produit_id' => $event->getAggregateId(),
            ':marque_id' => $event->getMarqueId(),
            ':libelle' => $event->getLibelle(),
            ':description' => $event->getDescription(),
            ':prix' => $event->getPrix(),
            ':quantite' => $event->getQuantite(),
        ]);
    }

}
