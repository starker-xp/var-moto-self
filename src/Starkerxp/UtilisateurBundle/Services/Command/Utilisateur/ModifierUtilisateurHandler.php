<?php

namespace Starkerxp\UtilisateurBundle\Services\Command\Utilisateur;

use Starkerxp\UtilisateurBundle\Services\Persistence\Ecriture\Utilisateur\UtilisateurRepository;
use Starkerxp\CQRSESBundle\Services\Command\CommandHandlerInterface;
use Starkerxp\CQRSESBundle\Services\Command\CommandInterface;

class ModifierUtilisateurHandler implements CommandHandlerInterface
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
     * Permet de déclencher la commande de modification du libelle.
     *
     * @param CommandInterface $command
     */
    public function handle(CommandInterface $command)
    {
        $utilisateur = $this->utilisateurRepository->get($command->getUtilisateurId());
        $utilisateur->modifierLUtilisateur($command);
        $this->utilisateurRepository->ajouter($utilisateur);
    }

}
