<?php

namespace Starkerxp\UtilisateurBundle\Command;

use Starkerxp\UtilisateurBundle\Services\Command\Utilisateur\ActiverUtilisateurCommand;
use Starkerxp\UtilisateurBundle\Services\Command\Utilisateur\CreerUtilisateurCommand;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class CreerAdministrateurCommand extends ContainerAwareCommand
{

    protected function configure()
    {
        $this->setName('starkerxp:utilisateur:creer_admin')
                ->setDescription("Permet d'ajouter l'utilisateur avec les droits d'administrateur")
                ->addArgument('email', InputArgument::REQUIRED, "Saisissez l'adresse mail du compte :")
                ->addArgument('motDePasse', InputArgument::REQUIRED, "Saisissez le mot de passe :")
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $contenaire = $this->getContainer();
        $commandBus = $contenaire->get('bus.command.utilisateur');

        $email = $input->getArgument('email');
        $motDePasse = $input->getArgument('motDePasse');

        $utilisateurRepository = $contenaire->get("repository.read.utilisateur");
        $utilisateur = $utilisateurRepository->loadUserByUsername($email);

        if ($utilisateur->getId()) {
            $output->writeln("Cette adresse email existe déjà dans la base de données !");
            return false;
        }

        $command = new CreerUtilisateurCommand();
        $command->setEmail($email);
        $command->setNom("Administrateur");
        $command->setPrenom("Administrateur");
        $command->setMotDePasse($motDePasse);
        $command->setRole("ROLE_ADMIN");
        $commandBus->handle($command);

        $utilisateurCree = $utilisateurRepository->loadUserByUsername($email);
        $commandActivation = new ActiverUtilisateurCommand();
        $commandActivation->setUtilisateurId($utilisateurCree->getId());
        $commandBus->handle($commandActivation);

        $output->writeln("L'utilisateur avec l'adresse mail '" . $email . "' a bien été créé !");
    }

}
