@extends('home.layouts.master')
@push('styles')
<link rel="stylesheet" href="{{asset('/home/css/animation.css')}}">
@endpush
@section('content')
<div class="flex items-center  p-2 sm:p-4 reg-bg h-full">
    <div class="w-full max-w-4xl max-md:max-w-xl mx-auto glass rounded-lg">
      <div class="grid md:grid-cols-2 gap-16 w-full sm:p-8 p-6 shadow-md rounded-md overflow-hidden">
        <!-- Left: Account Type Buttons -->
        <div class="account-buttons">
            <div class="md:mb-16 mb-8">
                <h3 class="text-gray-800 text-2xl font-bold">একাউন্টের ধরন</h3>
            </div>
        
            <div class="account-types bg-gray-100">
                <button data-type="farmer" class="load-form w-full px-5 py-2.5 flex items-center bg-[#D9EAF7] text-[#1B266B] hover:bg-[#ff9f22]">
                    <img src="{{asset('/home/images/farmer.svg.svg')}}" alt="farmer" class="w-[22px] mr-2">
                    কৃষক অ্যাকাউন্ট
                </button>
                <button data-type="agent" class="load-form w-full px-5 py-2.5 flex items-center hover:bg-[#ff9f22]">
                    <img src="{{asset('/home/images/man-using-laptop.svg')}}" alt="agent" class="w-[22px] mr-2">
                    এজেন্ট অ্যাকাউন্ট
                </button>
                <button data-type="business" class="load-form w-full px-5 py-2.5 flex items-center hover:bg-[#ff9f22]">
                    <img src="{{asset('/home/images/business-icon.svg')}}" alt="business" class="w-[22px] mr-2">
                    বিজনেস অ্যাকাউন্ট
                </button>
                <button data-type="customer" class="load-form w-full px-5 py-2.5 flex items-center hover:bg-[#ff9f22]">
                    <img src="{{asset('/home/images/woman-icon.svg')}}" alt="customer" class="w-[22px] mr-2">
                    কাস্টোমার অ্যাকাউন্ট
                </button>
            </div>
        </div>
  
        <!-- Right: Forms -->
        <div class="forms-container w-full">
        </div>
      </div>
    </div>
  </div>
@endsection
@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const formContainer = document.querySelector('.forms-container');

    // Function to load a form
    function loadForm(type) {
        formContainer.innerHTML = '<p>লোড হচ্ছে...</p>' // Show loading state

        fetch(`/form/${type}`)
            .then(response => response.json())
            .then(data => {
                if (data.html) {
                    formContainer.innerHTML = data.html // Load the form HTML
                    initializeDistrictScript(); // Initialize district & sub-district scripts
                } else {
                    formContainer.innerHTML = '<p>ফর্ম লোড করতে ব্যর্থ।</p>'
                }
            })
            .catch(error => {
                console.error('Error:', error);
                formContainer.innerHTML = '<p>ফর্ম লোড করতে ব্যর্থ।</p>'
            });
    }

    // Add click event listeners for the account type buttons
    document.querySelectorAll('.load-form').forEach(button => {
        button.addEventListener('click', function () {
            const type = this.getAttribute('data-type');
            loadForm(type);
        });
    });

    // Function to initialize district and sub-district scripts
    function initializeDistrictScript() {
        const divisionSelect = document.getElementById('division');
        const districtSelect = document.getElementById('district');
        const thanaSelect = document.getElementById('sub_district');

        if (divisionSelect) {
            divisionSelect.addEventListener('change', function () {
                const divisionId = this.value;
                districtSelect.innerHTML = '<option value="">জেলা নির্বাচন করুন</option>';

                if (divisionId) {
                    fetch(`/get-districts/${divisionId}`)
                        .then(response => response.json())
                        .then(data => {
                            data.forEach(district => {
                                const option = document.createElement('option');
                                option.value = district.id;
                                option.textContent = district.bn_name;
                                districtSelect.appendChild(option);
                            });
                        });
                }
            });
        }

        if (districtSelect) {
            districtSelect.addEventListener('change', function () {
                const districtId = this.value;
                thanaSelect.innerHTML = '<option value="">উপজেলা নির্বাচন করুন</option>';

                if (districtId) {
                    fetch(`/get-thanas/${districtId}`)
                        .then(response => response.json())
                        .then(data => {
                            data.forEach(thana => {
                                const option = document.createElement('option');
                                option.value = thana.id;
                                option.textContent = thana.bn_name;
                                thanaSelect.appendChild(option);
                            });
                        });
                }
            });
        }
    }

    // Initially load the farmer form
    loadForm('farmer')
});
</script>

@endpush

