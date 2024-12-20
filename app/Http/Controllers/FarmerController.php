<?php

namespace App\Http\Controllers;

use App\Models\Farmer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use lemonpatwari\bangladeshgeocode\Models\Division;

class FarmerController extends Controller
{
    /**
     * Display the farmer's dashboard.
     */
    public function index()
    {
        $id = Auth::guard('farmer')->id();
        $farmer = Farmer::findOrFail($id);

        return view('farmer.index', compact('farmer'));
    }

    /**
     * Show the edit profile form.
     */
    public function edit()
    {
        $id = Auth::guard('farmer')->id();
        $farmer = Farmer::findOrFail($id);
        $divisions = Division::all();

        return view('farmer.edit', compact('farmer', 'divisions'));
    }

    /**
     * Update farmer profile.
     */
    public function update(Request $request)
    {
        $id = Auth::guard('farmer')->id();
        $farmer = Farmer::findOrFail($id);

        // Validate fields
        $validatedData = $request->validate([
            'address' => 'nullable|string|max:255',
            'nid' => 'nullable|string|max:50',
            'assets' => 'nullable|array',
            'image' => 'nullable|image|mimes:jpg,jpeg,png',
            'current_password' => 'nullable|string',
            'new_password' => 'nullable|string|min:6',
        ]);

        // Handle image upload
        if ($request->hasFile('image')) {
            if ($farmer->image) {
                Storage::disk('public')->delete($farmer->image);
            }
            $farmer->image = $request->file('image')->store('farmers', 'public');
        }

        // Update address and NID if provided
        if ($request->filled('address')) {
            $farmer->address = $request->address;
        }

        if ($request->filled('nid')) {
            $farmer->nid = $request->nid;
        }

        // Update assets
        $farmer->assets = $request->assets ?? $farmer->assets;

        // Handle password change
        if ($request->filled('new_password')) {
            if (!Hash::check($request->current_password, $farmer->password)) {
                return response()->json(['type' => 'error', 'message' => 'বর্তমান পাসওয়ার্ড ভুল দিয়েছেন'], 400);
            }

            $farmer->password = Hash::make($request->new_password);
        }

        $farmer->save();

        return response()->json(['type' => 'success', 'message' => 'প্রোফাইলের তথ্য আপডেট হয়েছে']);
    }

    /**
     * Store a newly created farmer.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'mobile_number' => 'required|string|max:15|unique:farmers,mobile_number',
            'division' => 'required|exists:divisions,id',
            'district' => 'required|exists:districts,id',
            'sub_district' => 'required|exists:thanas,id',
            'address' => 'nullable|string|max:255',
            'nid' => 'nullable|string|max:50',
            'assets' => 'nullable|array',
            'password' => 'required|string|min:6|confirmed',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $imagePath = null;

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('farmers', 'public');
        }

        $farmer = Farmer::create([
            'id' => preg_replace('/\s+/', '', $request->name) . $request->mobile_number,
            'name' => $request->name,
            'mobile_number' => $request->mobile_number,
            'division' => $request->division,
            'district' => $request->district,
            'sub_district' => $request->sub_district,
            'address' => $request->address,
            'nid' => $request->nid,
            'assets' => $request->assets ?? [],
            'password' => Hash::make($request->password),
            'payable' => 0.00,
            'due' => 0.00,
            'image' => $imagePath,
        ]);

        $farmer->assignRole('Farmer');

        Auth::guard('farmer')->login($farmer);

        return response()->json(['type' => 'success', 'message' => 'Registration successful!']);
    }
}
