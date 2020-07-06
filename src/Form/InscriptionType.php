<?php

namespace App\Form;

use App\Entity\Membre;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Validator\Constraints as Contrainte;

class InscriptionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email', EmailType::class, [ "help" => "Tapez votre email",
                    "data" => "",
                    "constraints" => [ 
                                    new Contrainte\NotBlank(["message" => "Vous avez oublié de remplir ce champ"]),
                                    new Contrainte\Length(["min" => 3, "max" => 50,
                                                "minMessage" => "L'email' doit contenir au moins 3 caractères",
                                                "maxMessage" => "L'email' ne doit pas dépasser 50 caractères"])
                                    ]])

            ->add('plainPassword', PasswordType::class, [
                // instead of being set onto the object directly,
                // this is read and encoded in the controller
                'mapped' => false,
                "constraints" => [ 
                    new Contrainte\NotBlank(["message" => "Vous avez oublié de remplir ce champ"]),
                    new Contrainte\Length(["min" => 5, "max" => 40,
                                "minMessage" => "Le mot de passe doit contenir au moins 5 caractères",
                                "maxMessage" => "Le mot de passe ne doit pas dépasser 40 caractères"])
                    ]])

            ->add('pseudo',TextType::class, [ "help" => "Tapez votre pseudo",
            "data" => "",
            "constraints" => [
                             new Contrainte\NotBlank(["message" => "Vous avez oublié de remplir ce champ"]),
                             new Contrainte\Length(["min" => 3, "max" => 20,
                                         "minMessage" => "Le pseudo doit contenir au moins 3 caractères",
                                         "maxMessage" => "Le pseudo ne doit pas dépasser 20 caractères"])
                             ]])

            ->add('nom', TextType::class, [ "help" => "Tapez votre nom",
            "data" => "",
            "constraints" => [ 
                             new Contrainte\NotBlank(["message" => "Vous avez oublié de remplir ce champ"]),
                             new Contrainte\Length(["min" => 1, "max" => 40,
                                         "minMessage" => "",
                                         "maxMessage" => "Le nom ne doit pas dépasser 40 caractères"])
                             ]])
            ->add('prenom', TextType::class, [ "help" => "Tapez votre prénom",
            "data" => "",
            "constraints" => [ 
                             new Contrainte\NotBlank(["message" => "Vous avez oublié de remplir ce champ"]),
                             new Contrainte\Length(["min" => 1, "max" => 40,
                                         "minMessage" => "Le prénom doit contenir au moins 1 caractères",
                                         "maxMessage" => "Le prénom ne doit pas dépasser 40 caractères"])
                             ]])
            ->add('telephone', TextType::class, [ "help" => "Tapez votre numéro de téléphone",
            "data" => "",
            "constraints" => [ 
                             new Contrainte\NotBlank(["message" => "Vous avez oublié de remplir ce champ"]),
                             new Contrainte\Length(["min" => 10, "max" => 10,
                                         "minMessage" => "Le numéro de téléphone doit contenir 10 chiffres",
                                         "maxMessage" => "Le numéro de téléphone doit contenir 10 chiffres"])
                             ]])

            ->add('civilite', ChoiceType::class, [
                'choices' => [
                    'Homme' => 'H',
                    'Femme' => 'F',
                    'Autres' => 'A',
                ]])

            ->add('agreeTerms', CheckboxType::class, [
                'mapped' => false,
                'constraints' => [
                    new IsTrue([
                        'message' => 'You should agree to our terms.',
                    ]),
                ],
            ])

//            ->add('roles')
//            ->add('date_enregistrement')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Membre::class,
        ]);
    }
}
