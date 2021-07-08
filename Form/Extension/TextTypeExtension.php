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

namespace Plugin\HTMLPurifier\Form\Extension;


use Eccube\Request\Context;
use Plugin\HTMLPurifier\Form\EventListener\HTMLPurifierListener;
use Symfony\Component\Form\AbstractTypeExtension;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TextTypeExtension extends AbstractTypeExtension
{
    /**
     * @var Context
     */
    private $context;

    /**
     * TextTypeExtension constructor.
     * @param Context $context
     */
    public function __construct(Context $context)
    {
        $this->context = $context;
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver): void
    {
        if ($this->context->isFront()) {
            $resolver->setDefault('purify_html', true);
        }
    }

    /**
     * @return string
     */
    public function getExtendedType(): string
    {
        return TextType::class;
    }

    /**
     * @return iterable
     */
    public static function getExtendedTypes(): iterable
    {
        yield TextType::class;
    }

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        if ($options['purify_html']) {
            $builder->addEventSubscriber(
                new HTMLPurifierListener()
            );
        }
    }
}
