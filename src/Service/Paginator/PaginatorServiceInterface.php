<?php

namespace App\Service\Paginator;

/**
 * Contract for Paginator service.
 *
 * @author Yuriy Filonenko <mail@gmail.com>
 */
interface PaginatorServiceInterface
{
    /**
     * Pagination for posts.
     *
     * @param array $posts
     *
     * @return iterable
     */
    public function paginatePosts(array $posts): iterable;
}
