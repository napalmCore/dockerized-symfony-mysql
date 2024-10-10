<?php
// src/Controller/LuckyController.php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
//use user repository
use App\Repository\UserRepository;

class UsersController extends AbstractController
{
    private UserRepository $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * @Route("/users/Get/{id}")
     */
    public function Get(int $id): Response
    {
        $number = random_int(0, 100);

        //get user by id
        $user = $this->userRepository->findById($id);

        return $this->render('page.html.twig', [
            'title' => 'My Page',
            'heading' => 'Welcome to My Page',
            'content' => 'This is the content of my page.'
        ]);
    }
}