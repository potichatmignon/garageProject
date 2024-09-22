<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;
use App\Repository\UserRepository;

class HomeController extends AbstractController
{
    private $requestStack;

    public function __construct(RequestStack $requestStack)
    {
        $this->requestStack = $requestStack;
    }

    #[Route('/', name: 'app_home')]
    public function index(): Response
    {
        $session = $this->requestStack->getSession();
        $userRole = $session->get('user_role', 'Connexion');
        return $this->render('base.html.twig', [
            'user_role' => $userRole
        ]);
    }

    #[Route('/about', name: 'app_about')]
    public function about(): Response
    {
        $session = $this->requestStack->getSession();
        $userRole = $session->get('user_role', 'Connexion');
        return $this->render('about.html.twig', [
            'user_role' => $userRole
        ]);
    }

    #[Route('/contact', name: 'app_contact')]
    public function contact(): Response
    {
        $session = $this->requestStack->getSession();
        $userRole = $session->get('user_role', 'Connexion');
        return $this->render('contact.html.twig', [
            'user_role' => $userRole
        ]);
    }

    #[Route('/connexion', name: 'app_connexion')]
    public function connexion(): Response
    {

        $session = $this->requestStack->getSession();
        $userRole = $session->get('user_role', 'Connexion');
        if ($userRole === 'Admin') {
            return $this->redirectToRoute('app_admin');
        }
        else {return $this->render('connexion.html.twig', [
            'user_role' => $userRole
        ]);}
        
    }

    #[Route('/deconnexion', name: 'app_deconnexion')]
    public function deconnexion(): Response
    {

        $session = $this->requestStack->getSession();
        $session->remove('user_role');
        return $this->redirectToRoute('app_home');
        
    }


    
    #[Route('/login', name: 'app_login', methods: ['GET'])]
    public function login(Request $request, UserRepository $userRepository): Response
    {

        $username = $request->query->get('username');
        $password = $request->query->get('password');

        if (!$username || !$password) {
            return $this->render('connexion.html.twig', [
                'error' => 'Les champs ne peuvent pas être vides'
            ]);
        }

        $user = $userRepository->findOneBy(['email' => $username]);

        if ($user && $user->verifyPassword($password)) {
            $session = $this->requestStack->getSession();
            if ($user->getRole() === 'admin') {
                $session->set('user_role', 'Admin');
                return $this->redirectToRoute('app_admin');
            }
            else {
                $session->set('user_role', 'Employé');
                return $this->redirectToRoute('app_home');
            }
        }

        return $this->render('connexion.html.twig', [
            'error' => 'Nom d\'utilisateur ou mot de passe incorrect'
        ]);
    }

    #[Route('/admin', name: 'app_admin')]
    public function admin(): Response
    {
        $session = $this->requestStack->getSession();
        $userRole = $session->get('user_role', 'Connexion');
        return $this->render('admin.html.twig', [
            'user_role' => $userRole
        ]);
    }
}