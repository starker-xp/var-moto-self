<?php

namespace Starkerxp\EcommerceBundle\Services\Command\Produit;

use Rhumsaa\Uuid\Uuid;
use Starkerxp\CQRSESBundle\Services\Command\CommandHandlerInterface;
use Starkerxp\CQRSESBundle\Services\Command\CommandInterface;
use Starkerxp\EcommerceBundle\Services\Domain\Produit\ProduitDomain;
use Starkerxp\EcommerceBundle\Services\Domain\Produit\ProduitImagePOPO;
use Starkerxp\EcommerceBundle\Services\Domain\Produit\ProduitImagesCollection;
use Starkerxp\EcommerceBundle\Services\Persistence\Ecriture\Produit\ProduitRepository;

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
        $produitId = Uuid::uuid4()->toString();

        /// A refactoriser au moment de l'upload.
        $imagesCollection = new ProduitImagesCollection;
        $images = $command->getImages();
        foreach ($images as $key => $image) {
            $imageUuid = Uuid::uuid4()->toString();
            $imagePOPO = new ProduitImagePOPO($imageUuid, $produitId, $image, ($key == 0 ? 1 : 0));
            $imagesCollection->ajouter($imagePOPO);
        }
        /// Fin à refactoriser au moment de l'upload.

        $nouveauProduit = ProduitDomain::cree($produitId, $command->getMarqueId(), $command->getLibelle(), $command->getDescription(), $command->getPrix(), $command->getQuantite(), $imagesCollection->getCollection());
        $this->produitRepository->ajouter($nouveauProduit);
    }

}
