<?php

namespace App\Controller;

use App\Entity\MicroPost;
use App\Form\MicroPostType;
use App\Service\MicroPostServiceInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Implements CRUD logic.
 *
 * @author Yuriy Filonenko <mail@gmail.com>
 */
class MicroPostController extends AbstractController
{
    private $service;

    public function __construct(MicroPostServiceInterface $service)
    {
        $this->service = $service;
    }

    /**
     * @Route("/", name="micro_post_index")
     *
     * @return Response
     */
    public function index(): Response
    {
        return $this->render('micro-post/index.html.twig', [
            'posts' => $this->service->getListOfPosts(),
        ]);
    }

    /**
     * @Route("/add", name="micro_post_add")
     *
     * @param Request $request
     *
     * @return Response
     */
    public function add(Request $request): Response
    {
        $microPost = new MicroPost();
        $microPost->setCreatedAt(new \DateTime());
        $microPost->setUpdatedAt(new \DateTime());
        $microPost->setUser($this->getUser());

        $form = $this->createForm(MicroPostType::class, $microPost);
        $form->handleRequest($request);

        $this->denyAccessUnlessGranted('add', $microPost);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->service->addPost($microPost);

            return $this->redirectToRoute('micro_post_index');
        }

        return $this->render('micro-post/add.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/user/{username}", name="micro_post_user")
     *
     * @param string $username posts author username
     *
     * @return Response
     */
    public function userPosts(string $username): Response
    {
        return $this->render('micro-post/index.html.twig', [
            'posts' => $this->service->getUserPosts($username),
        ]);
    }

    /**
     * @Route("/edit/{id}", name="micro_post_edit")
     *
     * @param int     $id      micro-post id
     * @param Request $request
     *
     * @return Response
     */
    public function edit(int $id, Request $request): Response
    {
        $microPost = $this->service->getPostById($id);

        $this->denyAccessUnlessGranted('edit', $microPost);

        $microPost->setUpdatedAt(new \DateTime());

        $form = $this->createForm(MicroPostType::class, $microPost);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->service->addPost($microPost);

            return $this->redirectToRoute('micro_post_index');
        }

        return $this->render('micro-post/add.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/delete/{id}", name="micro_post_delete")
     *
     * @param int $id micro-post id
     *
     * @return Response
     */
    public function delete(int $id): Response
    {
        $microPost = $this->service->getPostById($id);

        $this->denyAccessUnlessGranted('delete', $microPost);

        $this->service->deletePostById($id);

        return $this->redirectToRoute('micro_post_index');
    }

    /**
     * @Route("/post/{id}", name="micro_post_post")
     *
     * @param int $id micro-post id
     *
     * @return Response
     */
    public function post(int $id): Response
    {
        return $this->render('micro-post/post.html.twig', [
            'post' => $this->service->getPostById($id),
        ]);
    }
}
