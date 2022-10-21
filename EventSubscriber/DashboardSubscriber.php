<?php

/*
 * This file is part of the DemoBundle for Kimai 2.
 * All rights reserved by Kevin Papst (www.kevinpapst.de).
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace KimaiPlugin\DashNewsBundle\EventSubscriber;

use App\Event\DashboardEvent;
use App\Widget\Type\CompoundRow;
use KimaiPlugin\DashNewsBundle\Widget\DashNewsWidget;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class DashboardSubscriber implements EventSubscriberInterface
{
    private $widget;

    public function __construct(DashNewsWidget $widget)
    {
        $this->widget = $widget;
    }

    public static function getSubscribedEvents(): array
    {
        return [
            DashboardEvent::class => ['onDashboardEvent', 90],
        ];
    }

    public function onDashboardEvent(DashboardEvent $event): void
    {
        $section = new CompoundRow();
        //$section->setTitle('News');
        $section->setOrder(0);
        $this->widget->setUser($event->getUser());
        $section->addWidget($this->widget);

        $event->addSection($section);
    }
}
