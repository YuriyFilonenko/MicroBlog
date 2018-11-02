<?php

namespace App\Controller;

use App\Entity\MicroPost;
use App\Form\MicroPostType;
use App\Repository\MicroPostRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Implements CRUD logic.
 *
 * @author Yuriy Filonenko <mail@gmail.com>
 */
class MicroPostController extends AbstractController
{
    private $microPostRepository;
    private $entityManager;

    public function __construct(
        MicroPostRepository $microPostRepository,
        EntityManagerInterface $entityManager
    ) {
        $this->microPostRepository = $microPostRepository;
        $this->entityManager = $entityManager;
    }

    /**
     * @Route("/", name="micro_post_index")
     *
     * @return Response
     */
    public function index(): Response
    {
        return $this->render('micro-post/index.html.twig', [
            'posts' => $this->microPostRepository->findBy([], ['createdAt' => 'DESC']),
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

        if ($form->isSubmitted() && $form->isValid()) {
            $this->entityManager->persist($microPost);
            $this->entityManager->flush();

            return $this->redirectToRoute('micro_post_index');
        }

        return $this->render('micro-post/add.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/edit/{id}", name="micro_post_edit")
     *
     * @param int     $id      micro_post id
     * @param Request $request
     *
     * @throws NotFoundHttpException
     *
     * @return Response
     */
    public function edit(int $id, Request $request): Response
    {
        $microPost = $this->microPostRepository->find($id);

        if (!$microPost) {
            throw new NotFoundHttpException('Post not found!');
        }

        $this->denyAccessUnlessGranted('edit', $microPost);

        $microPost->setUpdatedAt(new \DateTime());

        $form = $this->createForm(MicroPostType::class, $microPost);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->entityManager->flush();

            return $this->redirectToRoute('micro_post_index');
        }

        return $this->render('micro-post/add.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/delete/{id}", name="micro_post_delete")
     *
     * @param int $id
     *
     * @return Response
     */
    public function delete(int $id): Response
    {
        $microPost = $this->microPostRepository->find($id);

        if (!$microPost) {
            throw new NotFoundHttpException('Post not found!');
        }

        $this->denyAccessUnlessGranted('delete', $microPost);

        $this->entityManager->remove($microPost);
        $this->entityManager->flush();

        return $this->redirectToRoute('micro_post_index');
    }

    /**
     * @Route("/post/{id}", name="micro_post_post")
     *
     * @param type $id micro_post id
     *
     * @throws NotFoundHttpException
     *
     * @return Response
     */
    public function post(int $id): Response
    {
        $post = $this->microPostRepository->find($id);

        if (!$post) {
            throw new NotFoundHttpException('Post not found!');
        }

        return $this->render('micro-post/post.html.twig', [
            'post' => $post,
        ]);
    }
}
