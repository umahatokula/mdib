<?php namespace Ovalsoft\Appointment\Models;

use Model;
use Illuminate\Support\Str;
use Ovalsoft\Appointment\Models\Type as AppointmentType;

/**
 * Day Model
 */
class Day extends Model
{
    use \October\Rain\Database\Traits\Validation;

    /**
     * @var string The database table used by the model.
     */
    public $table = 'ovalsoft_appointment_days';

    /**
     * Set the user's first name.
     *
     * @param  string  $value
     * @return void
     */
    public function setDayOfWeekAttribute($value)
    {
        $this->attributes['day_of_week'] = Str::singular($value);
    }

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
    public $hasOne = [];
    public $hasMany = [];
    public $belongsTo = [
        'appointment_type' => [
            'Ovalsoft\Appointment\Models\Type',
            'key'      => 'type_id',
            'otherKey' => 'id'
        ]
    ];
    public $belongsToMany = [
        'times' => [
            'Ovalsoft\Appointment\Models\Time',
            'table' => 'ovalsoft_appointment_day_time',
            'key'      => 'day_id',
            'otherKey' => 'time_id',
        ],];
    public $morphTo = [];
    public $morphOne = [];
    public $morphMany = [];
    public $attachOne = [];
    public $attachMany = [];

    function getTypeIdOptions() {
        return AppointmentType::pluck('name', 'id');
    }
}
