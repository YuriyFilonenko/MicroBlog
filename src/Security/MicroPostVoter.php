<?php

namespace App\Security;

use App\Entity\MicroPost;
use App\Entity\User;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;

/**
 * Description of MicroPostVoter.
 *
 * @author Yuriy Filonenko <mail@gmail.com>
 */
class MicroPostVoter extends Voter
{
    const EDIT = 'edit';
    const DELETE = 'delete';

    protected function supports($attribute, $subject): bool
    {
        if (!\in_array($attribute, [self::EDIT, self::DELETE])) {
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
