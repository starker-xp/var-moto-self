<?php

namespace Starkerxp\EcommerceBundle\Services\Persistence\Ecriture\Marque;

use Starkerxp\CQRSESBundle\Services\Persistence\AbstractProjection;
use Starkerxp\EcommerceBundle\Services\Domain\Marque\Event\MarqueAEteCree;
use Starkerxp\EcommerceBundle\Services\Domain\Marque\Event\ModificationLibelleMarque;
use Starkerxp\EcommerceBundle\Services\Domain\Marque\Event\UneMarqueAEteSupprime;

class MarqueProjection extends AbstractProjection
{

    public function projectMarqueAEteCree(MarqueAEteCree $event)
    {
        $sql = 'INSERT INTO marques (id, libelle) VALUES (:marque_id, :libelle)';
        $stmt = $this->getPdo()->prepare($sql);
        $stmt->execute([
            ':marque_id' => $event->getAggregateId(),
            ':libelle' => $event->getLibelle(),
        ]);
    }

    public function projectModificationLibelleMarque(ModificationLibelleMarque $event)
    {
        $sql = 'UPDATE marques SET libelle= :libelle WHERE id= :marque_id';
        $stmt = $this->getPdo()->prepare($sql);
        $stmt->execute([
            ':marque_id' => $event->getAggregateId(),
            ':libelle' => $event->getLibelle(),
        ]);
    }

    public function projectUneMarqueAEteSupprime(UneMarqueAEteSupprime $event)
    {
        $sql = 'DELETE FROM marques WHERE id= :marque_id';
        $stmt = $this->getPdo()->prepare($sql);
        $stmt->execute([
            ':marque_id' => $event->getAggregateId()
        ]);
    }

}
