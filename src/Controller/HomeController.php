<?php

namespace App\Controller;

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;
use App\Repository\UserRepository;
use App\Repository\CarRepository;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Avis;
use App\Repository\AvisRepository;

class HomeController extends AbstractController
{
    private $requestStack;

    public function __construct(RequestStack $requestStack)
    {
        $this->requestStack = $requestStack;
    }

    #[Route('/', name: 'app_home')]
    public function index(AvisRepository $avisRepository): Response
    {
        $avis = $avisRepository->findBy(['valid' => true]);

        $session = $this->requestStack->getSession();
        $userRole = $session->get('user_role', 'Connexion');
        return $this->render('base.html.twig', [
            'avis' => $avis,
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
        } else {
            return $this->render('connexion.html.twig', [
                'user_role' => $userRole
            ]);
        }
    }

    #[Route('/deconnexion', name: 'app_deconnexion')]
    public function deconnexion(): Response
    {
        $session = $this->requestStack->getSession();
        $session->remove('user_role');
        return $this->redirectToRoute('app_connexion');
    }

    #[Route('/info', name: 'app_info')]
    public function car(CarRepository $carRepository): Response
    {
        $session = $this->requestStack->getSession();
        $userRole = $session->get('user_role', 'Connexion');
        $cars = $carRepository->findAll();
        return $this->render('info.html.twig', [
            'cars' => $cars,
            'user_role' => $userRole
        ]);
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
            } else {
                $session->set('user_role', 'Employé');
                return $this->redirectToRoute('app_employe');
            }
        }

        return $this->render('connexion.html.twig', [
            'error' => 'Nom d\'utilisateur ou mot de passe incorrect'
        ]);
    }

    #[Route('/admin', name: 'app_admin')]
    public function admin(UserRepository $userRepository): Response
    {
        $session = $this->requestStack->getSession();
        $userRole = $session->get('user_role', 'Connexion');
        $users = $userRepository->findAll();
        return $this->render('admin.html.twig', [
            'user_role' => $userRole,
            'users' => $users
        ]);
    }

    #[Route('/add', name: 'app_addUsers', methods: ['GET'])]
    public function addUsers( UserRepository $userRepository, EntityManagerInterface $entityManager,Request $request): Response
    {
        $username = $request->query->get('email');
        $password = $request->query->get('password');
        $role = $request->query->get('role');

        if (!$username || !$password || !$role) {
            return $this->render('admin.html.twig', [
                'error' => 'Les champs ne peuvent pas être vides'
            ]);
        }   

        else{

            if ($username && $password && $role) {
                $user = new User();
                $user->setEmail($username);
                $user->setPassword(password_hash($password, PASSWORD_BCRYPT));
                $user->setRole($role);
    
                $entityManager->persist($user);
                $entityManager->flush();
            }

            return $this->redirectToRoute('app_admin');
        }

        return $this->render('admin.html.twig');
    }

    #[Route('/delete_user/{id}', name: 'app_delete_user')]
    public function deleteUser(int $id, UserRepository $userRepository, EntityManagerInterface $entityManager): Response
    {
        $user = $userRepository->find($id);

        if ($user) {
            $entityManager->remove($user);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_admin');
    }

    #[Route('/employe', name: 'app_employe')]
    public function employe(AvisRepository $avisRepository, UserRepository $userRepository): Response
    {
        $session = $this->requestStack->getSession();
        $userRole = $session->get('user_role', 'Connexion');
        $users = $userRepository->findAll();
        $avisNonValides = $avisRepository->findBy(['valid' => false]);
        return $this->render('employe.html.twig', [
            'user_role' => $userRole,
            'users' => $users,
            'avisNonValides' => $avisNonValides
        ]);
    }

    #[Route('/avis/valider/{id}', name: 'app_valider_avis')]
    public function validerAvis(int $id, AvisRepository $avisRepository, EntityManagerInterface $entityManager): Response
    {
        $avis = $avisRepository->find($id);

        if ($avis) {
            $avis->setValid(true);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_employe');
    }

    #[Route('/avis/supprimer/{id}', name: 'app_supprimer_avis')]
    public function supprimerAvis(int $id, AvisRepository $avisRepository, EntityManagerInterface $entityManager): Response
    {
        $avis = $avisRepository->find($id);

        if ($avis) {
            $entityManager->remove($avis);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_employe');
    }

    #[Route('/avis', name: 'app_avis', methods: ['POST'])]
    public function avis(Request $request, EntityManagerInterface $entityManager): Response
    {
        $name = $request->request->get('name');
        $email = $request->request->get('email');
        $message = $request->request->get('message');
        $rating = $request->request->get('rating');

        if (!$name || !$email || !$message || !$rating) {
            return $this->redirectToRoute('app_home', [
                'error' => 'Tous les champs sont obligatoires'
            ]);
        }

        $avis = new Avis();
        $avis->setName($name);
        $avis->setEmail($email);
        $avis->setMessage($message);
        $avis->setRating((int)$rating);
        $avis->setValid(false); 

        $entityManager->persist($avis);
        $entityManager->flush();

        $session = $this->requestStack->getSession();
        $userRole = $session->get('user_role', 'Connexion');

        return $this->redirectToRoute('app_home', [
            'user_role' => $userRole
        ]);
    }
    
}

