@extends('home.layouts.master')
@push('styles')
<link rel="stylesheet" href="{{asset('/home/css/animation.css')}}">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/leaflet@1.9.4/dist/leaflet.css">
@endpush
@section('content')
<div id="map" class="max-w-full mx-auto  rounded-lg border border-gray-300 shadow-lg z-10 h-[200px] sm:h[280px] md:h-[300px]"></div>

<!-- Filter Section (Below Map) -->
<div class="flex justify-center mx-auto mt-8 mb-4 px-4 ">
   <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-1 sm:gap-2 lg:gap-4 justify-items-center w-full max-w-7xl text-sm">
       <!-- Division Select -->
       <select id="division-select" class="text-center p-1 border border-[#1B266B] text-[#1B266B]  w-full sm:w-auto lg:w-full h-[40px] transition duration-300" onchange="populateDistricts(); filterStores()">
           <option value="" class="text-[#1B266B]">বিভাগ বাছাই করুন</option>
       </select>

       <!-- District Select -->
       <select id="district-select" class="text-center p-1 border border-[#1B266B] text-[#1B266B]  w-full sm:w-auto lg:w-full h-[40px] transition duration-300" disabled onchange="populateSubdistricts(); filterStores()">
           <option value="" class="text-[#1B266B] ">জেলা বাছাই করুন</option>
       </select>

       <!-- Sub-District Select -->
       <select id="subdistrict-select" class="text-center p-1 border border-[#1B266B] text-[#1B266B]  w-full sm:w-auto lg:w-full h-[40px] transition duration-300" disabled onchange="filterStores()">
           <option value="" class="text-[#1B266B] ">উপজেলা বাছাই করুন</option>
       </select>

        <!-- All Stores Button -->
       <button onclick="showAllStores()" class="hidden px-6 py-3 text-sm text-[#1B266B]  w-full sm:w-auto lg:w-full bg-gradient-to-r from-green-400 via-yellow-500 to-yellow-600 hover:from-green-500 hover:via-yellow-600 hover:to-yellow-700  transition duration-300 ease-in-out h-10">
           সবগুলো একসাথে দেখুন
       </button> 
   </div>
</div>






<!-- Store Locator Table -->
<div class="mt-6 lg:mt-12 md:mt-16 bg-[#eaf4fb] shadow-lg text-[#1B266B] inline-block  px-2 relative border-right-radius overflow-hidden">
    <p class="text-xl md:text-2xl lg:text-3xl ml-2 font-bold pr-12 py-3 z-10 relative">
        সেলস/হাব পয়েন্ট
    </p>
    <div class="absolute bg-gr1 h-full top-0 w-[50px] left-1 animate-move"></div>
    <div class="w-3 h-3 rounded-full absolute bg-[#1B266B] top-5 md:top-6 right-5"></div>
</div>
<table style="border:1px solid #1B266B;" class=" w-full sm:w-[98%]  mx-auto table-auto bg-gradient-to-r from-gray-300 via-white to-white shadow-md  border-collapse mt-5 mb-2 overflow-x-auto">
    <thead class="text-xs sm:text-md lg:text-lg text-[#1B266B]">
        <tr class="bg-[tomato] text-center ">
            <th class="p-1 border-b">দোকানের নাম</th>
            <th class="p-1 border-b">ঠিকানা</th>
            <th class="p-1 border-b">মোবাইল নাম্বার</th>
            <th class="p-1 border-b">ম্যাপ</th>
        </tr>
    </thead>
    <tbody id="store-list-body" class="text-xs sm:text-sm md:text-md lg:text-lg text-[#1B266B] font-nikosh">
        <!-- Store list will be generated here -->
       
    </tbody>
</table>
@endsection
@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/leaflet@1.9.4/dist/leaflet.js"></script>
<script src="{{asset('/home/js/map.js')}}"></script>
@endpush