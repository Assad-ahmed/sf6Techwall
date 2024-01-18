<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FirstController extends AbstractController
{
    #[Route('/first', name: 'app_first')]
    public function index(): Response
    {

        return $this->render('first/index.html.twig', [
            'name' => 'hadjara',
            'firstname' => 'Ahmed'
        ]);
    }

    #[Route('/sayHello/{name}/{firstName}', name: 'say.hello')]
    public function sayHello(Request $request,$name, $firstName): Response
    {
        return $this->render('first/hello.html.twig', ['nom' => $name, 'prenom' => $firstName]);
    }

    #[Route('/multi/{entier1<\d+>}/{entier2<\d+>}', name: 'multiplication' )]
    public function multiplication($entier1, $entier2)
    {
        $resultat = $entier1*$entier2;
        return new Response("<h1>$resultat</h1>");
    }
}
