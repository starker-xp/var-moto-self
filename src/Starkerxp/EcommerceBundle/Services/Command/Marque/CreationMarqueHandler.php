<?php

namespace Starkerxp\EcommerceBundle\Services\Command\Marque;

use Starkerxp\EcommerceBundle\Services\Domain\Marque\MarqueDomain;
use Starkerxp\EcommerceBundle\Services\Persistence\Marque\Write\MarqueRepository;
use Starkerxp\CQRSESBundle\Services\Command\CommandHandlerInterface;
use Starkerxp\CQRSESBundle\Services\Command\CommandInterface;
use Rhumsaa\Uuid\Uuid;

class CreationMarqueHandler implements CommandHandlerInterface
{

    /**
     * @var MarqueRepository
     */
    private $marqueRepository;

    public function __construct(MarqueRepository $marqueRepository)
    {
        $this->marqueRepository = $marqueRepository;
    }

    public function handle(CommandInterface $command)
    {
        $uuid = Uuid::uuid4()->toString();
        $nouvelleMarque = MarqueDomain::cree($uuid, $command->getLibelle());
        $this->marqueRepository->ajouter($nouvelleMarque);
        // Déclenchement des listeners  pour le traitement post création;
    }

}
