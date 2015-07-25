<?php

namespace Starkerxp\DocumentBundle\Upload;

use Symfony\Component\DependencyInjection\ContainerInterface;

class UploadService
{

    private $repertoire;
    protected $container;

    public function __construct(ContainerInterface $container, $repertoire)
    {
        $this->container = $container;
        $this->repertoire = $repertoire;
    }

    public function getRepertoireWeb()
    {
        return realpath("./") . "/";
    }

    public function upload()
    {
        $request = $this->container->get('request');
        $listeFichiers = [];
        foreach ($request->files as $form) {
            $listeFichiers = array_merge($listeFichiers, $this->getListeFichiersPourUnFormulaire($form));
        }
        $listeUrls = [];
        foreach ($listeFichiers as $fichier) {
            $nouveauNom = uniqid() . "." . $fichier->getClientOriginalExtension();
            $fichier->move($this->getRepertoireWeb() . $this->repertoire, $nouveauNom);
            $listeUrls[] = $this->repertoire . '/' . $nouveauNom;
        }
        return $listeUrls;
    }

    private function getListeFichiersPourUnFormulaire($form)
    {
        $listeFichiers = [];
        foreach ($form as $key => $fichiers) {
            if (!is_array($fichiers)) {
                $listeFichiers[$key] = $fichiers;
                continue;
            }
            foreach ($fichiers as $key2 => $fichier) {
                $listeFichiers[$key2] = $fichier;
            }
        }

        return $listeFichiers;
    }

}
