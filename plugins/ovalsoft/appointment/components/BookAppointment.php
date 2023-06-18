<?php namespace Ovalsoft\Appointment\Components;

use Cms\Classes\ComponentBase;


use Lang;
use Auth;
use Request;
use ApplicationException;
use Exception;
use GuzzleHttp\Client; 
use Flash;
use Redirect;
use Mail;
use Input;
use Validator;
use Validation;
use ValidationException;
use Event;
use Ovalsoft\Appointment\Models\Day as AppointmentDay;
use Ovalsoft\Appointment\Models\Type as AppointmentType;
use Ovalsoft\Appointment\Models\Booking;
use Ovalsoft\Appointment\Models\CounsellingQuestionnaire;
use Carbon\Carbon;

class BookAppointment extends ComponentBase
{
    public function componentDetails()
    {
        return [
            'name'        => 'BookAppointment Component',
            'description' => 'No description provided yet...'
        ];
    }

    public function defineProperties()
    {
        return [];
    }

    public function onRun()
    {
        $this->page['user'] = Auth::getUser();
        $this->page['types'] = AppointmentType::all();
        // dd($this->page['groups']);
    }
    
    /**
     * Get all appointment days and times for selected appointment type
     */
    public function onAppointmentType() {

        // dd(post());
        $type_id = post('type_id');

        if (empty($type_id)) {
            return ['#appointmentDays' => ''];
        }

        $days = AppointmentDay::where('type_id', $type_id)->get();
        if($days) {
            $this->page['days'] = $days;
        } else {
            $this->page['days'] = 'Appointment Days not found';
        }

        $type = AppointmentType::find($type_id);
        if($type) {
            $this->page['questionnaire_type'] = $type->id;
        }
        return ['#appointmentDaysAndTimes' => $this->renderPartial('@appointmentDaysAndTimesPartial')];

    }
    
    /**
     * Get all appointment days for selected appointment type
     */
    public function onAppointmentDays() {

        // dd(post());
        $type_id = post('type_id');

        if (empty($type_id)) {
            return ['#appointmentDays' => ''];
        }

        $days = AppointmentDay::where('type_id', $type_id)->get();
        if($days) {
            $this->page['days'] = $days;
        } else {
            $this->page['days'] = 'Appointment Days not found';
        }

        return ['#appointmentDays' => $this->renderPartial('@appointmentDaysPartial')];

    }
    
    /**
     * Get all appointment days for selected appointment type
     */
    public function onAppointmentTimes() {

        // dd(post());
        $day_id = post('day_id');

        if (empty($day_id)) {
            return ['#appointmentTimes' => ''];
        }

        $day = AppointmentDay::find($day_id);

        if($day) {
            $times = $day->times;
            // dd($times);
        }
        

        if($times) {
            $this->page['times'] = $times;
        } else {
            $this->page['times'] = 'Appointment Times not found';
        }

        return ['#appointmentTimes' => $this->renderPartial('@appointmentTimesPartial')];

    }


    /**
     * Submit Appointment Booking
     */
    public function onSubmit() {
        // dd(post());
  
        $data = post();
        // dd($data);
    
        $rules = [
            'name'                   => 'required',
            'start_date'             => 'required|after:'.Carbon::today(),
            'email'                  => 'required|email',
            'phone'                  => 'required',
            'hope_to_achieve'        => 'required_if:type_id,1,',
            'gender'                 => 'required_if:type_id,1,|in:Male,Female',
            'counsellor_type'        => 'required_if:type_id,1,',
            'violence_issues'        => 'required_if:type_id,1',
            'financial_status'       => 'required_if:type_id,1',
            'age'                    => 'required_if:type_id,1',
            'marriage_duration'      => 'required_if:type_id,1',
            'children'               => 'required_if:type_id,1',
            'hear_about_us'          => 'required_if:type_id,1',
            'country'                => 'required_if:type_id,1',
            'city'                   => 'required_if:type_id,2|required_if:type_id,3',
            'dob'                    => 'required_if:type_id,2|required_if:type_id,3',
            'r_status'               => 'required_if:type_id,2|required_if:type_id,3',
            'occupation'             => 'required_if:type_id,2|required_if:type_id,3',
            'educational_background' => 'required_if:type_id,2|required_if:type_id,3',
            'position_in_family'     => 'required_if:type_id,2|required_if:type_id,3',
            'married_before'         => 'required_if:type_id,2|required_if:type_id,3',
            'have_children'          => 'required_if:type_id,2|required_if:type_id,3',
        ];
  
        $messages = [
            'name.required'                      => 'Please enter your first name',
            'start_date.required'                => 'Please select the date you intend to start',
            'start_date.after'                   => 'Intended start date cannot be in the past',
            'email.required'                     => 'Please enter your email',
            'email.email'                        => 'Please enter a valid email',
            'phone.required'                     => 'Please enter your phone number',
            'hope_to_achieve.required_if'        => 'This field is required',
            'gender.required_if'                 => 'This field is required',
            'counsellor_type.required_if'        => 'This field is required ',
            'violence_issues.required_if'        => 'This field is required',
            'financial_status.required_if'       => 'This field is required',
            'age.required_if'                    => 'This field is required',
            'marriage_duration.required_if'      => 'This field is required',
            'children.required_if'               => 'This field is required',
            'hear_about_us.required_if'          => 'This field is required',
            'country.required_if'                => 'This field is required',
            'city.required_if'                   => 'This field is required',
            'dob.required_if'                    => 'This field is required',
            'r_status.required_if'               => 'This field is required',
            'occupation.required_if'             => 'This field is required',
            'educational_background.required_if' => 'This field is required',
            'position_in_family.required_if'     => 'This field is required',
            'married_before.required_if'         => 'This field is required',
            'have_children.required_if'          => 'This field is required',
        ];
  
        $validator = Validator::make($data, $rules, $messages);
  
        if ($validator->fails()) {
          throw new ValidationException($validator);
        }

        try {

            $Booking             = new Booking;
            $Booking->user_id    = $data['user_id'];
            $Booking->name       = $data['name'];
            $Booking->email      = $data['email'];
            $Booking->phone      = $data['phone'];
            $Booking->start_date = $data['start_date'];
            $Booking->type_id    = $data['type_id'];
            $Booking->code       = $Booking->generateCode();
            $Booking->save();

            $MaritalCounsellingQuestionnaire                         = new CounsellingQuestionnaire;
            $MaritalCounsellingQuestionnaire->booking_id             = $Booking->id;
            $MaritalCounsellingQuestionnaire->hope_to_achieve        = post('hope_to_achieve');
            $MaritalCounsellingQuestionnaire->gender                 = post('gender');
            $MaritalCounsellingQuestionnaire->counsellor_type        = post('counsellor_type');
            $MaritalCounsellingQuestionnaire->violence_issues        = post('violence_issues');
            $MaritalCounsellingQuestionnaire->financial_status       = post('financial_status');
            $MaritalCounsellingQuestionnaire->age                    = post('age');
            $MaritalCounsellingQuestionnaire->marriage_duration      = post('marriage_duration');
            $MaritalCounsellingQuestionnaire->children               = post('children');
            $MaritalCounsellingQuestionnaire->hear_about_us          = post('hear_about_us');
            $MaritalCounsellingQuestionnaire->country                = post('country');
            $MaritalCounsellingQuestionnaire->city                   = post('city');
            $MaritalCounsellingQuestionnaire->dob                    = post('dob');
            $MaritalCounsellingQuestionnaire->r_status               = post('r_status');
            $MaritalCounsellingQuestionnaire->occupation             = post('occupation');
            $MaritalCounsellingQuestionnaire->educational_background = post('educational_background');
            $MaritalCounsellingQuestionnaire->position_in_family     = post('position_in_family');
            $MaritalCounsellingQuestionnaire->married_before         = post('married_before');
            $MaritalCounsellingQuestionnaire->have_children          = post('have_children');
            $MaritalCounsellingQuestionnaire->save();

            return Redirect::to('pay/'.$Booking->code);
  
        
            // Flash::success('Registration was successful');
  
        } catch (Exception $ex) {
            if (Request::ajax()) throw $ex;
            else Flash::error($ex->getMessage());
        }
  
    }
}
