<?php namespace Ovalsoft\Appointment\Controllers;

use BackendMenu;
use Backend\Classes\Controller;
use Ovalsoft\Appointment\Models\Booking;

/**
 * Bookings Back-end Controller
 */
class Bookings extends Controller
{
    public $implement = [
        'Backend.Behaviors.FormController',
        'Backend.Behaviors.ListController',
        'Backend.Behaviors.RelationController',
    ];

    public $formConfig = 'config_form.yaml';
    public $listConfig = 'config_list.yaml';
    public $relationConfig = 'config_relation.yaml';

    public function __construct()
    {
        parent::__construct();

        BackendMenu::setContext('Ovalsoft.Appointment', 'appointment', 'bookings');
    }
    
    public function onPreviewForm()
    {     
        $this->asExtension('FormController')->preview(post('record_id'));
        $this->vars['recordId'] = post('record_id');
        $this->vars['record'] = Booking::find(post('record_id'));

        return $this->makePartial('preview');
    }
}
