<?php namespace Ovalsoft\Payment\Components;

use Cms\Classes\ComponentBase;

use Lang;
use Auth;
use Request;
use ApplicationException;
use October\Rain\Auth\AuthException;
use Cms\Classes\Page;
use RainLab\User\Models\User as UserModel;
use RainLab\User\Models\Settings as UserSettings;
use Exception;
use Ovalsoft\Payment\Classes\Paystack;

use Ovalsoft\Payment\Models\Payment as PaymentModel;
use Ovalsoft\Payment\Models\Settings;
use Rainlab\User\Models\User;
use RainLab\User\Components\Account;
use GuzzleHttp\Client;
use Flash;
use Redirect;
use Mail;
use Input;
use Validator;
use ValidationException;
use Event;
use Rainlab\User\Models\UserGroup as UserGroupModel;
use Ovalsoft\Appointment\Models\Type as AppointmentType;
  
use Carbon\Carbon;


class Payment extends ComponentBase {

  public $vueComponents = ['Todo'];


  public function componentDetails()
  {
    return [
      'name'        => 'Payment Component',
      'description' => 'Component for all payment payments'
    ];
  }



  public function defineProperties()
  {
    return [
        'code' => [
             'title'             => 'Code',
             'description'       => 'Code that ties this payment to an item in the system',
             'default'           => '',
             'type'              => 'string',
             'required'          => 1,
        ]
      ];
  }



  public function onRun()
  {
    $this->page['user'] = Auth::getUser();
    $this->page['payment_settings'] = $this->settings();
    $this->page['types'] = AppointmentType::all();
    $this->page['code'] = $this->property('code');;
    // dd($this->page['groups']);
  }

/**
 * Update selected membership plan  partial with amount
 */
public function onGetMembershipAmount() {

  // dd(post());
  $type_id = post('type_id');

  if (empty($type_id)) {
    return ['#membershipAmount' => ''];
  }

  $type = AppointmentType::find($type_id);
  if($type) {
    $this->page['amount'] = $type->amount;
  } else {
    $this->page['amount'] = 'Appointment Type not found';
  }

  return ['#membershipAmount' => $this->renderPartial('@membershipAmountPartial')];

}



  public function settings() {
      return [
          'paystack_pk_key'   => Settings::get('paystack_pk_key'),
      ];
  }


function onPayment() {
  // dd(post());

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
  Event::fire('ovalsoft.appointment.booked', [$payment]);

  return redirect('/');
}

  /**
   * I was doing thiswhen I wanted to use payment standard 
   */
  public function onPaymentStandard() {

    $data = post();

    $rules = [
        'email'   => 'required',
        'amount'  => 'required',
    ];

    $token = Settings::get('api_key');
    $url = 'https://api.payment.co/transaction/initialize';

    $client = new Client();

    $response = $client->request('POST', $url, [
      'form_params' => [
          'email'   => post('email'),
          'amount'  => post('amount')
      ],
      'headers' => [
          'Accept'        => 'application/json',
          'Cache-Control' => 'no-cache',
          'Authorization' => 'Bearer ' . $token,        
      ],
      'timeout' => 120,
    ])->getBody()->getContents();

    $response_data = json_decode($response)->data;

    return redirect($response_data->authorization_url);

    dd($response);

    $validator = Validator::make($data, $rules);

    if ($validator->fails()) {
        throw new ValidationException($validator);
        
    }

    $PaymentModel                    = new PaymentModel;
    // $PaymentModel->user_id           = post('user_id');
    // $PaymentModel->name              = post('name');
    // $PaymentModel->phone             = post('phone');
    $PaymentModel->email             = post('email');
    $PaymentModel->amount            = post('amount');
    $PaymentModel->authorization_url = $response_data->authorization_url;
    $PaymentModel->access_code       = $response_data->access_code;
    $PaymentModel->reference         = $response_data->reference;
    $PaymentModel->save();


    Flash::success('Registration successful');
    Redirect::back();
  }

  /**
   * Returns true if user is throttled.
   * @return bool
   */
  protected function isRegisterThrottled() {
      if (!UserSettings::get('use_register_throttle', false)) {
          return false;
      }

      return UserModel::isRegisterThrottled(Request::ip());
  }

  public function onAddTask() {
    if (($newTask = post('newTask')) != '') {
      $task = new PaymentModel;
      $task->title = $newTask;
      $task->save();
      return [ 'newTask' => $task];
    } else {
      throw new \ValidationException(['newTask' => 'Payment can not be empty'], 1);
    }
  }

  public function onDeleteTask() {
    if ($task_id = post('task_id')) {
      PaymentModel::destroy($task_id);
    }
  }

}
