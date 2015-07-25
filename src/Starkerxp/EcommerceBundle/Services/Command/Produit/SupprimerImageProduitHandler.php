<?php

namespace Starkerxp\EcommerceBundle\Services\Command\Produit;

use Starkerxp\CQRSESBundle\Services\Command\CommandHandlerInterface;
use Starkerxp\CQRSESBundle\Services\Command\CommandInterface;
use Starkerxp\DocumentBundle\Upload\UploadService;
use Starkerxp\EcommerceBundle\Services\Persistence\Ecriture\Produit\ProduitRepository;

class SupprimerImageProduitHandler implements CommandHandlerInterface
{

    /**
     * @var ProduitRepository
     */
    private $produitRepository;
    private $uploaderService;

    public function __construct(ProduitRepository $produitRepository, UploadService $uploaderService)
    {
        $this->produitRepository = $produitRepository;
        $this->uploaderService = $uploaderService;
    }

    public function handle(CommandInterface $command)
    {
        $produit = $this->produitRepository->get($command->getProduitId());
        $produit->supprimerUneImageProduit($command, $this->uploaderService->getRepertoireWeb());
        $this->produitRepository->ajouter($produit);
    }

}
