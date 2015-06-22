<?php

namespace Starkerxp\EcommerceBundle\Services\Query\Marque;

use Starkerxp\EcommerceBundle\Services\Persistence\Lecture\MarqueRepository;
use Starkerxp\CQRSESBundle\Services\Query\QueryHandlerInterface;
use Starkerxp\CQRSESBundle\Services\Query\QueryInterface;

class MarqueListerQueryHandler implements QueryHandlerInterface
{

    private $marqueRepository;

    public function __construct(MarqueRepository $marqueRepository)
    {
        $this->marqueRepository = $marqueRepository;
    }

    public function handle(QueryInterface $marqueQuery)
    {
        $resultSets = $this->marqueRepository->lister();
        return $resultSets->getCollection();
    }

}
