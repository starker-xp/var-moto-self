<?php

namespace Starkerxp\EcommerceBundle\Services\Persistence\Ecriture\Marque;

use Doctrine\DBAL\Connection;
use Starkerxp\EcommerceBundle\Services\Domain\Marque\Event\MarqueAEteCree;
use Starkerxp\EcommerceBundle\Services\Domain\Marque\Event\ModificationLibelleMarque;
use Starkerxp\EcommerceBundle\Services\Domain\Marque\Event\UneMarqueAEteSupprime;

class MarqueProjection
{

    private $pdo;

    public function __construct(Connection $pdo)
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

    public function projectMarqueAEteCree(MarqueAEteCree $event)
    {
        $sql = 'INSERT INTO marques (id, libelle) VALUES (:marque_id, :libelle)';
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            ':marque_id' => $event->getAggregateId(),
            ':libelle' => $event->getLibelle(),
        ]);
    }

    public function projectModificationLibelleMarque(ModificationLibelleMarque $event)
    {
        $sql = 'UPDATE marques SET libelle= :libelle WHERE id= :marque_id';
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            ':marque_id' => $event->getAggregateId(),
            ':libelle' => $event->getLibelle(),
        ]);
    }

    public function projectUneMarqueAEteSupprime(UneMarqueAEteSupprime $event)
    {
        $sql = 'DELETE FROM marques WHERE id= :marque_id';
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            ':marque_id' => $event->getAggregateId()
        ]);
    }

}
