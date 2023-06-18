<?php namespace Ovalsoft\Payment;

use System\Classes\PluginBase;
use Backend;
use Carbon\Carbon;
use Event;
use Ovalsoft\Payment\Models\Payment as PaymentModel;
use Rainlab\User\Models\User as UserModel;
use Rainlab\User\Controllers\Users as UsersController;
use Rainlab\User\Models\UserGroup as UserGroupModel;
use Rainlab\User\Controllers\UserGroups as UserGroupsController;


class Plugin extends PluginBase
{
    public $require = ['Rainlab.User'];

    public function pluginDetails()
    {
        return [
            'name' => 'Payment',
            'description' => 'Payments Component.',
            'author' => 'Ovalsoft Technologies',
            'icon' => 'icon-leaf'
        ];
    }

    public function registerComponents()
    {
    	return [
    		'Ovalsoft\Payment\Components\Payment' => 'Payment'
    	];
    }

    public function registerSettings()
    {
        return [
            'settings' => [
                'label'       => 'Payment',
                'description' => 'Manage available payments (Payment supported for now).',
                'category'    => 'Payments',
                'icon'        => 'icon-globe',
                'class'       => 'Ovalsoft\Payment\Models\Settings',
                // 'url'         => Backend::url('ovalsoft/payment/payments/'),
                'order'       => 500,
                'keywords'    => 'payment payment'
            ]
        ];
    }

    public function boot() {

        $this->extendsUserModel();
        $this->extendsUserGroupsController();

        Event::listen('ovalsoft.payment.success', function ($user, $response, $membership_id) { 

            /**
             * add user tp group on successful payment   
             */
            if ($user) {
                $group =  \Rainlab\User\Models\UserGroup::find($membership_id);
                        $user->groups()->add($group);
                        $user->save();
            }


            /**
             * Log details of a payment as returned by Paystack to webhook URL
             */
            $paymentModel                                             = new PaymentModel;
            $paymentModel->user_id                                    = $user ? $user->id : null;
            $paymentModel->payment_trxref                             = $response->id;
            $paymentModel->reference                                  = $response->reference;
            $paymentModel->domain                                     = $response->domain;
            $paymentModel->status                                     = $response->status;
            $paymentModel->message                                    = $response->message;
            $paymentModel->gateway_response                           = $response->gateway_response;
            $paymentModel->paid_at                                    = $response->paid_at;
            $paymentModel->channel                                    = $response->channel;
            $paymentModel->currency                                   = $response->currency;
            $paymentModel->ip_address                                 = $response->ip_address;
            $paymentModel->log_start_time                             = $response->log->start_time;
            $paymentModel->log_attempts                               = $response->log->attempts;
            $paymentModel->log_start_errors                           = $response->log->errors;
            $paymentModel->log_start_success                          = $response->log->success;
            $paymentModel->log_start_mobile                           = $response->log->mobile;
            $paymentModel->authorization_authorization_code           = $response->authorization->authorization_code;
            $paymentModel->authorization_bin                          = $response->authorization->bin;
            $paymentModel->authorization_last4                        = $response->authorization->last4;
            $paymentModel->authorization_exp_month                    = $response->authorization->exp_month;
            $paymentModel->authorization_exp_year                     = $response->authorization->exp_year;
            $paymentModel->authorization_channel                      = $response->authorization->channel;
            $paymentModel->authorization_card_type                    = $response->authorization->card_type;
            $paymentModel->authorization_bank                         = $response->authorization->bank;
            $paymentModel->authorization_country_code                 = $response->authorization->country_code;
            $paymentModel->authorization_brand                        = $response->authorization->brand;
            $paymentModel->authorization_reusable                     = $response->authorization->reusable;
            $paymentModel->authorization_signature                    = $response->authorization->signature;
            $paymentModel->authorization_account_name                 = $response->authorization->account_name;
            $paymentModel->authorization_receiver_bank_account_number = $response->authorization->receiver_bank_account_number;
            $paymentModel->authorization_receiver_bank                = $response->authorization->receiver_bank;
            $paymentModel->customer_id                                = $response->customer->id;
            $paymentModel->customer_first_name                        = $response->customer->first_name;
            $paymentModel->customer_last_name                         = $response->customer->last_name;
            $paymentModel->customer_email                             = $response->customer->email;
            $paymentModel->customer_customer_code                     = $response->customer->customer_code;
            $paymentModel->customer_phone                             = $response->customer->phone;
            $paymentModel->customer_risk_action                       = $response->customer->risk_action;
            $paymentModel->requested_amount                           = $response->requested_amount / 100;
            $paymentModel->created_at                                 = Carbon::now();
            $paymentModel->updated_at                                 = Carbon::now();
            $paymentModel->save();
        });
    }



    public function extendsUserModel() {
        UserModel::extend(function($model) {
            $model->hasMany = [
                'payments' => 'Ovalsoft\Payment\Models\Payment'
            ];
        });
    }


    public function extendsUserGroupsController() {
        UserGroupsController::extendFormFields(function($form, $model, $context) {

            if(!$model instanceof UserGroupModel)
                return;

            if(!$model->exists)
                return;

            // Add an extra amount field
            $form->addFields([
                'amount' => [
                    'label'   => 'Amount',
                    'comment' => 'Enter amount for this Group',
                    'type'    => 'number',
                    'span'    => 'full'
                ]
            ]);
        });
        
        UserGroupsController::extendListColumns(function($list, $model) {

            if(!$model instanceof UserGroupModel)
                return;

            // Add an extra amount column
            $list->addColumns([
                'amount' => [
                    'label' => 'Amount'
                ]
            ]);

        });
    }
}
