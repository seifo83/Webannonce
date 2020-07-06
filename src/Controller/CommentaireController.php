<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use  App\Repository\CommentaireRepository as CR;

class CommentaireController extends AbstractController
{
    /**
     * @Route("/commentaire", name="commentaire")
     */
    public function index()
    {
        return $this->render('commentaire/index.html.twig', [
            'controller_name' => 'CommentaireController',
        ]);
    }

    /**
     * @Route("/commentaire/lister", name="commentaire_lister")
     */
    public function lister(CR $CR)
    {
        $listerCR = $CR->findAll();

        //dd($listerCR);

        return $this->render('commentaire/lister.html.twig', [
            'listes' => $listerCR ,
        ]);
    }
}
