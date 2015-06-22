<?php

namespace Starkerxp\EcommerceBundle\Services\Command\Produit;

use Starkerxp\CQRSESBundle\Services\Command\CommandHandlerInterface;
use Starkerxp\CQRSESBundle\Services\Command\CommandInterface;
use Starkerxp\EcommerceBundle\Services\Domain\Produit\ProduitDomain;
use Starkerxp\EcommerceBundle\Services\Persistence\Ecriture\Produit\ProduitRepository;
use Rhumsaa\Uuid\Uuid;

class CreerProduitHandler implements CommandHandlerInterface
{

    /**
     * @var ProduitRepository
     */
    private $produitRepository;

    public function __construct(ProduitRepository $produitRepository)
    {
        $this->produitRepository = $produitRepository;
    }

    public function handle(CommandInterface $command)
    {
        $uuid = Uuid::uuid4()->toString();
        $nouvelleProduit = ProduitDomain::cree($uuid, $command->getMarqueId(), $command->getLibelle(), $command->getDescription(), $command->getPrix(), $command->getQuantite());
        $this->produitRepository->ajouter($nouvelleProduit);
        // Déclenchement des listeners  pour le traitement post création;
    }

}
