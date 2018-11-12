<?php

namespace App\Controller;

use App\Entity\User;
use App\Event\UserRegisterEvent;
use App\Form\UserType;
use App\Service\Register\RegisterServiceInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
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
    private $eventDispatcher;

    public function __construct(
        UserPasswordEncoderInterface $passwordEncoder,
        RegisterServiceInterface $service,
        EventDispatcherInterface $eventDispatcher
    ) {
        $this->passwordEncoder = $passwordEncoder;
        $this->service = $service;
        $this->eventDispatcher = $eventDispatcher;
    }

    /**
     * @Route("/register", name="user_register")
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $user = new User();
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $password = $this->passwordEncoder->encodePassword(
                $user,
                $user->getPlainPassword()
            );
            $user->setPassword($password);
            $this->service->registerUser($user);

            $userRegisterEvent = new UserRegisterEvent($user);
            $this->eventDispatcher->dispatch(
                UserRegisterEvent::NAME,
                $userRegisterEvent
            );

            return $this->redirectToRoute('micro_post_index');
        }

        return $this->render('register/register.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
