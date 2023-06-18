<?php namespace Ovalsoft\Appointment\Controllers;

use BackendMenu;
use Backend\Classes\Controller;

/**
 * Times Back-end Controller
 */
class Times extends Controller
{
    public $implement = [
        'Backend.Behaviors.FormController',
        'Backend.Behaviors.ListController'
    ];

    public $formConfig = 'config_form.yaml';
    public $listConfig = 'config_list.yaml';

    public function __construct()
    {
        parent::__construct();

        BackendMenu::setContext('Ovalsoft.Appointment', 'appointment', 'times');
    }
}
