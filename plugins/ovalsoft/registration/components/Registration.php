<?php namespace Ovalsoft\Registration\Components;

use Cms\Classes\ComponentBase;
use Ovalsoft\Registration\Models\Registration as RegistrationModel;
use Flash;
use Event;
use Redirect;
use Mail;
use Input;
use Validator;
use Validation;
use ValidationException;
use Ovalsoft\Payment\Models\Payment as PaymentModel;
use Ovalsoft\Payment\Models\Settings;
  
use Carbon\Carbon;

class Registration extends ComponentBase
{
    public function componentDetails()
    {
        return [
            'name'        => 'Registration Component',
            'description' => 'No description provided yet...'
        ];
    }

    public function defineProperties()
    {
        return [
            'event' => [
                 'title'             => 'Event',
                 'description'       => 'The name of the event this registration is for',
                 'required'           => true,
                 'type'              => 'string',
            ]
        ];
    }

     public function onRun()
     {
       $this->page['payment_settings'] = Settings::get('paystack_pk_key');
       // dd(Settings::get('paystack_pk_key'));
     }

    public function onRegister() {
        
        $data = post();
        // dd($data);
    
        $rules = [
            'name'                  => 'required',
            'email'                 => 'required|email',
            'relationship_status'   => 'required',
        ];
  
        $messages = [
            'name.required'                 => 'Please enter your first name',
            'email.required'                => 'Please enter your email',
            'email.email'                   => 'Please enter a valid email',
            'relationship_status.required'  => 'This field is required',
        ];
  
        $validator = Validator::make($data, $rules, $messages);
  
        if ($validator->fails()) {
          throw new ValidationException($validator);
        }

        $reg = new RegistrationModel;
        $reg->name = post('name');
        $reg->email = post('email');
        $reg->relationship_status = post('relationship_status');
        $reg->event = $this->property('event');
        $reg->save();

        $payment               = new PaymentModel;
        $payment->reference    = post('reference');
        $payment->user_name    = post('name');
        $payment->user_email   = post('email');
        $payment->amount       = post('amount');
        $payment->order_number = post('code');
        $payment->message      = post('message');
        $payment->type         = post('type');
        $payment->created_at   = Carbon::now();
        $payment->save();

        // fire event
        Event::fire('ovalsoft.event.registration', [$payment]);

        return redirect('/registration-thanks');

        Flash::success('Registration Successful');
    }
}
