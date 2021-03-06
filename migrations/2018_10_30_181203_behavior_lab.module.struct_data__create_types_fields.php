<?php

use ConductLab\StructDataModule\StructuredDatum\Support\SelectFieldType\CategoryOptions;
use Anomaly\Streams\Platform\Database\Migration\Migration;

/**
 * Class BehaviorLabModuleStructDataCreateTypesFields
 *
 * @link   https://ConductLab.site/
 * @author Behavior CPH, ApS <support@ConductLab.site>
 * @author Ryan Thompson <ryan@pyrocms.com>
 * @author Claus Hjort Bube <chb@b-cph.com>
 */
class BehaviorLabModuleStructDataCreateTypesFields extends Migration
{

    /**
     * The fields array.
     *
     * @var array
     */
    protected $fields = [
        'category'       => [
            'type'   => 'anomaly.field_type.select',
            'config' => [
                'handler' => CategoryOptions::class,
            ],
        ],
        'content_layout' => [
            'type'   => 'anomaly.field_type.editor',
            'config' => [
                'mode'          => 'twig',
                'default_value' => '<p>{{ structured_datum.field_slug }}</p>',
            ],
        ],
        'wrapper_layout' => [
            'type'   => 'anomaly.field_type.editor',
            'config' => [
                'mode'          => 'twig',
                'default_value' => '{% extends "conduct_lab.module.structured_data::types.wrapper" %}',
            ],
        ],
    ];
}
