<?php

namespace App\Controller;

use App\Entity\Membre;
use App\Form\InscriptionType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use  App\Repository\MembreRepository;
use App\Form\MembreType;

use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;

class MembreController extends AbstractController
{
    /**
     * @Route("/membre", name="membre")
     */
    public function index()
    {
        return $this->render('membre/index.html.twig', [
            'controller_name' => 'MembreController',
        ]);
    }


    /**
     * @Route("/membre/lister", name="membre_lister")
     */
    public function lister(MembreRepository $MR)
    {
        $listerMembre = $MR->findAll();

        //dd($listerMembre);

        return $this->render('membre/lister.html.twig', ['listes' => $listerMembre]);
    }


    /**
     * @Route("/membre/add", name="membre_aff", methods="GET")
     */
    public function afficher()
    {
       $form = $this->createForm(MembreType::class);

            //dd($form);

        return $this->render('membre/form.html.twig', ['form' => $form->createView()]);
    }


    /**
     * @Route("/membre/add", name="membre_add", methods="POST")
     */
    public function add(Request $request, EntityManagerInterface $em )
    {
        $membre = (new Membre)
                                ->setPseudo($request->request->get("membre")["pseudo"])
                                ->setPassword($request->request->get("membre")["password"])
                                ->setNom($request->request->get("membre")["nom"])
                                ->setPrenom($request->request->get("membre")["prenom"])
                                ->setTelephone($request->request->get("membre")["telephone"])
                                ->setEmail($request->request->get("membre")["email"])
                                ->setCivilite($request->request->get("membre")["civilite"])
                                ->setRoles([$request->request->get("membre")["roles"]] ?? ["ROLE_USER"])
                                ->setDateEnregistrement(new \DateTime('now'));


            //dd($membre);
            $em->persist($membre);
            $em->flush();

            $this->addflash('success', 'le nouveau membre a bien été enregistrer !');
            return $this->redirectToroute("membre_lister");
        }

 }