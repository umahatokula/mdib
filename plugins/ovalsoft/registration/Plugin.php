<?php namespace Ovalsoft\Registration;

use Backend;
use System\Classes\PluginBase;
use Event;
use Mail;

/**
 * Registration Plugin Information File
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
            'name'        => 'Registration',
            'description' => 'A registration plugin',
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


        Event::listen('ovalsoft.event.registration', function ($payment) { 
        

             if ($payment->user_email) {
                  $vars = ['payment' => $payment];

                  Mail::queue('ovalsoft.event::mail.registration', $vars, function($message) use($payment) {

                      $message->to($payment->user_email, $payment->user_name);
                      $message->subject('Marriage Prep School with Doofan');

                  });
             }

        });
    }

    /**
     * Registers any front-end components implemented in this plugin.
     *
     * @return array
     */
    public function registerComponents()
    {
        return [
            'Ovalsoft\Registration\Components\Registration' => 'registration',
        ];
    }

    /**
     * Registers any back-end permissions used by this plugin.
     *
     * @return array
     */
    public function registerPermissions()
    {
        return [
            'ovalsoft.registration.some_permission' => [
                'tab' => 'Registration',
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
        return [
            'registration' => [
                'label'       => 'Registrations',
                'url'         => Backend::url('ovalsoft/registration/registrations'),
                'icon'        => 'icon-leaf',
                'permissions' => ['ovalsoft.registration.*'],
                'order'       => 500,
            ],
        ];
    }
}
