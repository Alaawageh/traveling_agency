<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Country;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class TravelingController extends Controller
{
    public function index($id)
    {
        $countryCities = City::where('country_id',$id)->count();
        $country = Country::find($id);
        $cities = City::select()->orderBy('id','desc')->take(5)->where('country_id',$id)->get();
        return view('traveling.about',compact('countryCities','country','cities'));
    }
    public function makeReservations($id)
    {
        $city = City::find($id);
        return view('traveling.reservation',compact('city'));

    }
    public function storeReservations(Request $request , $id){
        $city = City::find($id);
        if($request->check_in_date > date('Y-m-d')) {
            $reservation = Reservation::create([
                'name' => $request->name,
                'phone_number' => $request->phone_number,
                'num_guests' => $request->num_guests,
                'check_in_date' => $request->check_in_date,
                'destination' => $city->name,
                'price' => intval($city->price) * intval($request->num_guests),
                'user_id' => Auth::user()->id
            ]); 
            if($reservation){
                $price = Session::put('price', $city->price * $request->num_guests);
                $newPrice = Session::get($price);
                return Redirect::route('traveling.pay');
            }
        }else{
            echo " invalide date ,you need to choose a date in the future";
        }

    }
    public function deals()
    {
        $countries = Country::all();
        $cities = City::select()->orderBy('id','desc')->take(4)->get();
        return view('traveling.deals',compact('countries','cities'));
    }
    public function search(Request $request)
    {
        $countries = Country::all();
        $cities = City::where('country_id',$request->get('country_id'))
        ->where('price','<=',$request->get('price'))
        ->orderBy('id','desc')->take(4)
        ->get();
        return view('traveling.search',compact('countries','cities'));
    }
    public function pay()
    {
        return view('traveling.pay');
    }
    public function success()
    {
        Session::forget('price');
        return view('traveling.success');
    }
}
