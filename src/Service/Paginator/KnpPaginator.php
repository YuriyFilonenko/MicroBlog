<?php

namespace App\Service\Paginator;

use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\RequestStack;

/**
 * Pagination for posts using Knp paginator.
 *
 * @author Yuriy Filonenko <mail@gmail.com>
 */
class KnpPaginator implements PaginatorServiceInterface
{
    const POSTS_LIMIT = 6;

    private $paginator;
    private $request;

    public function __construct(PaginatorInterface $paginator, RequestStack $request)
    {
        $this->paginator = $paginator;
        $this->request = $request->getCurrentRequest();
    }

    /**
     * {@inheritdoc}
     */
    public function paginatePosts(array $posts): iterable
    {
        return $this->paginator->paginate(
            $posts,
            $this->request->query->getInt('page', 1),
            self::POSTS_LIMIT
        );
    }
}
