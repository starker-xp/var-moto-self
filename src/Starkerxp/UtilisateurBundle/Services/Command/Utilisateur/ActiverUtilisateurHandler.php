<?php

namespace Starkerxp\UtilisateurBundle\Services\Command\Utilisateur;

use Starkerxp\UtilisateurBundle\Services\Persistence\Ecriture\Utilisateur\UtilisateurRepository;
use Starkerxp\CQRSESBundle\Services\Command\CommandHandlerInterface;
use Starkerxp\CQRSESBundle\Services\Command\CommandInterface;

class ActiverUtilisateurHandler implements CommandHandlerInterface
{

    /**
     * @var UtilisateurRepository
     */
    private $utilisateurRepository;

    public function __construct(UtilisateurRepository $utilisateurRepository)
    {
        $this->utilisateurRepository = $utilisateurRepository;
    }

    /**
     * Déclenche la commande afin de créer une nouvelle utilisateur.
     *
     * @param CommandInterface $command
     *
     * @return void
     */
    public function handle(CommandInterface $command)
    {
        $utilisateur = $this->utilisateurRepository->get($command->getUtilisateurId());
        $utilisateur->activerCompteUtilisateur();
        $this->utilisateurRepository->ajouter($utilisateur);
    }

}
