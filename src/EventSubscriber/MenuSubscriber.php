<?php

declare(strict_types=1);

namespace App\EventSubscriber;

use Sylius\Bundle\UiBundle\Menu\Event\MenuBuilderEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

final class MenuSubscriber implements EventSubscriberInterface
{
    public static function getSubscribedEvents(): array
    {
        return [
            'sylius.menu.admin.main' => 'onAdminMenuBuild',
        ];
    }

    public function onAdminMenuBuild(MenuBuilderEvent $event): void
    {
        $menu = $event->getMenu();
        $catalog = $menu->getChild('catalog');

        $catalog
            ->addChild('brands', ['route' => 'sylius_admin_brand_index'])
            ->setLabel('sylius.ui.brands')
        ;
    }
}
