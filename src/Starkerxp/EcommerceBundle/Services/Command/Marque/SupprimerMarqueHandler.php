<?php

namespace Starkerxp\EcommerceBundle\Services\Command\Marque;

use Starkerxp\EcommerceBundle\Services\Persistence\Ecriture\Marque\MarqueRepository;
use Starkerxp\CQRSESBundle\Services\Command\CommandHandlerInterface;
use Starkerxp\CQRSESBundle\Services\Command\CommandInterface;

class SupprimerMarqueHandler implements CommandHandlerInterface
{

    /**
     * @var MarqueRepository
     */
    private $marqueRepository;

    public function __construct(MarqueRepository $marqueRepository)
    {
        $this->marqueRepository = $marqueRepository;
    }

    /**
     * Permet de déclencher la commande de suppression d'une marque.
     * 
     * @param CommandInterface $command
     */
    public function handle(CommandInterface $command)
    {
        $marque = $this->marqueRepository->get($command->getMarqueId());
        // Vérifier que la marque existe bien.
        $marque->supprimerUneMarque();
        $this->marqueRepository->ajouter($marque);
    }

}
