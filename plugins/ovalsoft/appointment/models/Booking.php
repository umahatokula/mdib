<?php namespace Ovalsoft\Appointment\Models;

use Model;
use Ovalsoft\Appointment\Models\Type;

/**
 * Booking Model
 */
class Booking extends Model
{
    use \October\Rain\Database\Traits\Validation;

    /**
     * @var string The database table used by the model.
     */
    public $table = 'ovalsoft_appointment_bookings';

    /**
     * @var array Guarded fields
     */
    protected $guarded = ['*'];

    /**
     * @var array Fillable fields
     */
    protected $fillable = [];

    /**
     * @var array Validation rules for attributes
     */
    public $rules = [];

    /**
     * @var array Attributes to be cast to native types
     */
    protected $casts = [];

    /**
     * @var array Attributes to be cast to JSON
     */
    protected $jsonable = [];

    /**
     * @var array Attributes to be appended to the API representation of the model (ex. toArray())
     */
    protected $appends = [];

    /**
     * @var array Attributes to be removed from the API representation of the model (ex. toArray())
     */
    protected $hidden = [];

    /**
     * @var array Attributes to be cast to Argon (Carbon) instances
     */
    protected $dates = [
        'created_at',
        'updated_at'
    ];

    /**
     * @var array Relations
     */
    public $hasOne = [
        'marital_questionnaire' => ['Ovalsoft\Appointment\Models\CounsellingQuestionnaire'],
    ];
    public $hasMany = [];
    public $belongsTo = [
        'user' => [
            'Rainlab\User\Models\User',
            'table' => 'users',
            'key'      => 'user_id',
            'otherKey' => 'id'
        ],
        'type' => [
            'Ovalsoft\Appointment\Models\Type',
            'table' => 'ovalsoft_appointment_types',
            'key'      => 'type_id',
            'otherKey' => 'id'
        ],
    ];
    public $belongsToMany = [
        'times' => [
            'Ovalsoft\Appointment\Models\Time',
            'table' => 'ovalsoft_appointment_day_time',
            'key'      => 'day_id',
            'otherKey' => 'time_id'
        ],
    ];
    public $morphTo = [];
    public $morphOne = [];
    public $morphMany = [];
    public $attachOne = [];
    public $attachMany = [];

    function getTypeIdOptions() {        
        return Type::pluck('name', 'id');
    }

    function generateCode() {
        

        // The length we want the unique reference number to be
        $trxnNumber_length = 8;

        // A true/false variable that lets us know if we've found a unique reference number or not
        $trxnNumber_found = false;

        // Define possible characters. Characters that may be confused such as the letter 'O' and the number zero aren't included
        $possible_chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890";

        // Until we find a unique reference, keep generating new ones
        while (!$trxnNumber_found) {

        // Start with a blank reference number
        $trxnNumber = "";

        // Set up a counter to keep track of how many characters have currently been added
        $i = 0;

        // Add random characters from $possible_chars to $trxnNumber until $trxnNumber_length is reached
        while ($i < $trxnNumber_length) {

            // Pick a random character from the $possible_chars list
            $char = substr($possible_chars, mt_rand(0, strlen($possible_chars)-1), 1);

            $trxnNumber .= $char;

            $i++;

        }

        // Our new unique reference number is generated. Lets check if it exists or not
        $result = Booking::where('code', $trxnNumber)->first();

        if (is_null($result)) {

            // We've found a unique number. Lets set the $trxnNumber_found variable to true and exit the while loop
            $trxnNumber_found = true;

        }

        return $trxnNumber;

        }
    }
}
