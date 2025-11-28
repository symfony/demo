<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Security;

use App\Entity\Post;
use App\Entity\User;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Vote;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;

/**
 * It grants or denies permissions for actions related to blog posts (such as
 * showing, editing and deleting posts).
 *
 * See https://symfony.com/doc/current/security/voters.html
 *
 * @author Yonel Ceruto <yonelceruto@gmail.com>
 *
 * @extends Voter<non-empty-string, Post>
 */
final class PostVoter extends Voter
{
    // Defining these constants is overkill for this simple application, but for real
    // applications, it's a recommended practice to avoid relying on "magic strings"
    public const DELETE = 'delete';
    public const EDIT = 'edit';
    public const SHOW = 'show';

    protected function supports(string $attribute, mixed $subject): bool
    {
        // this voter is only executed on Post objects and for three specific permissions
        return $subject instanceof Post && \in_array($attribute, [self::SHOW, self::EDIT, self::DELETE], true);
    }

    /**
     * @param Post $post
     */
    protected function voteOnAttribute(string $attribute, $post, TokenInterface $token, ?Vote $vote = null): bool
    {
        $user = $token->getUser();

        // the user must be logged in; if not, deny permission
        if (!$user instanceof User) {
            // votes can include explanations about the decisions. These can be:
            //   * internal: not shown to the end user, but useful for logging or debugging (you can include technical details)
            //   * public: (as in this case) meant to be shown to the end user (make sure to not include sensitive information)
            $vote?->addReason(\sprintf('There is no user logged in, so it\'s not possible to %s the blog post.', $attribute));

            return false;
        }

        // the logic of this voter is pretty simple: if the logged-in user is the
        // author of the given blog post, grant permission; otherwise, deny it.
        // (the supports() method guarantees that $post is a Post object)
        if ($user === $post->getAuthor()) {
            return true;
        }

        $vote?->addReason(\sprintf('You can\'t %s this blog post because you are not its author.', $attribute));

        return false;
    }
}
