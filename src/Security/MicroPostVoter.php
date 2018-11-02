<?php

namespace App\Security;

use App\Entity\MicroPost;
use App\Entity\User;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\AccessDecisionManagerInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;

/**
 * Control access for edit posts and delete posts.
 *
 * @author Yuriy Filonenko <mail@gmail.com>
 */
class MicroPostVoter extends Voter
{
    const EDIT = 'edit';
    const DELETE = 'delete';
    const ADD = 'add';

    private $decisionManager;

    public function __construct(AccessDecisionManagerInterface $decisionManager)
    {
        $this->decisionManager = $decisionManager;
    }

    protected function supports($attribute, $subject): bool
    {
        if (!\in_array($attribute, [self::EDIT, self::DELETE, self::ADD])) {
            return false;
        }

        if (!$subject instanceof MicroPost) {
            return false;
        }

        return true;
    }

    protected function voteOnAttribute($attribute, $subject, TokenInterface $token): bool
    {
        $authenticatedUser = $token->getUser();

        if ($this->decisionManager->decide($token, [User::ROLE_ADMIN])) {
            return true;
        }

        if (!$authenticatedUser instanceof User) {
            return false;
        }

        /* @var $microPost MicroPost */
        $microPost = $subject;

        if ($microPost->getUser()->getId() === $authenticatedUser->getId()) {
            return true;
        }

        return false;
    }
}
