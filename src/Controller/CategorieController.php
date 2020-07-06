<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\CategorieRepository;
use App\Form\CategorieType;


use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;

use App\Entity\Categorie;


class CategorieController extends AbstractController
{
    /**
     * @Route("/categorie", name="categorie")
     */
    public function index()
    {
        return $this->render('categorie/index.html.twig', [
            'controller_name' => 'CategorieController',
        ]);
    }

    /* Partie BackOffice */

    /* 1-  Lister tous les catégorie  */


    /**
     * @Route("/categorie/lister", name="categorie_lister")
     */
    public function liste(CategorieRepository $cat)
    {
        $listecat = $cat->findAll();

        //dd($listecat);

        return $this->render('categorie/lister.html.twig', [
            'listecat' => $listecat,
        ]);
    }

    /* afficher le formulaire d'une catégorie par Admin */

    /**
     * @Route("/categorie/add", name="categorie_afficher", methods="GET")
     */
    public function affiche()
    {
        $form = $this->createForm(CategorieType::class);

        $view = $form->createView();

            //dd($form , $view);

        return $this->render('categorie/form.html.twig', [
            'form' => $form->createView(),
        ]);
    }


     /* ajouter une catégorie par Admin */

    /**
     * @Route("/categorie/add", name="categorie_ajouter", methods="POST")
     */
    public function add(EntityManagerInterface $em , Request $request)
    {
        $titre = $request->request->get("categorie")["titre"];
        $motscles = $request->request->get("categorie")["motscles"];

        //dd($titre , $motscles);


        $categorie = new Categorie;

        $categorie->setTitre($titre);
        $categorie->setMotscles($motscles);

        $em->persist($categorie);
        $resultat = $em->flush();

        $this->addFlash('success', 'la catégorie a bien été enregistrée !');


        return $this->redirectToroute("categorie_lister");
    }


}
