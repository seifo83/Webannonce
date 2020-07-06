<?php

namespace App\Controller;

use App\Entity\Membre;
use App\Form\InscriptionType;
use App\Security\LoginFormAuthenticator;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Guard\GuardAuthenticatorHandler;

class InscriptionController extends AbstractController
{
    /**
     * @Route("/inscription", name="inscription")
     */
    public function inscrit(Request $request, UserPasswordEncoderInterface $passwordEncoder, GuardAuthenticatorHandler $guardHandler, LoginFormAuthenticator $authenticator): Response
    {
        $user = new Membre();
        $user->setDateEnregistrement(new \DateTime('now'));
        $user->setRoles(["ROLE_USER"]);

        $form = $this->createForm(InscriptionType::class, $user);

       
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            //dd($form);
            // encode the plain password
            $user->setPassword(
                $passwordEncoder->encodePassword(
                    $user,
                    $form->get('plainPassword')->getData()
                )
            );

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);

            $entityManager->flush();

            // do anything else you need here, like send an email
            $this->addFlash("success", "l'inscription a été éffectuer ");
            return $guardHandler->authenticateUserAndHandleSuccess(
                $user,
                $request,
                $authenticator,
                'main' // firewall name in security.yaml
            );
        }

        return $this->render('Membre/inscription.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
