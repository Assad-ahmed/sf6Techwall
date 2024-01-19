<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TabController extends AbstractController
{
    #[Route('/tab/{nbr<\d+>?5}', name: 'app_tab')]
    public function index($nbr): Response
    {
        $notes = [];
        for ($i=0; $i< $nbr; $i++)
        {
            $notes[] = rand(0, 20);
        }
        return $this->render('tab/index.html.twig', [
            'notes' => $notes,
        ]);
    }

    #[Route('/tab/users', name: 'app_users')]
    public function users(): Response
    {
        $users = [
            [
            'firstname' => 'Assad',
            'name' => 'Ahmed',
            'age' => 28
        ],
            [
                'firstname' => 'dada',
                'name' => 'hadji',
                'age' => 24
            ],
            [
                'firstname' => 'Nassur',
                'name' => 'Ahamada',
                'age' => 24
            ],
            [
                'firstname' => 'bilal',
                'name' => 'Ahmed',
                'age' => 14
            ]
            ];
        return $this->render('tab/users.html.twig', [
            'users' => $users,
        ]);
    }
}
