@extends('home.layouts.master')
@push('styles')
<link rel="stylesheet" href="{{asset('/home/css/slider.css')}}">
<link rel="stylesheet" href="{{asset('/home/css/animation.css')}}">
@endpush
@section('content')
<section class="hero-slider hero-style w-full sm:w-[98%] md:w-[95%]">
    <div class="swiper-container">
      <div class="swiper-wrapper">


        <div class="swiper-slide">
          <div class="slide-inner slide-bg-image"
            data-background="{{asset('/home/images/slide-2.jpg')}}">
            <div class="container lg:pl-10">
              <div data-swiper-parallax="300" class="slide-title">
                <p class="text-xl">কৃষকদের ক্ষেত থেকে</p>
              </div>
              <div data-swiper-parallax="400" class="slide-text">
                <p class="font-nakkh">যাচাই বাছাই করে সংগৃহীত প্রতিটা পন্য ১০০% ফ্রেশ</p>
              </div>
              <div class="clearfix"></div>
              <div data-swiper-parallax="500" class="slide-btns font-shishir">
                <a href="#" class="theme-btn-s2">এখনই কিনুন</a>
                <a href="#" class="theme-btn-s3"><i class="fas fa-chevron-circle-right"></i>সংগ্রহের অথ্য</a>
              </div>
            </div>
          </div>
          <!-- end slide-inner -->
        </div>
        <!-- end swiper-slide -->

        <div class="swiper-slide">
          <div class="slide-inner slide-bg-image" data-background="{{asset('/home/images/slide-1.jpg')}}">
            <div class="container">
              <div data-swiper-parallax="300" class="slide-title">
                <h2 class="text-[#1B266B]">স্বল্প দামে সকল পন্য</h2>
              </div>
              <div data-swiper-parallax="400" class="slide-text">
                <p class="text-[black]">সারাদেশে রয়েছে আমাদের হাব</p>
              </div>
              <div class="clearfix"></div>
              <div data-swiper-parallax="500" class="slide-btns font-shishir">
                <a href="#" class="theme-btn-s2">হাব সমূহের ঠিকানা</a>
                <a href="#" class="theme-btn-s3"><i class="fas fa-chevron-circle-right"></i>কিভাবে দাম কম?</a>
              </div>
            </div>
          </div>
          <!-- end slide-inner -->
        </div>
        <!-- end swiper-slide -->


      </div>
      <!-- end swiper-wrapper -->

      <!-- swipper controls -->
      <div class="swiper-pagination"></div>
      <div class="swiper-button-next"></div>
      <div class="swiper-button-prev"></div>
    </div>
  
  </section>

  <div id="productModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
      <!-- Modal Content -->
      <div class="bg-white p-6 rounded-lg shadow-lg relative -translate-y-1 w-[300px] md:w-[500px] max-w-full h-[550px] md:h-[530px]">
        <button id="closeModal" class="absolute top-3 right-3 text-gray-500 hover:text-gray-800 text-2xl font-bold">
          &times;
        </button>
        <img id="modalImage" class="w-full h-[250px] object-contain rounded-lg mb-4" src="" alt="Product Image">
        <h3 id="modalTitle" class="text-lg font-bold mb-2"></h3>
        <p id="modalDescription" class="text-lg text-gray-600 mb-4"></p>
        <p id="modalPrice" class="text-xl font-semibold text-green-600 hidden"></p>
        <div class="flex gap-5">
          <button
          id="buyNowButton"
        class="inline-flex flex-1 w-full mt-10 items-center justify-center h-12 px-4 text-lg font-medium text-white font-nakkh transition-transform transform bg-gradient-to-br from-cyan-500 to-blue-500 rounded-lg shadow-[rgba(45,35,66,0.4)_0px_2px_4px,rgba(45,35,66,0.3)_0px_7px_13px_-3px,rgba(58,65,111,0.5)_0px_-3px_0px_inset] font-[JetBrains_Mono] hover:shadow-[rgba(45,35,66,0.4)_0px_0px_0px,rgba(45,35,66,0.3)_0px_1px_1px_-3px,#3c4fe0_0px_-2px_0px_inset] hover:-translate-y-0.5 active:shadow-[#3c4fe0_0px_3px_7px_inset] active:translate-y-0.5"
        role="button"
        >
        এখনই কিনুন   </button>
<a href="/product-details.html" class="flex-1">
  <button
          
  class="inline-flex w-full mt-10 items-center justify-center h-12 px-4 text-lg font-medium text-white font-nakkh transition-transform transform bg-gradient-to-br from-blue-500 to-green-500 rounded-lg shadow-[rgba(45,35,66,0.4)_0px_2px_4px,rgba(45,35,66,0.3)_0px_7px_13px_-3px,rgba(58,65,111,0.5)_0px_-3px_0px_inset] font-[JetBrains_Mono] hover:shadow-[rgba(45,35,66,0.4)_0px_0px_0px,rgba(45,35,66,0.3)_0px_1px_1px_-3px,#3c4fe0_0px_-2px_0px_inset] hover:-translate-y-0.5 active:shadow-[#3c4fe0_0px_3px_7px_inset] active:translate-y-0.5"
  role="button"
  >
  বিস্তারিত
  </button>
</a>
      </div>
    </div>
  </div>

  <!--categories-->
  <div class="mt-6 lg:mt-12 md:mt-16 bg-[#eaf4fb] shadow-lg text-[#1B266B] inline-block  px-2 relative border-right-radius overflow-hidden">
      <p class="text-xl md:text-2xl lg:text-3xl ml-2 font-bold pr-12 py-3 z-10 relative">
          ক্যাটেগরিসমূহ
      </p>
      <div class="absolute bg-gr1 h-full top-0 w-[50px] left-1 animate-move"></div>
      <div class="w-3 h-3 rounded-full absolute bg-[#1B266B] top-5 md:top-6 right-5"></div>
  </div>
  <section class="px-2 md:px-12">
      
    <div
      class=" mx-auto  md:max-w-3xl sm:max-w-full lg:max-w-[100vw] relative lg:my-8 lg:mx-12"
    >
     
      <div id="category" class="grid grid-cols-3 sm:grid-cols-4 md:grid-cols-6 lg:grid-cols-8 gap-4 lg:gap-10 place-items-center">
          <div class="w-[120px] h-[120px]px-1 py-2 border border-[#1B266B] rounded-lg shadow-lg">
              <img src="{{asset('/home/images/vegetables.png')}}" alt="kancha_bazaar" class="w-full h-[80px]">
              <p class="text-xs text-center">কাঁচা বাজার</p>
          </div>
          <div class="w-[120px] h-[120px]px-1 py-2 border border-[#1B266B] rounded-lg shadow-lg">
              <img src="{{asset('/home/images/fishes.png')}}" alt="maach" class="w-full h-[80px]">
              <p class="text-xs text-center">মাছ</p>
          </div>
          <div class="w-[120px] h-[120px]px-1 py-2 border border-[#1B266B] rounded-lg shadow-lg">
              <img src="{{asset('/home/images/meat.png')}}" alt="meat" class="w-full h-[80px]">
              <p class="text-xs text-center">মাংস</p>
          </div>
          <div class="w-[120px] h-[120px]px-1 py-2 border border-[#1B266B] rounded-lg shadow-lg">
              <img src="{{asset('/home/images/egg-c.png')}}" alt="eggs" class="w-full h-[80px]">
              <p class="text-xs text-center">ডিম</p>
          </div>
          <div class="w-[120px] h-[120px]px-1 py-2 border border-[#1B266B] rounded-lg shadow-lg">
              <img src="{{asset('/home/images/dairy-products.png')}}" alt="dairy" class="w-full h-[80px]">
              <p class="text-xs text-center">দুগ্ধজাত পণ্য</p>
          </div>
      </div>
      <div class="load-btn mt-10 w-full flex justify-center">
          <button onclick="javascript(0)" class="border border-[black] px-3 py-1 text-[#ff9f22] rounded-lg bg-[#1B266B] hover:opacity-90">সব পণ্য /শপ পেইজ</button>
      </div>
    </div>
   


  </section>

  <div class="flex mt-6 justify-end item-center max-w-screen">
      <img class="object-cover md:hidden  w-full h-44" src="https://bangladeshpost.net/webroot/uploads/featureimage/2022-07/62d1bc6a633b2.jpg" alt="background">
      <img class="hidden md:block object-cover  w-full h-44" src="https://t3.ftcdn.net/jpg/08/08/25/94/360_F_808259433_2VvCmkc18Sk1pZIi8joJjrVvjSxsDkA2.jpg" alt="background">
      <div class=" px-1 sm:px-2 py-2 flex xl:px-20 justify-center items-start flex-col absolute gap-2">
          <h1 class="text0-xl xl:text-2xl font-medium xl:leading-normal text-[#1B266B] pr-2 font-bold">এখনই রেজিস্ট্রেশন করুন</h1>
          <p class="w-full text-base  xl:leading-none text-white pr-2" >১। ফসল/পন্য বিক্রির জন্য  <a href="#" class="underline underline-offset-4 text-[#fff1b]" >কৃষক অ্যাকাউন্ট</a></p>
          <p class="w-full text-base  xl:leading-none text-white pr-2" >২। কৃষকের থেকে পন্য সংগ্রহ/সংরক্ষণের কাজে  <a href="#" class="underline underline-offset-4 text-[#fff1b]">এজেন্ট অ্যাকাউন্ট</a></p>
          <p class="w-full text-base  xl:leading-none text-white pr-2" >৩। ক্ষুদ্র/মাঝারি ব্যবসায়ী হিসেবে <a href="#" class="underline underline-offset-4 text-[#fff1b]">বিজনেস অ্যাকাউন্ট</a></p>
          <p class="w-full text-base  xl:leading-none text-white pr-2" >4। সাধারণ ভোক্তা/ক্রেতা হিসেবে  <a href="#" class="underline underline-offset-4 text-[#fff1b]" >জেনারেল অ্যাকাউন্ট</a></p>

      </div>
      
  </div>

  <!--products-->
  <div class="mt-6 lg:mt-12 md:mt-16 bg-[#eaf4fb] shadow-lg text-[#1B266B] inline-block  px-2 relative border-right-radius overflow-hidden">
      <p class="text-xl md:text-2xl lg:text-3xl ml-2 font-bold pr-12 py-3 z-10 relative">
          সেরা পণ্য, সেরা অফার
      </p>
      <div class="absolute bg-gr1 h-full top-0 w-[50px] left-1 animate-move"></div>
      <div class="w-3 h-3 rounded-full absolute bg-[#1B266B] top-5 md:top-6 right-5 baka"></div>
  </div>
  <section class="px-2 md:px-12">
      
    <div
      class=" mx-auto  md:max-w-3xl sm:max-w-full lg:max-w-[100vw] relative lg:my-8 lg:mx-12"
    >
      
      <div id="gtid-present" class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-4 lg:gap-10 place-items-center">
      </div>
      <div class="load-btn mt-10 w-full flex justify-center">
          <button onclick="javascript(0)" class="border border-[black] px-3 py-1 text-[#ff9f22] rounded-lg bg-[#1B266B] hover:opacity-90">আরো দেখুন</button>
      </div>
    </div>


  </section>
@endsection
@push('scripts')
<script src="{{asset('/home/js/sliderCustom.js')}}"></script>
@endpush