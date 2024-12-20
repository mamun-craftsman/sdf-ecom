<form id="agent-form" class="w-full">
    <h3 class="text-gray-800 text-2xl font-bold mb-8">এজেন্ট অ্যাকাউন্ট রেজিস্ট্রেশন</h3>
    <div class="space-y-6">
        <!-- Name -->
        <div>
            <label class="text-gray-800 text-sm mb-2 block" for="name">এজেন্ট নাম</label>
            <input type="text" id="name" name="name" required
                class="bg-white border w-full text-sm text-gray-800 px-4 py-2.5 rounded-md"
                placeholder="এজেন্টের নাম লিখুন" />
        </div>

        <!-- Email -->
        <div>
            <label class="text-gray-800 text-sm mb-2 block" for="email">ইমেইল</label>
            <input type="email" id="email" name="email" required
                class="bg-white border w-full text-sm text-gray-800 px-4 py-2.5 rounded-md"
                placeholder="এজেন্টের ইমেইল লিখুন" />
        </div>

        <!-- Mobile Number -->
        <div>
            <label class="text-gray-800 text-sm mb-2 block" for="mobile_number">মোবাইল নম্বর</label>
            <input type="tel" id="mobile_number" name="mobile_number" required
                class="bg-white border w-full text-sm text-gray-800 px-4 py-2.5 rounded-md"
                placeholder="এজেন্টের মোবাইল নম্বর লিখুন" />
        </div>

        <!-- Division -->
        <div>
            <label class="text-gray-800 text-sm mb-2 block" for="division">বিভাগ</label>
            <select id="division" name="division" required
                class="bg-white border w-full text-sm text-gray-800 px-4 py-2.5 rounded-md">
                <option value="">বিভাগ নির্বাচন করুন</option>
                <option value="Dhaka">ঢাকা</option>
                <option value="Chittagong">চট্টগ্রাম</option>
                <option value="Rajshahi">রাজশাহী</option>
                <!-- Add more divisions as needed -->
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
            </select>
        </div>

        <!-- NID Number -->
        <div>
            <label class="text-gray-800 text-sm mb-2 block" for="nid_number">এনআইডি নম্বর</label>
            <input type="text" id="nid_number" name="nid_number" required
                class="bg-white border w-full text-sm text-gray-800 px-4 py-2.5 rounded-md"
                placeholder="এনআইডি নম্বর লিখুন" />
        </div>

        <!-- Job Type (Radio Buttons) -->
        <div>
            <label class="text-gray-800 text-sm mb-2 block">কাজের ধরন</label>
            <div class="space-x-4 text-sm">
                <label class="inline-flex items-center ">
                    <input type="radio" id="part_time" name="job_type" value="part_time" class="text-gray-800" />
                    <span class="ml-2">পার্ট-টাইম</span>
                </label>
                <label class="inline-flex items-center">
                    <input type="radio" id="full_time" name="job_type" value="full_time" class="text-gray-800" />
                    <span class="ml-2">ফুল-টাইম</span>
                </label>
            </div>
        </div>

        <!-- Availability (Time Range) -->
        <div>
            <label class="text-gray-800 text-sm mb-2 block" for="availability">প্রতিদিনের সময়</label>
            <div class="flex space-x-2">
                <!-- Start Time -->
                <input type="time" id="start_time" name="start_time" required
                    class="bg-white border w-32 text-sm text-gray-800 px-4 py-2.5 rounded-md" />
                <span class="text-gray-800 text-sm">থেকে</span>
                <!-- End Time -->
                <input type="time" id="end_time" name="end_time" required
                    class="bg-white border w-32 text-sm text-gray-800 px-4 py-2.5 rounded-md" />
                <span class="text-gray-800 text-sm">পর্যন্ত</span>
            </div>
        </div>

        <!-- Password -->
        <div>
            <label class="text-gray-800 text-sm mb-2 block" for="password">পাসওয়ার্ড</label>
            <input type="password" id="password" name="password" required
                class="bg-white border w-full text-sm text-gray-800 px-4 py-2.5 rounded-md"
                placeholder="পাসওয়ার্ড লিখুন" />
        </div>

        <!-- Confirm Password -->
        <div>
            <label class="text-gray-800 text-sm mb-2 block" for="confirm_password">পাসওয়ার্ড নিশ্চিত করুন</label>
            <input type="password" id="confirm_password" name="confirm_password" required
                class="bg-white border w-full text-sm text-gray-800 px-4 py-2.5 rounded-md"
                placeholder="পাসওয়ার্ড নিশ্চিত করুন" />
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
</form>
