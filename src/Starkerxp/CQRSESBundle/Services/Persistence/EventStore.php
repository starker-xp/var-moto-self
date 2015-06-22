<?php

namespace Starkerxp\CQRSESBundle\Services\Persistence;

class EventStore
{

    /**
     * @var \PDO
     */
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    /**
     * On insère le nouvel évènements dans son espace de stockage.
     *
     * @param type $events
     */
    public function commit($events)
    {
        $stmt = $this->pdo->prepare(
                'INSERT INTO events (aggregate_id, `type`, created_at, `data`)
             VALUES (:aggregate_id, :type, :created_at, :data)'
        );
        foreach ($events as $event) {
            $stmt->execute([
                ':aggregate_id' => (string) $event->getAggregateId(),
                ':type' => get_class($event),
                ':created_at' => date('Y-m-d H:i:s'),
                ':data' => base64_encode(serialize($event))
            ]);
        }
    }

    /**
     * Récupère l'ensemble des évènements d'un objet, afin de le reconstruire.
     *
     * @param type $id
     *
     * @return \Starkerxp\CQRSESBundle\Services\Persistence\AggregateHistory
     */
    public function getHistoriqueAggregat($id)
    {
        $sql = "SELECT * FROM events WHERE aggregate_id = :aggregate_id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue("aggregate_id", (string) $id);
        $stmt->execute();
        $events = [];
        while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
            $events[] = unserialize(base64_decode($row['data']));
        }
        $stmt->closeCursor();
        return new AggregateHistorique($id, $events);
    }

}
