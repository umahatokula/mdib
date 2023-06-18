<?php namespace Ovalsoft\Payment\Models;

use October\Rain\Database\Model;

class Settings extends Model
{
    use \October\Rain\Database\Traits\Validation;

    public $implement = ['System.Behaviors.SettingsModel'];

    // A unique code
    public $settingsCode = 'ovalsoft_payment_settings';

    // Reference to field configuration
    public $settingsFields = 'fields.yaml';

    /**
     * Validation rules
     */
    public $rules = [
        'paystack_sk_key' => 'required',
        'paystack_pk_key' => 'required'
    ];
}
