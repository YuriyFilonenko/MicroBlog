<?php

namespace App\Service;

use App\Entity\MicroPost;

/**
 * Contract for MicroPost service.
 *
 * @author Yuriy Filonenko <mail@gmail.com>
 */
interface MicroPostServiceInterface
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
     * 
     * @return void
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
     * 
     * @return void
     */
    public function deletePostById(int $id): void;

    /**
     * Gets post by id.
     *
     * @param int $id
     *
     * @return MicroPost
     */
    public function getPostById(int $id): MicroPost;
}
