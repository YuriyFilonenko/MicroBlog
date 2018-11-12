<?php

namespace App\Repository;

use App\Entity\MicroPost;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method null|MicroPost find($id, $lockMode = null, $lockVersion = null)
 * @method null|MicroPost findOneBy(array $criteria, array $orderBy = null)
 * @method MicroPost[]    findAll()
 * @method MicroPost[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MicroPostRepository extends ServiceEntityRepository implements MicroPostRepositoryInterface
{
    private $userRepository;

    public function __construct(RegistryInterface $registry, UserRepositoryInterface $userRepository)
    {
        parent::__construct($registry, MicroPost::class);
        $this->userRepository = $userRepository;
    }

    /**
     * {@inheritdoc}
     */
    public function getListOfPosts(): iterable
    {
        return $posts = $this->findBy([], ['createdAt' => 'DESC']);
    }

    /**
     * {@inheritdoc}
     */
    public function addPost(MicroPost $microPost): void
    {
        $em = $this->getEntityManager();
        $em->persist($microPost);
        $em->flush();
    }

    /**
     * {@inheritdoc}
     */
    public function getUserPosts(string $username): iterable
    {
        $userWithPosts = $this->userRepository->findUserByUsername($username);

        return $userPosts = $this->findBy(
            ['user' => $userWithPosts],
            ['createdAt' => 'DESC']
        );
    }

    /**
     * {@inheritdoc}
     */
    public function deletePostById(int $id): void
    {
        $post = $this->find($id);

        $em = $this->getEntityManager();
        $em->remove($post);
        $em->flush();
    }

    /**
     * {@inheritdoc}
     */
    public function getPostById(int $id): ?MicroPost
    {
        return $post = $this->find($id);
    }
}
