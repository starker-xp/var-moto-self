<?php

namespace Starkerxp\CQRSESBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class GenererBaseCQRSCommand extends ContainerAwareCommand
{

    protected function configure()
    {
        $this->setName('starkerxp:cqrs:generer:structure')
                ->addArgument('bundle', InputArgument::REQUIRED, "Le bundle dans lequel générer la structure")
                ->addArgument('domain', InputArgument::REQUIRED, "Le domain à générer")
                ->setDescription('Genere le code de base pour commencer a utiliser la syntaxe CQRS')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $nomBundle = $input->getArgument('bundle');
        $nomDomain = ucfirst($input->getArgument('domain'));

// On recupere les infos sur le bundle nécessaire à la génération du controller
        $kernel = $this->getContainer()->get('kernel');
        $bundle = $kernel->getBundle($nomBundle);
        $namespace = $bundle->getNamespace();
        $namespaceFQC = str_replace("\\", "\\\\", $namespace);
        $path = $bundle->getPath();
        // On interdit un namespace en particulier.
        if ($namespace == "Starkerxp\CQRSESBundle") {
            $output->writeln("Impossible d'utiliser ce namespace. Créer un nouveau bundle.");
            exit;
        }
        $repertoireGenere = $this->genererRepertoires($nomDomain, $path);
        if (!$repertoireGenere) {
            $output->writeln("Impossible d'utiliser ce domaine. Il est déjà utilisé dans ce bundle.");
            exit;
        }
        exit;
        $this->genererFichiers($nomDomain, $path, $namespace, $namespaceFQC);
    }

    public function genererRepertoires($nomDomain, $path)
    {
        $repertoiresStructures = [
            'Ressources/config/',
            'Services/Command/_nomDomaine_/',
            'Services/Domain/_nomDomaine_/Event/',
            'Services/Persistence/Lecture/',
            'Services/Persistence/Ecriture/_nomDomaine_/',
            'Services/Query/_nomDomaine_/',
        ];
        // On génère la liste des répertoires qui seront utilisés.
        foreach ($repertoiresStructures as $repertoire) {
            // On sauvegarde pour la génrétation des fichiers.
            $repertoireRenomme = str_replace("_nomDomaine_", $nomDomain, $repertoire);
            // On génère les dossiers nécessaires.
            $target = $path . '/' . $repertoireRenomme;
            if (is_dir($target) && preg_match("_nomDomaine_", $repertoire)) {
                return false;
            }
            if (!is_dir($target)) {
                mkdir($target, 0777, true);
            }
        }
        return true;
    }

    public function genererFichiers($nomDomain, $path, $namespace, $namespaceFQC)
    {
        $fichiersStructures = [
            'Ressources/config/' => [
                "services._lnomDomaine_.yml"
            ],
            'Services/Command/_nomDomaine_/' => [
                'Creer_nomDomaine_Command.php',
                'Creer_nomDomaine_Handler.php',
                'Modifier_nomDomaine_Command.php',
                'Modifier_nomDomaine_Handler.php',
                'Supprimer_nomDomaine_Command.php',
                'Supprimer_nomDomaine_Handler.php',
            ],
            'Services/Domain/_nomDomaine_/' => [
                '_nomDomaine_Collection.php',
                '_nomDomaine_DTO.php',
                '_nomDomaine_POPO.php',
                '_nomDomaine_Domain.php',
                'Event/_nomDomaine_AEteCree.php',
                'Event/_nomDomaine_AEteModifie.php',
                'Event/_nomDomaine_AEteSupprime.php',
            ],
            'Services/Persistence/Ecriture/_nomDomaine_/' => [
                '_nomDomaine_Projection.php',
                '_nomDomaine_Repository.php',
            ],
            'Services/Persistence/Lecture/' => [
                '_nomDomaine_Repository.php',
            ],
            'Services/Query/_nomDomaine_/' => [
                '_nomDomaine_ListerQuery.php',
                '_nomDomaine_ListerQueryHandler.php',
                '_nomDomaine_Query.php',
                '_nomDomaine_QueryHandler.php',
            ],
        ];
        // On récupère le moteur de template twig
        $twig = $this->getContainer()->get('templating');

        foreach ($fichiersStructures as $repertoire => $fichiers) {
            $repertoireRenomme = str_replace("_nomDomaine_", $nomDomain, $repertoire);
            foreach ($fichiers as $fichier) {
                $fichierRenomme = str_replace(["_nomDomaine_", "_lnomDomaine_"], [$nomDomain, lcfirst($nomDomain)], $fichier);
                $repertoireDestination = $path . "/" . $repertoireRenomme . $fichierRenomme;
                $renderCode = $twig->render("StarkerxpCQRSESBundle:$repertoire:$fichier.twig", [
                    'nomDeDomaine' => $nomDomain,
                    'nomDeDomaineMinuscule' => lcfirst($nomDomain),
                    'namespace' => $namespace,
                    'namespaceFQC' => $namespaceFQC,
                ]);
                file_put_contents($repertoireDestination, $renderCode);
            }
        }
    }

}
