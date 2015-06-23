<?php

namespace Starkerxp\EcommerceBundle\Services\Command\Produit;

use Starkerxp\EcommerceBundle\Services\Persistence\Ecriture\Produit\ProduitRepository;
use Starkerxp\CQRSESBundle\Services\Command\CommandHandlerInterface;
use Starkerxp\CQRSESBundle\Services\Command\CommandInterface;

class ModifierProduitHandler implements CommandHandlerInterface
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
        $produit = $this->produitRepository->get($command->getProduitId());
        $produit->modifierLeProduit($command);
        $this->produitRepository->ajouter($produit);
    }

}
