<?php

declare(strict_types=1);

namespace App\EventSubscriber;

use App\Entity\Brand\BrandInterface;
use Sylius\Resource\Symfony\EventDispatcher\GenericEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Workflow\Event\CompletedEvent;

final class BrandSubscriber implements EventSubscriberInterface
{
    public function onShow(GenericEvent $event): void
    {
        $brand = $event->getSubject();
        if (!$brand instanceof BrandInterface) {
            return;
        }

        dump($brand->getName(), $brand->getCode());
    }

    public function onApprove(CompletedEvent $event): void
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
            'sylius.brand.show' => 'onShow',
            'workflow.sylius_brand.completed.approve' => 'onApprove',
        ];
    }
}
