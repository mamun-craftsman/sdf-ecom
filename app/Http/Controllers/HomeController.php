<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Farmer;
use lemonpatwari\bangladeshgeocode\Models\Division;



class HomeController extends Controller
{
    public function index()
    {
        return view('home.index');
    }

    public function about()
    {
        return view('home.about');
    }

    public function contact()
    {
        return view('home.contact');
    }
    public function hubpoint() {
        return view('home.hubpoint');
    }
    public function registration() {
        return view('home.registration');
    }
    public function login() {
        return view('home.login');
    }
    public function registerFarmer(Request $request)
    {
        // Validate the incoming request data
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'mobile_number' => 'required|unique:farmers',
            'division' => 'required|string|max:255',
            'district' => 'required|string|max:255',
            'sub_district' => 'required|string|max:255',
            'password' => 'required|string|min:8|confirmed',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors()->first(),
            ]);
        }

        // Store the new farmer
        $farmer = Farmer::create([
            'name' => $request->name,
            'mobile_number' => $request->mobile_number,
            'division' => $request->division,
            'district' => $request->district,
            'sub_district' => $request->sub_district,
            'password' => bcrypt($request->password),
            'verified' => false, // Default to false
        ]);

        $farmer->assignRole('Farmer');
        // Return success response
        return response()->json([
            'status' => 'success',
            'message' => 'Farmer registration successful!',
        ]);
    }
}
