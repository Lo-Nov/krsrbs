<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class GSPDashboard extends Controller
{

    public function addusers(Request $request){
        $url = config('base.auth_URL').'/RevenueSure/api/Account/Register';

        $formData = $request->all();
        $validator = Validator::make($formData,[
            'first_name'=>'required',
            'last_name'=>'required',
            'email'=>'required',
            'user_name'=>'required',
            'password'=>'required',
            'phone_number'=>'required',
            'roles'=>'required',
        ]);

        if ($validator->fails()) {
            $request->session()->flash('message.level', 'danger');
            $request->session()->flash('message.content', $validator->errors());
            return Redirect::back()->withErrors($validator->errors());
        }
        $data = [
            'first_name'=> $request->first_name,
            'middle_name'=> $request->middle_name,
            'last_name'=> $request->last_name,
            'email'=> $request->email,
            'user_name'=> $request->user_name,
            'password'=> $request->password,
            'phone_number'=> $request->phone_number,
            'roles'=> $request->roles,
            "roles_List"=> array($request->roles),
            'national_id'=> $request->national_id,
            "signature"=> $request->national_id,
        ];

       // dd($data);

        $response = json_decode(Http::post($url,$data)->body());

        //dd($response);

        if($response->status_code == 200) {
            $request->session()->flash('message.level', 'success');
            $request->session()->flash('message.content', $response->message);
            return redirect()->back()->withErrors($response->message);
        }else{
            $request->session()->flash('message.level', 'danger');
            $request->session()->flash('message.content', $response->message);
            return redirect()->back()->withErrors($response->message);
        }

    }

    public function users(){
        if (Session::get('is_login') != 1) {
            Session::put('url', url()->current());
            return redirect()->route('login');
        }

        return view('users.users');
    }


    public function dashboard(){
        if (Session::get('is_login') != 1) {
            Session::put('url', url()->current());
            return redirect()->route('login');
        }
        $url = config('base.main_URL').'/parking/reporting/dashboard';

        $dt = Carbon::now();
        $dt->toDateString();

        $data=[
            'start_date'=> "",
            'end_date'=> ""
        ];


        $this->data['dashboard'] = json_decode(Http::post($url,$data)->body());

        //dd($this->data);

        return view('home')->with($this->data);
    }

    public function categories(){

        if (Session::get('is_login') != 1) {
            Session::put('url', url()->current());
            return redirect()->route('login');
        }

        $url = config('base.main_URL').'/parking/settings/categories';
        $this->data['categories'] = json_decode(Http::get($url)->body());

        return view('categories.categories')->with($this->data);

    }
    public function newcategory(Request $request){
        $url = config('base.main_URL').'/parking/settings/category/new';

        $request->validate([
            'category_name'=>'required',
        ]);
        $data = [
            'category_name'=> $request->category_name,
        ];

        $response = json_decode(Http::post($url,$data)->body());
        return response()->json($response);
    }

    //Charges
    public function charges(){
        if (Session::get('is_login') != 1) {
            Session::put('url', url()->current());
            return redirect()->route('login');
        }
        $url = config('base.main_URL').'/parking/settings/charges';

        $this->data['charges'] = json_decode(Http::get($url)->body());

        $url = config('base.main_URL').'/parking/settings/categories';
        $this->data['categories'] = json_decode(Http::get($url)->body());


        return view('charges.charges')->with($this->data);

    }
    public function newcharge(Request $request){
        $url = config('base.main_URL').'/parking/settings/charge/new';

        $request->validate([
            'category_id'=>'required',
            'charge_type'=>'required',
            'charge_amount'=>'required',
        ]);

        $data = [
            'category_id'=> $request->category_id,
            'charge_type'=> $request->charge_type,
            'charge_amount'=> $request->charge_amount,
        ];
        $response = json_decode(Http::post($url,$data)->body());
        return response()->json($response);
    }
    public function checkinpostpay(){
        if (Session::get('is_login') != 1) {
            Session::put('url', url()->current());
            return redirect()->route('login');
        }
        $url = config('base.main_URL').'/parking/reporting/checkins';

        $dt = Carbon::now();
        $dt->toDateString();

        $data=[
            'start_date'=> "",
            'end_date'=> ""
        ];

        $this->data['checkins'] = json_decode(Http::post($url,$data)->body());

        //dd($this->data);

        return view('payments.checkin-post')->with($this->data);
    }
    public function pushpayment(Request $request){
        $url = config('base.main_URL').'/parking/payment';

        $request->validate([
            'reference'=>'required',
            'number_plate'=>'required',
            'amount_paid'=>'required',
            'transaction_date'=>'required',
        ]);

        $data = [
            'reference'=> $request->reference,
            'number_plate'=> $request->number_plate,
            'amount_paid'=> $request->amount_paid,
            'transaction_date'=> $request->transaction_date,
        ];
        $response = json_decode(Http::post($url,$data)->body());
        return response()->json($response);
    }

    //Checkin
    public function checkins(){
        if (Session::get('is_login') != 1) {
            Session::put('url', url()->current());
            return redirect()->route('login');
        }
        $url = config('base.main_URL').'/parking/settings/charges';

        $this->data['charges'] = json_decode(Http::get($url)->body());

        $url = config('base.main_URL').'/parking/settings/categories';
        $this->data['categories'] = json_decode(Http::get($url)->body());


        return view('checkin.checkin')->with($this->data);

    }
    public function bookcar(Request $request){
        $url = config('base.main_URL').'/parking/checkin';

        $formData = $request->all();
        $validator = Validator::make($formData,[
            'category_id'=>'required',
            'number_plate'=>'required',
            'checkin_time'=>'required',

        ]);

        if ($validator->fails()) {
            $request->session()->flash('message.level', 'danger');
            $request->session()->flash('message.content', $validator->errors());
            return Redirect::back()->withErrors($validator->errors());

        }
        $data = [
            'category_id'=> $request->category_id,
            'number_plate'=> $request->number_plate,
            'checkin_time'=> $request->checkin_time,
            'attendant_name'=>Session::get('user_full_name'),
            'attendant_id'=>Session::get('user_id')
        ];


        $response = json_decode(Http::post($url,$data)->body());

        if($response->status == 200) {
            $request->session()->flash('message.level', 'success');
            $request->session()->flash('message.content', $response->message);
            return redirect()->back()->withErrors($response->message);
        }else{
            $request->session()->flash('message.level', 'danger');
            $request->session()->flash('message.content', $response->message);
            return redirect()->back()->withErrors($response->message);
        }


    }

    //Check out
    public function checkout(){
        if (Session::get('is_login') != 1) {
            Session::put('url', url()->current());
            return redirect()->route('login');
        }
        $url = config('base.main_URL').'/parking/reporting/checkins';

        $dt = Carbon::now();
        $dt->toDateString();

        $data=[
            'start_date'=> "",
            'end_date'=> ""
        ];

        $this->data['checkins'] = json_decode(Http::post($url,$data)->body());

        //dd($this->data);
        return view('checkout.checkout')->with($this->data);

    }
    public function toagari(Request $request){
        $url = config('base.main_URL').'/parking/checkout';

        $formData = $request->all();
        $validator = Validator::make($formData,[
            'number_plate'=>'required',
        ]);

        if ($validator->fails()) {
            $request->session()->flash('message.level', 'danger');
            $request->session()->flash('message.content', $validator->errors());
            return Redirect::back()->withErrors($validator->errors());

        }
        $data = [
            'number_plate'=> $request->number_plate,
            'attendant_name'=>Session::get('user_full_name'),
            'attendant_id'=>Session::get('user_id')
        ];

        $response = json_decode(Http::post($url,$data)->body());
        return response()->json($response);
//
//
//
//        if($response->status == 200) {
//            $request->session()->flash('message.level', 'success');
//            $request->session()->flash('message.content', $response->message);
//            return redirect()->back()->withErrors($response->message);
//        }else{
//            $request->session()->flash('message.level', 'danger');
//            $request->session()->flash('message.content', $response->message);
//            return redirect()->back()->withErrors($response->message);
//        }


    }

    //Parking status
    public function parkingstatus(){
        if (Session::get('is_login') != 1) {
            Session::put('url', url()->current());
            return redirect()->route('login');
        }
        return view('status.status');

    }
    public function chackstatus(Request $request){
        $url = config('base.main_URL').'/parking/status';

        $formData = $request->all();
        $validator = Validator::make($formData,[
            'number_plate'=>'required',
        ]);

        if ($validator->fails()) {
            $request->session()->flash('message.level', 'danger');
            $request->session()->flash('message.content', $validator->errors());
            return Redirect::back()->withErrors($validator->errors());

        }
        $data = [
            'number_plate'=> $request->number_plate,
            'attendant_name'=>Session::get('user_full_name'),
            'attendant_id'=>Session::get('user_id')
        ];
        $response = json_decode(Http::post($url,$data)->body());

        if($response->status == 200) {
            $request->session()->flash('message.level', 'success');
            $request->session()->flash('message.content', $response->message);
            return redirect()->back()->withErrors($response->message);
        }else{
            $request->session()->flash('message.level', 'danger');
            $request->session()->flash('message.content', $response->message);
            return redirect()->back()->withErrors($response->message);
        }


    }

    //waiver
    public function waiver(){
        if (Session::get('is_login') != 1) {
            Session::put('url', url()->current());
            return redirect()->route('login');
        }
        return view('waiver.waiver');

    }

    //waiver
    public function payments(){
        if (Session::get('is_login') != 1) {
            Session::put('url', url()->current());
            return redirect()->route('login');
        }
        return view('payments.payments');

    }



    public function waiverpenalties(Request $request){
        $url = config('base.main_URL').'/parking/waiver';

        $formData = $request->all();
        $validator = Validator::make($formData,[
            'reference'=>'required',
            'number_plate'=>'required',
            'amount_waivered'=>'required',
            'transaction_date'=>'required',
        ]);

        if ($validator->fails()) {
            $request->session()->flash('message.level', 'danger');
            $request->session()->flash('message.content', $validator->errors());
            return Redirect::back()->withErrors($validator->errors());

        }
        $data = [
            'reference'=> $request->reference,
            'number_plate'=> $request->number_plate,
            'amount_waivered'=> $request->amount_waivered,
            'transaction_date'=> $request->transaction_date,
        ];
        $response = json_decode(Http::post($url,$data)->body());

        if($response->status == 200) {
            $request->session()->flash('message.level', 'success');
            $request->session()->flash('message.content', $response->message);
            return redirect()->back()->withErrors($response->message);
        }else{
            $request->session()->flash('message.level', 'danger');
            $request->session()->flash('message.content', $response->message);
            return redirect()->back()->withErrors($response->message);
        }


    }
    public function postpayments(Request $request){
        $url = config('base.main_URL').'/parking/payment';

        $formData = $request->all();
        $validator = Validator::make($formData,[
            'reference'=>'required',
            'number_plate'=>'required',
            'amount_paid'=>'required',
            'transaction_date'=>'required',
        ]);

        if ($validator->fails()) {
            $request->session()->flash('message.level', 'danger');
            $request->session()->flash('message.content', $validator->errors());
            return Redirect::back()->withErrors($validator->errors());

        }
        $data = [
            'reference'=> $request->reference,
            'number_plate'=> $request->number_plate,
            'amount_paid'=> $request->amount_paid,
            'transaction_date'=> $request->transaction_date,
        ];
        $response = json_decode(Http::post($url,$data)->body());

        if($response->status == 200) {
            $request->session()->flash('message.level', 'success');
            $request->session()->flash('message.content', $response->message);
            return redirect()->back()->withErrors($response->message);
        }else{
            $request->session()->flash('message.level', 'danger');
            $request->session()->flash('message.content', $response->message);
            return redirect()->back()->withErrors($response->message);
        }


    }













}
