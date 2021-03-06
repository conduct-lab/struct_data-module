<?php namespace ConductLab\StructDataModule\Area\Form;

use Anomaly\Streams\Platform\Ui\Form\FormBuilder;

class AreaFormBuilder extends FormBuilder
{

    /**
     * The form fields.
     *
     * @var array|string
     */
    protected $fields = [];

    /**
     * Additional validation rules.
     *
     * @var array|string
     */
    protected $rules = [];

    /**
     * Fields to skip.
     *
     * @var array|string
     */
    protected $skips = [
        'structured_data',
    ];

    /**
     * The form actions.
     *
     * @var array|string
     */
    protected $actions = [];

    /**
     * The form buttons.
     *
     * @var array|string
     */
    protected $buttons = [
        'cancel',
    ];

    /**
     * The form options.
     *
     * @var array
     */
    protected $options = [];

    /**
     * The form structured_data.
     *
     * @var array
     */
    protected $structured_data = [];

    /**
     * The form assets.
     *
     * @var array
     */
    protected $assets = [];

}
