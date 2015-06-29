<?php

namespace Starkerxp\UtilisateurBundle\Services\Command\Utilisateur;

use Starkerxp\UtilisateurBundle\Services\Persistence\Ecriture\Utilisateur\UtilisateurRepository;
use Starkerxp\CQRSESBundle\Services\Command\CommandHandlerInterface;
use Starkerxp\CQRSESBundle\Services\Command\CommandInterface;

class SupprimerUtilisateurHandler implements CommandHandlerInterface
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
     * Permet de déclencher la commande de suppression d'une utilisateur.
     *
     * @param CommandInterface $command
     */
    public function handle(CommandInterface $command)
    {
        $utilisateur = $this->utilisateurRepository->get($command->getUtilisateurId());
        // Vérifier que la utilisateur existe bien.
        //$utilisateur->supprimerUnUtilisateur();
        $this->utilisateurRepository->ajouter($utilisateur);
    }

}
