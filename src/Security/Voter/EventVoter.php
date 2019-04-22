<?php

namespace App\Security\Voter;

use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;
use Symfony\Component\Security\Core\User\UserInterface;
use App\Entity\User;
use App\Entity\Events;

class EventVoter extends Voter
{
    protected function supports($attribute, $subject)
    {
        return in_array($attribute, ['view', 'edit'])
            && $subject instanceof \App\Entity\Events;
    }

    protected function voteOnAttribute($attribute, $subject, TokenInterface $token)
    {
        $user = $token->getUser();
        if (!$user instanceof UserInterface) {
            return false;
        }

        switch ($attribute) {
            case 'edit':
                return $this->canEdit($subject,$user);
                break;
            case 'view':
                return $this->canView($subject,$user);
                break;
        }

        return false;
    }

    private function canView(Events $event,User $user)
    {
        return $event->getUserEvent() === $user ;
    }

    private function canEdit(Events $event,User $user)
    {
        return $this->canView($event,$user);
    }
}
