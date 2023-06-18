<?php namespace Ovalsoft\Products;

use Backend;
use System\Classes\PluginBase;

use Event;

/**
 * Products Plugin Information File
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
            'name'        => 'Products',
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
        
        // Extend all backend form usage
        Event::listen('backend.form.extendFields', function($widget) {

            // Only for the User controller
            if (!$widget->getController() instanceof \Lovata\Shopaholic\Controllers\Products) {
                return;
            }

            // Only for the User model
            if (!$widget->model instanceof \Lovata\Shopaholic\Models\Product) {
                return;
            }

            // Add an extra birthday field
            $widget->addTabFields([
                'is_digital' => [
                    'label'   => 'Digital Product',
                    'comment' => 'This product is a digital product',
                    'type'    => 'switch',
                    'tab'     => 'Additional Fields',
                    'span'    => 'left',
                ],
                'product_link' => [
                    'label'   => 'Product Link',
                    'comment' => 'Product download link',
                    'type'    => 'mediafinder',
                    'mode'    => 'file',
                    'tab'     => 'Additional Fields',
                    'span'    => 'right',
                ]
            ]);

        });
    }

    /**
     * Registers any front-end components implemented in this plugin.
     *
     * @return array
     */
    public function registerComponents()
    {
        return []; // Remove this line to activate

        return [
            'Ovalsoft\Products\Components\MyComponent' => 'myComponent',
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
            'ovalsoft.products.some_permission' => [
                'tab' => 'Products',
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
            'products' => [
                'label'       => 'Products',
                'url'         => Backend::url('ovalsoft/products/mycontroller'),
                'icon'        => 'icon-leaf',
                'permissions' => ['ovalsoft.products.*'],
                'order'       => 500,
            ],
        ];
    }
}
