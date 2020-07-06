<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use  App\Repository\NoteRepository as NR;

class NoteController extends AbstractController
{
    /**
     * @Route("/note", name="note")
     */
    public function index()
    {
        return $this->render('note/index.html.twig', [
            'controller_name' => 'NoteController',
        ]);
    }



    /**
     * @Route("/note/lister", name="note_lister")
     */
    public function lister(NR $NR)
    {
        $listeNR = $NR->findAll();
        //dd($listeNR);
        return $this->render('note/lister.html.twig', [
            'listes' => $listeNR ,
        ]);
    }


}
