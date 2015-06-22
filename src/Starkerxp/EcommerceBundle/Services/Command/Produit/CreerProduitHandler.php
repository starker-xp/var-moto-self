<?php

namespace Starkerxp\EcommerceBundle\Services\Command\Produit;

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
        $nouvelleProduit = ProduitDomain::cree($uuid, $command->getMarque(), $command->getLibelle(), $command->getDescription(), $command->getPrix(), $command->getQuantite());
        $this->produitRepository->ajouter($nouvelleProduit);
        // Déclenchement des listeners  pour le traitement post création;
    }

}
