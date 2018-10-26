<?php

namespace App\Controller;

use App\Repository\MicroPostRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

/**
 * Implements index posts logic.
 *
 * @author Yuriy Filonenko <mail@gmail.com>
 *
 * @Route("/micro-blog")
 */
class MicroPostController extends AbstractController
{
    private $microPostRepository;

    public function __construct(MicroPostRepository $microPostRepository)
    {
        $this->microPostRepository = $microPostRepository;
    }

    /**
     * @Route("/", name="micro_post_index")
     */
    public function index(): Response
    {
        return $this->render('micro-post/index.html.twig', [
            'posts' => $this->microPostRepository->findAll(),
        ]);
    }
}
