<?php

namespace Starkerxp\UtilisateurBundle\Services\Command\Utilisateur;

use Starkerxp\UtilisateurBundle\Services\Domain\Utilisateur\UtilisateurDomain;
use Starkerxp\UtilisateurBundle\Services\Persistence\Ecriture\Utilisateur\UtilisateurRepository;
use Starkerxp\CQRSESBundle\Services\Command\CommandHandlerInterface;
use Starkerxp\CQRSESBundle\Services\Command\CommandInterface;
use Rhumsaa\Uuid\Uuid;

class CreerUtilisateurHandler implements CommandHandlerInterface
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
        $uuid = Uuid::uuid4()->toString();
        $nouvelleUtilisateur = UtilisateurDomain::cree($uuid, $command->getRole(), $command->getEmail(), $command->getNom(), $command->getPrenom(), $command->getMotDePasse());
        $this->utilisateurRepository->ajouter($nouvelleUtilisateur);
    }

}
