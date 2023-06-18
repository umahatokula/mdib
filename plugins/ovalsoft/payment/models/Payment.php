<?php namespace Ovalsoft\Payment\Models;

use Model;

/**
 * Model
 */
class Payment extends Model
{
    use \October\Rain\Database\Traits\Validation;
    
    /*
     * Disable timestamps by default.
     * Remove this line if timestamps are defined in the database table.
     */
    public $timestamps = false;

    /**
     * @var array Validation rules
     */
    public $rules = [
    ];

    /**
     * @var string The database table used by the model.
     */
    public $table = 'ovalsoft_payments_';

    public $belongsTo = [
        'user' => 'Rainlab\User\Models\User',
        'booking' => [
            'Ovalsoft\Appointment\Models\Booking',
            'table' => 'ovalsoft_appointment_bookings',
            'key'      => 'code',
            'otherKey' => 'code'
        ],
    ];

    
}
