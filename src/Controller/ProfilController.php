<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ProfilController extends AbstractController
{
    #[Route('/profil', name: 'app_profil')]
    public function index(): Response
    {
        $user = $this->getUser();

        if (!$user){
            return  $this->redirect('../login');
        }

        return $this->render('profil/index.html.twig', [
            'user' => $user,
        ]);
    }
}
