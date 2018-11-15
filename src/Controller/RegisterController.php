<?php

namespace App\Controller;

use App\Dto\UserDto;
use App\Form\UserType;
use App\Service\Register\RegisterServiceInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Implement user regystration logic.
 *
 * @author Yuriy Filonenko <mail@gmail.com>
 */
class RegisterController extends AbstractController
{
    private $service;

    public function __construct(RegisterServiceInterface $service)
    {
        $this->service = $service;
    }

    /**
     * @Route("/register", name="user_register")
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request): Response
    {
        $userDto = new UserDto();
        $form = $this->createForm(UserType::class, $userDto);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->service->registerUser($userDto);

            return $this->redirectToRoute('micro_post_index');
        }

        return $this->render('register/register.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
