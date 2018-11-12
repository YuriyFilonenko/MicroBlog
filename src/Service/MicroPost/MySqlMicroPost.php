<?php

namespace App\Service\MicroPost;

use App\Entity\MicroPost;
use App\Repository\MicroPostRepositoryInterface;
use Doctrine\ORM\EntityNotFoundException;

/**
 * MicroPost service that fetch data from database.
 *
 * @author Yuriy Filonenko <mail@gmail.com>
 */
class MySqlMicroPost implements MicroPostServiceInterface
{
    private $microPostRepository;

    public function __construct(MicroPostRepositoryInterface $microPostRepository)
    {
        $this->microPostRepository = $microPostRepository;
    }

    /**
     * {@inheritdoc}
     */
    public function getListOfPosts(): iterable
    {
        return $posts = $this->microPostRepository->getListOfPosts();
    }

    /**
     * {@inheritdoc}
     */
    public function addPost(MicroPost $microPost): void
    {
        $this->microPostRepository->addPost($microPost);
    }

    /**
     * {@inheritdoc}
     */
    public function getUserPosts(string $username): iterable
    {
        $userPosts = $this->microPostRepository->getUserPosts($username);

        if (!$userPosts) {
            throw new EntityNotFoundException('User not found!');
        }

        return $userPosts;
    }

    /**
     * {@inheritdoc}
     */
    public function deletePostById(int $id): void
    {
        $this->microPostRepository->deletePostById($id);
    }

    /**
     * {@inheritdoc}
     */
    public function getPostById(int $id): MicroPost
    {
        $post = $this->microPostRepository->getPostById($id);

        if (!$post) {
            throw new EntityNotFoundException('Post not found!');
        }

        return $post;
    }
}
