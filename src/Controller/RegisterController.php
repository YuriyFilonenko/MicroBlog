<?php

namespace App\Controller;

use App\Dto\UserDto;
use App\Dto\UserDtoToUser;
use App\Form\UserType;
use App\Service\Event\DispatcherInterface;
use App\Service\PasswordEncoder\PasswordEncoderInterface;
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
    private $password;
    private $service;
    private $event;
    private $newUser;

    public function __construct(
        PasswordEncoderInterface $password,
        RegisterServiceInterface $service,
        DispatcherInterface $event,
        UserDtoToUser $newUser
    ) {
        $this->password = $password;
        $this->service = $service;
        $this->event = $event;
        $this->newUser = $newUser;
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
            $userDto->setPassword($this->password->encode($userDto));
            $user = $this->newUser->createUser($userDto);
            $this->service->registerUser($user);
            $this->event->registerEvent($user);

            return $this->redirectToRoute('micro_post_index');
        }

        return $this->render('register/register.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
