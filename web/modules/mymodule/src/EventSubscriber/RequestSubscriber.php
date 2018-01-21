<?php

namespace Drupal\mymodule\EventSubscriber;

use Drupal\Core\Url;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;
use Symfony\Component\HttpKernel\KernelEvents;

class RequestSubscriber implements EventSubscriberInterface {

    /**
     * Redirect all anonymous users to the login page
     * @param \Symfony\Component\HttpKernel\Event\GetResponseEvent $event
     *   The event.
     */
    public function doAnonymousRedirect(GetResponseEvent $event) {
        // Make sure we are not on the user login route
        if(\Drupal::routeMatch()->getRouteName() == 'user.login') {
            return;
        }

        // Check if current user is logged in
        if(\Drupal::currentUser()->isAnonymous()) {
            // If not logged in, create redirect response
            $url = Url::fromRoute('user.login')->toString();
            $redirct = new RedirectResponse($url);

            // Set the redirect response on the event, cancelling the default response
            $event->setResponse($redirct);
        }
    }

    /**
     * {@inheritdoc}
     */
    public static function getSubscribedEvents()
    {
        return [
            KernelEvents::REQUEST => ['doAnonymousRedirect', 28],
        ];
    }
}