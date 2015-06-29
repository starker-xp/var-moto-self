<?php

namespace Starkerxp\UtilisateurBundle\Services\Query\Utilisateur;

use Starkerxp\UtilisateurBundle\Services\Persistence\Lecture\UtilisateurRepository;
use Starkerxp\CQRSESBundle\Services\Query\QueryHandlerInterface;
use Starkerxp\CQRSESBundle\Services\Query\QueryInterface;

class UtilisateurQueryHandler implements QueryHandlerInterface
{

    private $utilisateurRepository;

    public function __construct(UtilisateurRepository $utilisateurRepository)
    {
        $this->utilisateurRepository = $utilisateurRepository;
    }

    public function handle(QueryInterface $utilisateurQuery)
    {
        $row = $this->utilisateurRepository->get($utilisateurQuery->getId());
        return $row;
    }

}
