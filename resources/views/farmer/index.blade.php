@extends('farmer.layouts.master')
@section('content')

<h1 class="text-2xl font-bold">Dashboard</h1>
<div class="mt-4 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
    <!-- Sample Cards -->
    <div class="bg-white p-4 rounded-lg shadow-md">
        <div class="font-semibold text-gray-700">Total Products</div>
        <div class="text-xl font-bold">15</div>
    </div>
    <div class="bg-white p-4 rounded-lg shadow-md">
        <div class="font-semibold text-gray-700">Pending Orders</div>
        <div class="text-xl font-bold">5</div>
    </div>
    <div class="bg-white p-4 rounded-lg shadow-md">
        <div class="font-semibold text-gray-700">Earnings</div>
        <div class="text-xl font-bold">$1,250</div>
    </div>
</div>

@endsection