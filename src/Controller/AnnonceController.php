<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use  App\Repository\AnnonceRepository;
use  App\Repository\CategorieRepository;


class AnnonceController extends AbstractController
{
    /**
     * @Route("/annonce", name="annonce")
     */
    public function index()
    {
        return $this->render('annonce/index.html.twig', [
            'controller_name' => 'AnnonceController',
        ]);
    }


    /**
     * @Route("/annonce/lister", name="annonce_lister")
     */
    public function lister(AnnonceRepository $AR, CategorieRepository $CR)
    {
        $listannonce = $AR->findAll();
        $listCategorie = $CR->findAll();

        //dd($listannonce, $listCategorie);

        return $this->render('annonce/liste.html.twig', ["listes" => $listannonce,
                                                           "listcat" => $listCategorie]);

    }


     /**
     * @Route("annonce/add", name="annonce_ajouter")
     */
    public function add(AnnonceRepository $AR)
    {

        $add = $AR->findAll();
        return $this->render("annonce/ajouter.html.twig"  , [ "add" => $add ]);
    }




}
