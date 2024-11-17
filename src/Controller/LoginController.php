<?php

namespace App\Controller;

use App\Form\LogInCustomerType;
use App\Repository\CustomerRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormError;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Attribute\Route;

class LoginController extends AbstractController
{
    private UserPasswordHasherInterface $hasher;

    public function __construct(UserPasswordHasherInterface $userPasswordHasherInterface) {
        $this->hasher = $userPasswordHasherInterface;
    }

    #[Route('/login', name: 'login')]
    public function index(CustomerRepository $customerRepository, Request $request): Response
    {
        $form = $this->createForm(LogInCustomerType::class);
        $form->handleRequest($request);
        $session = $request->getSession();

        if ($customerRepository->findOneBy(array('email' => $form->get('email')->getData()))){

            $user = $customerRepository->findOneBy(array('email' => $form->get('email')->getData()));
            $password = $form->get('password')->getData();

            if (!$this->hasher->isPasswordValid($user,  $password)){
                $form->get("password")->addError(new FormError("Mot de passe invalide"));
            } elseif ($this->hasher->isPasswordValid($user,  $password)) {
                $session->set("logAs", $user->getRole());
            }
        } else {
            $form->get("email")->addError(new FormError("Compte utilisateur inexistant"));
        }

        return $this->render('login/index.html.twig', [
            'customers' => $customerRepository,
            'form' => $form,
        ]);
    }
}
