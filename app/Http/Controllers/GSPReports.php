<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

class GSPReports extends Controller
{
    public function checkin(){

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

        return view('reports.checkin')->with($this->data);
    }
    public function checkout(){

        if (Session::get('is_login') != 1) {
            Session::put('url', url()->current());
            return redirect()->route('login');
        }
        $url = config('base.main_URL').'/parking/reporting/checkouts';

        $dt = Carbon::now();
        $dt->toDateString();

        $data=[
            'start_date'=> "",
            'end_date'=> ""
        ];

        $this->data['checkouts'] = json_decode(Http::post($url,$data)->body());

        //dd($this->data);

        return view('reports.checkout')->with($this->data);
    }
    public function waivers(){

        if (Session::get('is_login') != 1) {
            Session::put('url', url()->current());
            return redirect()->route('login');
        }
        $url = config('base.main_URL').'/parking/reporting/waivers';

        $dt = Carbon::now();
        $dt->toDateString();

        $data=[
            'start_date'=> "",
            'end_date'=> ""
        ];

        $this->data['waivers'] = json_decode(Http::post($url,$data)->body());

        //dd($this->data);

        return view('reports.waivers')->with($this->data);
    }

}
