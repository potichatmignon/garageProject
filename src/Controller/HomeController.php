<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(): Response
    {
        return $this->render('base.html.twig');
    }

    #[Route('/about', name: 'app_about')]
    public function about(): Response
    {
        return $this->render('about.html.twig');
    }

    #[Route('/contact', name: 'app_contact')]
    public function contact(): Response
    {
        return $this->render('contact.html.twig');
    }

    #[Route('/connexion', name: 'app_connexion')]
    public function connexion(): Response
    {
        return $this->render('connexion.html.twig');
    }

    #[Route('/login', name: 'app_login', methods: ['GET'])]
    public function login(Request $request): Response
    {
        $username = $request->query->get('username');
        $password = $request->query->get('password');
    
        if (!$username || !$password) {
            return $this->render('connexion.html.twig', [
                'error' => 'Les champs ne peuvent pas être vides'
            ]);
        }
    
        if ($username === 'vparrot' && $password === 'admin') {
            return $this->redirectToRoute('app_admin');
        }
    
        return $this->render('connexion.html.twig', [
            'error' => 'Nom d\'utilisateur ou mot de passe incorrect'
        ]);
    }

    #[Route('/admin', name: 'app_admin')]
    public function admin(): Response
    {
        return $this->render('admin.html.twig');
    }
}