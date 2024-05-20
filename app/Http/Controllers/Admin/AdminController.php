<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AddCity;
use App\Http\Requests\AddCountry;
use App\Models\Admin;
use App\Models\City;
use App\Models\Country;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;

class AdminController extends Controller
{
    public function viewLogin()
    {
        return view('admin.login');
    }
    public function CheckLogin(Request $request)
    {
        $remember_me = $request->has('remember_me') ? true : false;

        if (auth()->guard('admin')->attempt(['email' => $request->input("email"), 'password' => $request->input("password")], $remember_me)) {
            
            return redirect()->route('admin.dashboard');
        }
        return redirect()->back()->with(['error' => 'error logging in']);
    }
    public function index()
    {
        $countries = Country::select()->count();
        $cities = City::select()->count();
        $admins = Admin::select()->count();
        return view('admin.index',compact('countries','cities','admins'));
    }
    public function allAdmin()
    {
        $allAdmins = Admin::select()->orderBy('id','desc')->get();
        return view('admin.allAdmins',compact('allAdmins'));
    }
    public function createAdmin()
    {
        return view('admin.createAdmin');
    }
    public function storeAdmin(Request $request)
    {
        $admin = Admin::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        if($admin) {
            return Redirect::route('admin.all.admins')->with('success','Added Successfully');
        }
        return "Error";
    }
    public function allCountries()
    {
        $countries = Country::select()->orderBy('id','desc')->get();
        return view('admin.allCountries',compact('countries'));
    }
    public function createCountry()
    {
        return view('admin.createCountry');
    }
    public function storeCountry(AddCountry $request)
    {
        $path = '/assets/images';
        $NewImage = $request->image->getClientOriginalName();
        $request->image->move(public_path($path),$NewImage);
        $country = Country::create([
            'name' => $request->name,
            'image' => $NewImage,
            'population' => $request->population,
            'territory' => $request->territory,
            'avg_price' => $request->avg_price,
            'description' => $request->description,
            'continent' => $request->continent
        ]);
        if($country) {
            return Redirect::route('admin.all.countries')->with('success','Added Successfully');
        }
        return "Error";
    }
    public function deleteCountry($id)
    {
        $country = Country::find($id);
        if(File::exists(public_path('/assets/images/'.$country->image))){
            File::delete(public_path('/assets/images/'.$country->image));
        }
        $country->delete();
        return Redirect::route('admin.all.countries')->with('delete','Deleted Successfully');

    }
    public function allCities()
    {
        $cities = City::select()->orderBy('id','desc')->get();
        return view('admin.allCities',compact('cities')); 
    }
    public function createCity()
    {
        $countries = Country::all();
        return view('admin.createCity',compact('countries'));
    }
    public function storeCity(AddCity $request)
    {
        $path = '/assets/images';
        $NewImage = $request->image->getClientOriginalName();
        $request->image->move(public_path($path),$NewImage);
        $city = City::create([
            'name' => $request->name,
            'image' => $NewImage,
            'price' => $request->price,
            'num_days' => $request->num_days,
            'country_id' => $request->country_id,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude
        ]);
        if($city) {
            return Redirect::route('admin.all.cities')->with('success','Added Successfully');
        }
        return "Error";
    }
    public function deleteCity($id)
    {
        $city = City::find($id);
        if(File::exists(public_path('/assets/images/'.$city->image))){
            File::delete(public_path('/assets/images/'.$city->image));
        }
        $city->delete();
        return Redirect::route('admin.all.cities')->with('delete','Deleted Successfully');

    }

    public function allBookings()
    {
        $bookings = Reservation::select()->orderBy('id','desc')->get();
        return view('admin.allBookings',compact('bookings'));
    }
    public function editBooking($id)
    {
        $booking = Reservation::find($id);
        return view('admin.editBooking',compact('booking'));
    }
    public function updateBooking(Request $request , $id)
    {
        $booking = Reservation::find($id);
        $booking->update($request->only('status'));
        return Redirect::route('admin.all.bookings')->with('success','Updated Successfully');
    }

    public function deleteBooking($id)
    {
        $booking = Reservation::find($id);

        $booking->delete();
        return Redirect::route('admin.all.bookings')->with('delete','Deleted Successfully');

    }

}
