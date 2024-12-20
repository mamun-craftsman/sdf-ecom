<form id="farmer-form" class="w-full" action="{{ route('farmers.store') }}" method="post">
    @csrf
    <h3 class="text-gray-800 text-2xl font-bold mb-8">কৃষক অ্যাকাউন্ট রেজিস্ট্রেশন</h3>
    <div class="space-y-6">
        <!-- Name -->
        <div>
            <label class="text-gray-800 text-sm mb-2 block" for="name">নাম</label>
            <input type="text" id="name" name="name" required
                class="bg-white border w-full text-sm text-gray-800 px-4 py-2.5 rounded-md"
                placeholder="আপনার নাম লিখুন" />
        </div>

        <!-- Mobile Number -->
        <div>
            <label class="text-gray-800 text-sm mb-2 block" for="mobile_number">মোবাইল নম্বর</label>
            <input type="tel" id="mobile_number" name="mobile_number" required
                class="bg-white border w-full text-sm text-gray-800 px-4 py-2.5 rounded-md"
                placeholder="আপনার মোবাইল নম্বর লিখুন" />
        </div>

        <!-- Division -->
        <div>
            <label class="text-gray-800 text-sm mb-2 block" for="division">বিভাগ</label>
            <select id="division" name="division" required
                class="bg-white border w-full text-sm text-gray-800 px-4 py-2.5 rounded-md">
                <option value="">বিভাগ নির্বাচন করুন</option>
                @foreach ($divisions as $division)
                    <option value="{{ $division->id }}">{{ $division->bn_name }}</option>
                @endforeach
            </select>
        </div>

        <!-- District -->
        <div>
            <label class="text-gray-800 text-sm mb-2 block" for="district">জেলা</label>
            <select id="district" name="district" required
                class="bg-white border w-full text-sm text-gray-800 px-4 py-2.5 rounded-md">
                <option value="">জেলা নির্বাচন করুন</option>
                <!-- Add districts dynamically based on the selected division (this can be done using JavaScript or back-end logic) -->


            </select>
        </div>

        <!-- Sub-district -->
        <div>
            <label class="text-gray-800 text-sm mb-2 block" for="sub_district">উপজেলা</label>
            <select id="sub_district" name="sub_district" required
                class="bg-white border w-full text-sm text-gray-800 px-4 py-2.5 rounded-md">
                <option value="">উপজেলা নির্বাচন করুন</option>
                <!-- Add sub-districts dynamically based on the selected district (this can be done using JavaScript or back-end logic) -->
                <option value="Mirpur">মিরপুর</option>
                <option value="Demo Upazilla">ডেমো উপজেলা</option>

            </select>
        </div>

        <div>
            <label class="text-gray-800 text-sm mb-2 block" for="assets">সরবরাহ করতে পারবেন-</label>
            <div class="flex flex-col gap-2 text-base">
                <!-- ফসলি পন্য -->
                <label class="flex items-center gap-3 cursor-pointer group">
                    <input type="checkbox" name="assets[]" value="ফসলি পন্য" class="hidden peer" />
                    <div class="w-5 h-5 border-2 border-gray-300 rounded-md flex items-center justify-center peer-checked:border-blue-500 peer-checked:bg-blue-500 transition">
                        <svg class="hidden w-4 h-4 text-white peer-checked:block" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                        </svg>
                    </div>
                    <span class="text-gray-600 group-hover:text-blue-500 transition">ফসলি পন্য</span>
                </label>
        
                <!-- খামারি পন্য -->
                <label class="flex items-center gap-3 cursor-pointer group">
                    <input type="checkbox" name="assets[]" value="খামারি পন্য" class="hidden peer" />
                    <div class="w-5 h-5 border-2 border-gray-300 rounded-md flex items-center justify-center peer-checked:border-blue-500 peer-checked:bg-blue-500 transition">
                        <svg class="hidden w-4 h-4 text-white peer-checked:block" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                        </svg>
                    </div>
                    <span class="text-gray-600 group-hover:text-blue-500 transition">খামারি পন্য(মৎস্য/গবাদিপশু)</span>
                </label>
        
                <!-- কুটির শিল্প -->
                <label class="flex items-center gap-3 cursor-pointer group">
                    <input type="checkbox" name="assets[]" value="কুটির শিল্প" class="hidden peer" />
                    <div class="w-5 h-5 border-2 border-gray-300 rounded-md flex items-center justify-center peer-checked:border-blue-500 peer-checked:bg-blue-500 transition">
                        <svg class="hidden w-4 h-4 text-white peer-checked:block" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                        </svg>
                    </div>
                    <span class="text-gray-600 group-hover:text-blue-500 transition">কুটির শিল্প</span>
                </label>
            </div>
        </div>
        

        <!-- Password -->
        <div>
            <label class="text-gray-800 text-sm mb-2 block" for="password">পাসওয়ার্ড</label>
            <input type="password" id="password" name="password" required autocomplete="new-password"
                class="bg-white border w-full text-sm text-gray-800 px-4 py-2.5 rounded-md"
                placeholder="পাসওয়ার্ড দিন" />
        </div>

        <!-- Confirm Password -->
        <div>
            <label class="text-gray-800 text-sm mb-2 block" for="password_confirmation">পাসওয়ার্ড নিশ্চিত করুন</label>
            <input type="password" id="password_confirmation" name="password_confirmation" required
                class="bg-white border w-full text-sm text-gray-800 px-4 py-2.5 rounded-md"
                placeholder="পাসওয়ার্ড নিশ্চিত করুন" />
        </div>
    </div>
    <!-- Agreement Checkbox -->
    <div class="flex items-center mt-4">
        <input id="agreement" name="agreement" type="checkbox"
            class="h-4 w-4 shrink-0 text-blue-600 focus:ring-blue-500 border-gray-300 rounded-md" required />
        <label for="agreement" class="text-gray-800 ml-3 block text-sm">
            আমি সকল <a href="condition.html" class="text-blue-600 font-semibold hover:underline ml-1">নীতিমালা ও
                শর্তাবলী</a> গ্রহণ করলাম
        </label>
    </div>
	<div class="mt-6 flex justify-end">
        <button type="submit" class="bg-blue-600 text-white px-2 py-1 rounded-lg">
            <span class="text-base">সাবমিট করুন</span>
        </button>
    </div>
</form>
