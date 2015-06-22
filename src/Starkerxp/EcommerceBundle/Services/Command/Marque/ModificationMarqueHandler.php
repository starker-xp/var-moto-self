<?php

namespace Starkerxp\EcommerceBundle\Services\Command\Marque;

use Starkerxp\EcommerceBundle\Services\Persistence\Ecriture\Marque\MarqueRepository;
use Starkerxp\CQRSESBundle\Services\Command\CommandHandlerInterface;
use Starkerxp\CQRSESBundle\Services\Command\CommandInterface;

class ModificationMarqueHandler implements CommandHandlerInterface
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
        $marque = $this->marqueRepository->get($command->getMarqueId());
        $marque->modifierLibelle($command->getLibelle());
        $this->marqueRepository->ajouter($marque);
    }

}
