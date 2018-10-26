<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\RouterInterface;

/**
 * Implements index, add and show posts logic
 *
 * @author Yuriy Filonenko <mail@gmail.com>
 */
class BlogController extends AbstractController
{
    private $session;
    private $router;

    public function __construct(
        SessionInterface $session,
        RouterInterface $router
    ) {
        $this->session = $session;
        $this->router = $router;
    }

    /**
     * @Route("/", name="blog_index")
     *
     * @return Response
     */
    public function index(): Response
    {
        return $this->render(
            'blog/index.html.twig',
            [
                'posts' => $this->session->get('posts'),
            ]
        );
    }

    /**
     * @Route("/add", name="blog_add")
     *
     * @return RedirectResponse
     */
    public function Add()
    {
        $posts = $this->session->get('posts');
        $posts[\uniqid()] = [
            'title' => 'Random title ' . \mt_rand(1, 500),
            'text' => 'Random text ' . \mt_rand(1, 500),
        ];
        $this->session->set('posts', $posts);

        return new RedirectResponse($this->router->generate('blog_index'));
    }

    /**
     * @Route("/show/{id}", name="blog_show")
     *
     * @param $id
     *
     * @throws NotFoundHttpException
     *
     * @return Response
     */
    public function show($id): Response
    {
        $posts = $this->session->get('posts');

        if (!$posts || !isset($posts[$id])) {
            throw new NotFoundHttpException('Post not found!');
        }

        return $this->render(
            'blog/post.html.twig',
            [
                'id' => $id,
                'post' => $posts[$id],
            ]
        );
    }
}
