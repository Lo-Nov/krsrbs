<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class GSPDashboard extends Controller
{
    public function __construct()
    {
        if (Session::get('is_login') != 1) {
            Session::put('url', url()->current());
            return redirect()->route('login');
        }

    }

    public function dashboard(){
        $url = config('base.main_URL').'/parking/reporting/dashboard';

        $this->data['dashboard'] = json_decode(Http::get($url)->body());

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

    //Checkin
    public function checkin(){
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
        return view('checkout.checkout');

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

    //Parking status
    public function parkingstatus(){
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
        return view('waiver.waiver');

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













}
