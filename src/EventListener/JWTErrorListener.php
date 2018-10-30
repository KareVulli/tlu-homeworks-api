<?php
namespace App\EventListener;

use App\Exception\JWTException;
use App\Exception\JWTAuthenticationException;
use Lexik\Bundle\JWTAuthenticationBundle\Event\JWTExpiredEvent;
use Lexik\Bundle\JWTAuthenticationBundle\Event\AuthenticationFailureEvent;

final class JWTErrorListener
{
    public function onJWTError(AuthenticationFailureEvent $event)
    {
        throw new JWTAuthenticationException($event->getException()->getMessage());
    }

    public function onJWTExpired(JWTExpiredEvent $event)
    {
        throw new JWTAuthenticationException($event->getException()->getMessageKey());
    }
}