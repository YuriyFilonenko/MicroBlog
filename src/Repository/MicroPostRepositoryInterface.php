<?php

namespace App\Repository;

use App\Entity\MicroPost;

/**
 * Contract for MicroPostRepository.
 *
 * @author Yuriy Filonenko <mail@gmail.com>
 */
interface MicroPostRepositoryInterface
{
    /**
     * Gets list of posts.
     *
     * @return iterable
     */
    public function getListOfPosts(): iterable;

    /**
     * Add given post.
     *
     * @param MicroPost $microPost
     */
    public function addPost(MicroPost $microPost): void;

    /**
     * Gets posts by username.
     *
     * @param string $username
     *
     * @return iterable
     */
    public function getUserPosts(string $username): iterable;

    /**
     * Delete post by id.
     *
     * @param int $id
     */
    public function deletePostById(int $id): void;

    /**
     * Gets post by id.
     *
     * @param int $id
     */
    public function getPostById(int $id): ?MicroPost;
}
