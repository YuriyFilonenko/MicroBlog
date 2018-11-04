<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use App\Service\RegisterServiceInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

/**
 * Implement user regystration logic.
 *
 * @author Yuriy Filonenko <mail@gmail.com>
 */
class RegisterController extends AbstractController
{
    private $passwordEncoder;
    private $service;

    public function __construct(
        UserPasswordEncoderInterface $passwordEncoder,
        RegisterServiceInterface $service
    ) {
        $this->passwordEncoder = $passwordEncoder;
        $this->service = $service;
    }

    /**
     * @Route("/register", name="user_register")
     *
     * @param Request $request
     *
     * @return Response
     */
    public function register(Request $request)
    {
        $user = new User();
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $password = $this->passwordEncoder->encodePassword($user, $user->getPlainPassword());
            $user->setPassword($password);
            $this->service->registerUser($user);

            return $this->redirectToRoute('micro_post_index');
        }

        return $this->render('register/register.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
