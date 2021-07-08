<?php
/**
 * This file is part of HTMLPurifier
 *
 * Copyright(c) Akira Kurozumi <info@a-zumi.net>
 *
 *  https://a-zumi.net
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Plugin\HTMLPurifier\Form\EventListener;


use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;

class HTMLPurifierListener implements EventSubscriberInterface
{
    /**
     * @return array[]
     */
    public static function getSubscribedEvents(): array
    {
        return [
            FormEvents::PRE_SUBMIT => ['purifySubmittedData', /* as soon as possible */ 1000001],
        ];
    }

    /**
     * @param FormEvent $event
     */
    public function purifySubmittedData(FormEvent $event): void
    {
        if ('&' === $event->getData()) {
            $event->setData(mb_convert_kana($event->getData(), 'A'));
        }
    }
}
