<?php

namespace Starkerxp\EcommerceBundle\Services\Query\Marque;

use Starkerxp\EcommerceBundle\Services\Persistence\Marque\Read\MarqueRepository;
use Starkerxp\CQRSESBundle\Services\Query\QueryHandlerInterface;
use Starkerxp\CQRSESBundle\Services\Query\QueryInterface;

class MarqueQueryHandler implements QueryHandlerInterface
{

    private $marqueRepository;

    public function __construct(MarqueRepository $marqueRepository)
    {
        $this->marqueRepository = $marqueRepository;
    }

    public function handle(QueryInterface $marqueQuery)
    {
        $row = $this->marqueRepository->get($marqueQuery->getId());
        return $row;
    }

}
