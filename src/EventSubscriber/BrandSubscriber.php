<?php

declare(strict_types=1);

namespace App\EventSubscriber;

use App\Entity\Brand\BrandInterface;
use Sylius\Resource\Symfony\EventDispatcher\GenericEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Workflow\Event\CompletedEvent;

final class BrandSubscriber implements EventSubscriberInterface
{
    public function onBrandShow(GenericEvent $event): void
    {
        $brand = $event->getSubject();
        if (!$brand instanceof BrandInterface) {
            return;
        }

//        $event->setResponse(new Response('Hello'));
        dump($brand->getCode());
    }

    public function onBrandApprove(CompletedEvent $event): void
    {
        $transition = $event->getTransition();
        $brand = $event->getSubject();
        if (!$brand instanceof BrandInterface) {
            return;
        }

        dump($brand->getCode(), $transition->getName());
    }

    public static function getSubscribedEvents(): array
    {
        return [
            'sylius.brand.show' => 'onBrandShow',
            'workflow.sylius_brand.completed.approve' => 'onBrandApprove',
        ];
    }
}
