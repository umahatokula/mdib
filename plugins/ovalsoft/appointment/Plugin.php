<?php namespace Ovalsoft\Appointment;

use Backend;
use System\Classes\PluginBase;
use Event;
use Mail;

/**
 * Appointment Plugin Information File
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
            'name'        => 'Appointment',
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
    public function boot() {
    
        Event::listen('ovalsoft.appointment.booked', function ($payment) {

            $vars = [
                'payment' => $payment,
                'booking' => $payment->booking,
            ];

            Mail::send('ovalsoft.appointment::mail.appointment', $vars, function($message) use ($payment) {
        
                $message->to($payment->booking->user->email, $payment->booking->user->name);
                $message->subject('MDIB Appointment Confirmation');
        
            });
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
            'Ovalsoft\Appointment\Components\BookAppointment' => 'bookAppointment',
            'Ovalsoft\Appointment\Components\AppointmentQuestionnaire' => 'appointmentQuestionnaire',
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
            'ovalsoft.appointment.some_permission' => [
                'tab' => 'Appointment',
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
            'appointment' => [
                'label'       => 'Appointments',
                'url'         => Backend::url('ovalsoft/appointment/bookings'),
                'icon'        => 'icon-calendar-check-o',
                'permissions' => ['ovalsoft.appointment.*'],
                'order'       => 500,
                'sideMenu'    => [
                    'Appointment' => [
                        'label'       => 'Booked Appointments',
                        'url'         => Backend::url('ovalsoft/appointment/bookings'),
                        'icon'        => 'icon-film',
                        'permissions' => ['ovalsoft.days.*'],
                        'order'       => 500,
                    ], 
                    'Appointment Days' => [
                        'label'       => 'Days',
                        'url'         => Backend::url('ovalsoft/appointment/days'),
                        'icon'        => 'icon-film',
                        'permissions' => ['ovalsoft.days.*'],
                        'order'       => 500,
                    ],  
                    'Appointment Times' => [
                        'label'       => 'Times',
                        'url'         => Backend::url('ovalsoft/appointment/times'),
                        'icon'        => 'icon-film',
                        'permissions' => ['ovalsoft.times.*'],
                        'order'       => 500,
                    ],  
                    'Appointment Types' => [
                        'label'       => 'Types',
                        'url'         => Backend::url('ovalsoft/appointment/types'),
                        'icon'        => 'icon-film',
                        'permissions' => ['ovalsoft.times.*'],
                        'order'       => 500,
                    ],           
                ]
            ],
        ];
    }

}
