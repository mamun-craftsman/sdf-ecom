@php
	use lemonpatwari\bangladeshgeocode\Models\Division;
	use lemonpatwari\bangladeshgeocode\Models\District;
	use lemonpatwari\bangladeshgeocode\Models\Thana;

	$division_name = Division::findOrFail($farmer->division)->bn_name;
	$district_name = District::findOrFail($farmer->district)->bn_name;
	$subdistrict_name = Thana::findOrFail($farmer->sub_district)->bn_name;

@endphp
@extends('farmer.layouts.master')
@section('content')
<h1 class="text-2xl font-bold mb-4">Edit Profile</h1>


<!-- Static Information Section -->
<div class="bg-[#353535] p-6 rounded-lg shadow-md mb-6 text-white">
    <h2 class="text-2xl font-semibold mb-4">Profile Information</h2>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div>
            <label class="block text-sm font-medium text-[#FF6B01]">Name</label>
            <p class="p-2 border border-[#FF6B01] rounded-md bg-[#4a4a4a]">{{ $farmer->name }}</p>
        </div>
        <div>
            <label class="block text-sm font-medium text-[#FF6B01]">Mobile Number</label>
            <p class="p-2 border border-[#FF6B01] rounded-md bg-[#4a4a4a]">{{ $farmer->mobile_number }}</p>
        </div>
		@if ($farmer->nid!=null)
			<div>
				<label class="block text-sm font-medium text-[#FF6B01]">National ID Card Number</label>
				<p class="p-2 border border-[#FF6B01] rounded-md bg-[#4a4a4a]">{{ $farmer->nid }}</p>
			</div>
		@endif
        <div>
            <label class="block text-sm font-medium text-[#FF6B01]">Division</label>
            <p class="p-2 border border-[#FF6B01] rounded-md bg-[#4a4a4a]">{{ $division_name}}</p>
        </div>
        <div>
            <label class="block text-sm font-medium text-[#FF6B01]">District</label>
            <p class="p-2 border border-[#FF6B01] rounded-md bg-[#4a4a4a]">{{ $district_name}}</p>
        </div>
        <div>
            <label class="block text-sm font-medium text-[#FF6B01]">Sub District</label>
            <p class="p-2 border border-[#FF6B01] rounded-md bg-[#4a4a4a]">{{ $subdistrict_name }}</p>
        </div>
		@if ($farmer->address!=null)
			<div>
				<label class="block text-sm font-medium text-[#FF6B01]">Detailed Address</label>
				<p class="p-2 border border-[#FF6B01] rounded-md bg-[#4a4a4a]">{{ $farmer->address }}</p>
			</div>
		@endif

        <div>
            <label class="block text-sm font-medium text-[#FF6B01]">Payable</label>
            <p class="p-2 border border-[#FF6B01] rounded-md bg-[#4a4a4a]">৳ {{ $farmer->payable }}</p>
        </div>
        <div>
            <label class="block text-sm font-medium text-[#FF6B01]">Due</label>
            <p class="p-2 border border-[#FF6B01] rounded-md bg-[#4a4a4a]">৳ {{ $farmer->due }}</p>
        </div>
    </div>
</div>


<form action="{{route('farmer.update')}}" method="post" id="profileForm" class="space-y-4" enctype="multipart/form-data">
    @csrf

    <!-- Editable Fields -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div>
            <label for="image" class="block text-sm font-medium text-gray-700">Profile Image</label>
            <input type="file" id="image" name="image" accept="image/*" class="mt-1 p-2 block w-full border rounded-md">
        </div>
		@if ($farmer->address==null)
		<div>
            <label for="address" class="block text-sm font-medium text-gray-700">Address</label>
            <input type="text" id="address" name="address" class="mt-1 p-2 block w-full border rounded-md" placeholder="গ্রাম/মৌজা/ওয়ার্ড">
        </div>
		@endif
        
		@if ($farmer->nid==null)
		<div>
            <label for="nid" class="block text-sm font-medium text-gray-700">NID</label>
            <input type="text" id="nid" name="nid" class="mt-1 p-2 block w-full border rounded-md" placeholder="জাতীয় পরিচয় পত্র ছাড়া ভেরিফিকেশন হবে না">
        </div>
		@endif

    </div>

    <div class="mt-4">
        <h2 class="text-xl font-semibold mb-2">Assets</h2>
        <div id="assetsContainer">
            @foreach(($farmer->assets ?? []) as $asset)
                <div class="flex items-center space-x-2 mb-2">
                    <input type="text" name="assets[]" class="p-2 block w-full border rounded-md" value="{{ $asset }}">
                    <button type="button" class="remove-asset bg-red-500 text-white px-2 rounded">&times;</button>
                </div>
            @endforeach
        </div>
        <button type="button" id="addAsset" class="bg-green-500 text-white px-4 py-2 rounded">Add Asset</button>
    </div>

    <!-- Password Section -->
    <div class="mt-6">
        <h2 class="text-xl font-semibold mb-4">Change Password</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label for="current_password" class="block text-sm font-medium text-gray-700">Current Password</label>
                <input type="password" id="current_password" name="current_password" class="mt-1 p-2 block w-full border rounded-md">
            </div>
            <div>
                <label for="new_password" class="block text-sm font-medium text-gray-700">New Password</label>
                <input type="password" id="new_password" name="new_password" class="mt-1 p-2 block w-full border rounded-md">
            </div>
            <div>
                <label for="confirm_password" class="block text-sm font-medium text-gray-700">Confirm New Password</label>
                <input type="password" id="confirm_password" name="confirm_password" class="mt-1 p-2 block w-full border rounded-md">
            </div>
        </div>
    </div>

    <button type="submit" class="bg-[#FF6B01] text-white px-4 py-2 rounded-md">Save Changes</button>
</form>
@endsection
@push('scripts')
<script>
    $(document).ready(function () {
        // Handle dynamic assets
        $('#addAsset').on('click', function () {
            $('#assetsContainer').append(`
                <div class="flex items-center space-x-2 mb-2">
                    <input type="text" name="assets[]" class="p-2 block w-full border rounded-md" placeholder="Enter asset">
                    <button type="button" class="remove-asset bg-red-500 text-white px-2 rounded">&times;</button>
                </div>
            `);
        });

        $(document).on('click', '.remove-asset', function () {
            $(this).closest('div').remove();
        });

        // Handle form submission with AJAX
        $('#profileForm').on('submit', function (e) {
            e.preventDefault();

            let formData = new FormData(this);

            $.ajax({
                url: "{{ route('farmer.update') }}",
                method: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function (response) {
					if (response.type === 'success') {
						toastr.success(response.message); // Use the message returned from the server
					} else {
						toastr.warning(response.message || 'Something went wrong!');
					}
				},
				error: function (xhr) {
					let errorMessage = 'Failed to update profile. Please try again.';
					if (xhr.responseJSON && xhr.responseJSON.message) {
						errorMessage = xhr.responseJSON.message; // Use the error message from the server
					}
					toastr.error(errorMessage);
				}

            });
        });
    });
</script>
@endpush
