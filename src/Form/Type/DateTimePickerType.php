<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use function Symfony\Component\String\u;

/**
 * Defines the custom form field type used to manipulate datetime values across
 * Bootstrap Date\Time Picker javascript plugin.
 *
 * See https://symfony.com/doc/current/form/create_custom_field_type.html
 *
 * @author Yonel Ceruto <yonelceruto@gmail.com>
 */
final class DateTimePickerType extends AbstractType
{
    public function configureOptions(OptionsResolver $resolver): void
    {
        // @see https://symfony.com/doc/current/reference/forms/types/date.html#rendering-a-single-html5-text-box
        $resolver->setDefaults([
            'widget' => 'single_text',
            'input' => 'datetime_immutable',
            // if true, the browser will display the native date picker widget
            // however, this app uses a custom JavaScript widget, so it must be set to false
            'html5' => false,
            // adds a class that can be selected in JavaScript
            'attr' => [
                'class' => 'flatpickr',
                // Attributes for flatpickr usage
                'data-flatpickr-class' => 'standard',
                'data-date-locale' => u(\Locale::getDefault())->replace('_', '-')->lower(),
                'data-date-format' => 'Y-m-d H:i',
            ],
            'format' => 'yyyy-MM-dd HH:mm',
            'input_format' => 'Y-m-d H:i',
            'date_format' => 'Y-m-d H:i',
        ]);
    }

    public function getParent(): string
    {
        return DateTimeType::class;
    }
}
