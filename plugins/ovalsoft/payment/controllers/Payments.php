<?php namespace Ovalsoft\Payment\Controllers;

use Backend\Classes\Controller;
use BackendMenu;
use System\Classes\SettingsManager;

class Payments extends Controller
{
    public $implement = [ 
        'Backend\Behaviors\ListController',        
        'Backend\Behaviors\ReorderController',
        'Backend.Behaviors.FormController' 
    ];

    public $formConfig = 'form_config.yaml';    
    public $listConfig = 'config_list.yaml';
    public $reorderConfig = 'config_reorder.yaml';

    public function __construct()
    {
        parent::__construct();
        BackendMenu::setContext('Ovalsoft.Payment', 'main-menu-item');
        SettingsManager::setContext('Ovalsoft.Payment', 'settings');
    }
}
