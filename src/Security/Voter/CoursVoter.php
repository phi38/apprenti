<?php

namespace App\Security\Voter;

use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;
use Symfony\Component\Security\Core\User\UserInterface;

class CoursVoter extends Voter
{
    protected function supports($attribute, $subject)
    {
        // replace with your own logic
        // https://symfony.com/doc/current/security/voters.html
        return in_array($attribute, ['POST_EDIT', 'POST_VIEW'])
            && $subject instanceof \App\Entity\Cours;
    }

    protected function voteOnAttribute($attribute, $subject, TokenInterface $token)
    {
        $user = $token->getUser();
        // if the user is anonymous, do not grant access
        if (!$user instanceof UserInterface) {
            return false;
        }

        // ... (check conditions and return true to grant permission) ...
        switch ($attribute) {
            case 'POST_EDIT':
                // logic to determine if the user can EDIT
                 return false;
                break;
            case 'POST_VIEW':
                // logic to determine if the user can VIEW
                // return true or false
                // logic to determine if the user can VIEW
           /*     
           //Security $security
                          // if ($this->security->isGranted('ROLE_ADMIN')) {
           if ($subject->getOwner() === $user) {
                    return true;
                }
                */
                return true;
                break;
        }
        throw new \Exception(sprintf('Unhandled attribute "%s"', $attribute));
        return false;
    }
}
