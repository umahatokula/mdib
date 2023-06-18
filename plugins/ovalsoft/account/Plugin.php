<?php namespace Ovalsoft\Account;

use Backend;
use System\Classes\PluginBase;

/**
 * Account Plugin Information File
 */
class Plugin extends PluginBase
{
    /**
     * Returns information about this plugin.
     *
     * @return array
     */
    public function pluginDetails()
    {
        return [
            'name'        => 'Account',
            'description' => 'No description provided yet...',
            'author'      => 'Ovalsoft',
            'icon'        => 'icon-leaf'
        ];
    }

    /**
     * Register method, called when the plugin is first registered.
     *
     * @return void
     */
    public function register()
    {

    }

    /**
     * Boot method, called right before the request route.
     *
     * @return array
     */
    public function boot()
    {

    }

    /**
     * Registers any front-end components implemented in this plugin.
     *
     * @return array
     */
    public function registerComponents()
    {
        return [
            'Ovalsoft\Account\Components\Register' => 'registrationComponent',
        ];
    }

    /**
     * Registers any back-end permissions used by this plugin.
     *
     * @return array
     */
    public function registerPermissions()
    {
        return []; // Remove this line to activate

        return [
            'ovalsoft.account.some_permission' => [
                'tab' => 'Account',
                'label' => 'Some permission'
            ],
        ];
    }

    /**
     * Registers back-end navigation items for this plugin.
     *
     * @return array
     */
    public function registerNavigation()
    {
        return []; // Remove this line to activate

        return [
            'account' => [
                'label'       => 'Account',
                'url'         => Backend::url('ovalsoft/account/mycontroller'),
                'icon'        => 'icon-leaf',
                'permissions' => ['ovalsoft.account.*'],
                'order'       => 500,
            ],
        ];
    }
}
