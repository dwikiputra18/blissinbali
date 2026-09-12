@extends('layouts.front')

@section('title', 'Rent ' . $carRental->name . ' - Checkout')

@push('styles')
{{-- Library Flatpickr untuk kalender range --}}
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<style>
    /* Kustomisasi tampilan agar mirip seperti gambar yang Anda berikan */
    .flatpickr-day.selected, .flatpickr-day.startRange, .flatpickr-day.endRange, 
    .flatpickr-day.selected.inRange, .flatpickr-day.startRange.inRange, 
    .flatpickr-day.endRange.inRange {
        background: #172554 !important;
        border-color: #172554 !important;
    }
    .flatpickr-day.inRange {
        box-shadow: -5px 0 0 #172554, 5px 0 0 #172554 !important;
        background: #172554 !important;
        color: #ffffff !important;
    }
</style>
@endpush

@section('content')
<div class="pt-24 pb-16 bg-gray-50 min-h-screen">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center gap-3 mb-8">
            <a href="{{ route('car-rental.index') }}"
                class="w-10 h-10 bg-white rounded-full flex items-center justify-center text-gray-500 hover:text-yellow-600 shadow-sm transition-colors">
                <i class="fas fa-arrow-left"></i>
            </a>
            <h1 class="text-3xl font-bold text-gray-800 brand-font">Car Booking Process</h1>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            {{-- Bagian Kiri: Form --}}
            <div class="lg:col-span-2 space-y-6">
                <form id="carCheckoutForm" action="{{ route('car-rental.checkout.process', $carRental) }}" method="POST"
                    class="bg-white rounded-2xl shadow-sm p-8">
                    @csrf

                    <h2 class="text-xl font-bold text-gray-800 mb-6 border-b border-gray-100 pb-3">Renter Information</h2>

                    <div class="space-y-6">
                        {{-- Full Name dengan spasi depan --}}
                        <div class="mt-4">
                            <label class="block text-sm font-medium text-gray-700 mb-1 pl-1">Full Name</label>
                            <input type="text" name="name" required
                                class="w-full rounded-xl border-gray-300 focus:border-yellow-500 focus:ring-yellow-500"
                                placeholder="As per ID Card/Passport">
                            @error('name')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                        </div>

                        {{-- Email dengan spasi depan --}}
                        <div class="mt-4">
                            <label class="block text-sm font-medium text-gray-700 mb-1 pl-1">Email</label>
                            <input type="email" name="email" required
                                class="w-full rounded-xl border-gray-300 focus:border-yellow-500 focus:ring-yellow-500"
                                placeholder="nama@email.com">
                            @error('email')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                        </div>
                        {{-- WhatsApp / Phone Number --}}
                        <div class="mt-4">
                            <label class="block text-sm font-medium text-gray-700 mb-1 pl-1">WhatsApp / Phone Number</label>
                            <div class="flex gap-2">
                                <select name="country_code"
                                    class="w-1/3 border border-gray-300 rounded-xl px-2 py-2 focus:border-yellow-500 focus:ring-yellow-500 text-xs sm:text-sm bg-gray-50">
                                    <optgroup label="🌏 Asia">
                                        <option value="+62" selected>+62 (Indonesia)</option>
                                        <option value="+91">+91 (India)</option>
                                        <option value="+60">+60 (Malaysia)</option>
                                        <option value="+65">+65 (Singapore)</option>
                                        <option value="+66">+66 (Thailand)</option>
                                        <option value="+63">+63 (Philippines)</option>
                                        <option value="+84">+84 (Vietnam)</option>
                                        <option value="+855">+855 (Cambodia)</option>
                                        <option value="+856">+856 (Laos)</option>
                                        <option value="+95">+95 (Myanmar)</option>
                                        <option value="+673">+673 (Brunei)</option>
                                        <option value="+86">+86 (China)</option>
                                        <option value="+852">+852 (Hong Kong)</option>
                                        <option value="+853">+853 (Macau)</option>
                                        <option value="+886">+886 (Taiwan)</option>
                                        <option value="+81">+81 (Japan)</option>
                                        <option value="+82">+82 (South Korea)</option>
                                        <option value="+850">+850 (North Korea)</option>
                                        <option value="+94">+94 (Sri Lanka)</option>
                                        <option value="+880">+880 (Bangladesh)</option>
                                        <option value="+92">+92 (Pakistan)</option>
                                        <option value="+977">+977 (Nepal)</option>
                                        <option value="+975">+975 (Bhutan)</option>
                                        <option value="+960">+960 (Maldives)</option>
                                        <option value="+93">+93 (Afghanistan)</option>
                                        <option value="+98">+98 (Iran)</option>
                                        <option value="+964">+964 (Iraq)</option>
                                        <option value="+963">+963 (Syria)</option>
                                        <option value="+961">+961 (Lebanon)</option>
                                        <option value="+962">+962 (Jordan)</option>
                                        <option value="+972">+972 (Israel)</option>
                                        <option value="+970">+970 (Palestine)</option>
                                        <option value="+966">+966 (Saudi Arabia)</option>
                                        <option value="+971">+971 (UAE)</option>
                                        <option value="+968">+968 (Oman)</option>
                                        <option value="+967">+967 (Yemen)</option>
                                        <option value="+973">+973 (Bahrain)</option>
                                        <option value="+974">+974 (Qatar)</option>
                                        <option value="+965">+965 (Kuwait)</option>
                                        <option value="+90">+90 (Turkey)</option>
                                        <option value="+7">+7 (Kazakhstan)</option>
                                        <option value="+998">+998 (Uzbekistan)</option>
                                        <option value="+993">+993 (Turkmenistan)</option>
                                        <option value="+996">+996 (Kyrgyzstan)</option>
                                        <option value="+992">+992 (Tajikistan)</option>
                                        <option value="+976">+976 (Mongolia)</option>
                                    </optgroup>
                                    <optgroup label="🌍 Europe">
                                        <option value="+44">+44 (United Kingdom)</option>
                                        <option value="+353">+353 (Ireland)</option>
                                        <option value="+33">+33 (France)</option>
                                        <option value="+49">+49 (Germany)</option>
                                        <option value="+39">+39 (Italy)</option>
                                        <option value="+34">+34 (Spain)</option>
                                        <option value="+351">+351 (Portugal)</option>
                                        <option value="+31">+31 (Netherlands)</option>
                                        <option value="+32">+32 (Belgium)</option>
                                        <option value="+352">+352 (Luxembourg)</option>
                                        <option value="+41">+41 (Switzerland)</option>
                                        <option value="+43">+43 (Austria)</option>
                                        <option value="+45">+45 (Denmark)</option>
                                        <option value="+46">+46 (Sweden)</option>
                                        <option value="+47">+47 (Norway)</option>
                                        <option value="+358">+358 (Finland)</option>
                                        <option value="+354">+354 (Iceland)</option>
                                        <option value="+48">+48 (Poland)</option>
                                        <option value="+420">+420 (Czech Republic)</option>
                                        <option value="+421">+421 (Slovakia)</option>
                                        <option value="+36">+36 (Hungary)</option>
                                        <option value="+40">+40 (Romania)</option>
                                        <option value="+359">+359 (Bulgaria)</option>
                                        <option value="+381">+381 (Serbia)</option>
                                        <option value="+385">+385 (Croatia)</option>
                                        <option value="+386">+386 (Slovenia)</option>
                                        <option value="+387">+387 (Bosnia and Herzegovina)</option>
                                        <option value="+382">+382 (Montenegro)</option>
                                        <option value="+389">+389 (North Macedonia)</option>
                                        <option value="+30">+30 (Greece)</option>
                                        <option value="+7">+7 (Russia)</option>
                                        <option value="+380">+380 (Ukraine)</option>
                                        <option value="+375">+375 (Belarus)</option>
                                        <option value="+373">+373 (Moldova)</option>
                                        <option value="+355">+355 (Albania)</option>
                                        <option value="+356">+356 (Malta)</option>
                                        <option value="+357">+357 (Cyprus)</option>
                                        <option value="+372">+372 (Estonia)</option>
                                        <option value="+371">+371 (Latvia)</option>
                                        <option value="+370">+370 (Lithuania)</option>
                                    </optgroup>
                                    <optgroup label="🌎 Americas">
                                        <option value="+1">+1 (United States / Canada)</option>
                                        <option value="+52">+52 (Mexico)</option>
                                        <option value="+55">+55 (Brazil)</option>
                                        <option value="+54">+54 (Argentina)</option>
                                        <option value="+56">+56 (Chile)</option>
                                        <option value="+51">+51 (Peru)</option>
                                        <option value="+57">+57 (Colombia)</option>
                                        <option value="+58">+58 (Venezuela)</option>
                                        <option value="+593">+593 (Ecuador)</option>
                                        <option value="+591">+591 (Bolivia)</option>
                                        <option value="+595">+595 (Paraguay)</option>
                                        <option value="+598">+598 (Uruguay)</option>
                                        <option value="+502">+502 (Guatemala)</option>
                                        <option value="+504">+504 (Honduras)</option>
                                        <option value="+503">+503 (El Salvador)</option>
                                        <option value="+505">+505 (Nicaragua)</option>
                                        <option value="+506">+506 (Costa Rica)</option>
                                        <option value="+507">+507 (Panama)</option>
                                        <option value="+53">+53 (Cuba)</option>
                                        <option value="+1-809">+1-809 (Dominican Republic)</option>
                                        <option value="+1-876">+1-876 (Jamaica)</option>
                                        <option value="+1-868">+1-868 (Trinidad and Tobago)</option>
                                    </optgroup>
                                    <optgroup label="🌍 Africa">
                                        <option value="+27">+27 (South Africa)</option>
                                        <option value="+234">+234 (Nigeria)</option>
                                        <option value="+20">+20 (Egypt)</option>
                                        <option value="+212">+212 (Morocco)</option>
                                        <option value="+216">+216 (Tunisia)</option>
                                        <option value="+213">+213 (Algeria)</option>
                                        <option value="+251">+251 (Ethiopia)</option>
                                        <option value="+254">+254 (Kenya)</option>
                                        <option value="+255">+255 (Tanzania)</option>
                                        <option value="+256">+256 (Uganda)</option>
                                        <option value="+250">+250 (Rwanda)</option>
                                        <option value="+257">+257 (Burundi)</option>
                                        <option value="+249">+249 (Sudan)</option>
                                        <option value="+211">+211 (South Sudan)</option>
                                        <option value="+233">+233 (Ghana)</option>
                                        <option value="+225">+225 (Ivory Coast)</option>
                                        <option value="+221">+221 (Senegal)</option>
                                        <option value="+223">+223 (Mali)</option>
                                        <option value="+227">+227 (Niger)</option>
                                        <option value="+242">+242 (Republic of the Congo)</option>
                                        <option value="+243">+243 (DR Congo)</option>
                                        <option value="+261">+261 (Madagascar)</option>
                                    </optgroup>
                                    <optgroup label="🌊 Oceania">
                                        <option value="+61">+61 (Australia)</option>
                                        <option value="+64">+64 (New Zealand)</option>
                                        <option value="+679">+679 (Fiji)</option>
                                        <option value="+675">+675 (Papua New Guinea)</option>
                                        <option value="+685">+685 (Samoa)</option>
                                        <option value="+676">+676 (Tonga)</option>
                                        <option value="+678">+678 (Vanuatu)</option>
                                        <option value="+691">+691 (Micronesia)</option>
                                        <option value="+1-671">+1-671 (Guam)</option>
                                    </optgroup>
                                </select>
                                <input type="tel" name="phone" required placeholder="81234567890"
                                    class="w-2/3 rounded-xl border-gray-300 focus:border-yellow-500 focus:ring-yellow-500">
                            </div>
                            @error('phone')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                        </div>

                        <hr class="border-gray-100 my-8">

                        {{-- Date Range Picker Section --}}
                        <div class="mt-6">
                            <label class="block text-sm font-medium text-gray-700 mb-2 pl-1">Choose Rental Date (Range)</label>
                            <input type="text" id="rental_range" name="rental_range" required 
                                class="w-full rounded-xl border-gray-300 focus:border-blue-950 focus:ring-blue-950 cursor-pointer"
                                placeholder="Select Start & End Date">
                        </div>

                        {{-- Hidden Input untuk data durasi --}}
                        <input type="hidden" name="start_date" id="start_date">
                        <input type="hidden" name="end_date" id="end_date">
                        <input type="hidden" name="rental_days" id="rentalDays" value="1">

                        {{-- Info Durasi Otomatis --}}
                        <div class="mt-4 bg-blue-950 p-4 rounded-xl flex items-center justify-between border border-blue-950">
                            <span class="text-sm text-white font-medium">Rental Duration:</span>
                            <span class="text-lg font-bold text-white" id="durationDisplay">0 Day</span>
                        </div>
                    </div>
                    <button type="submit"
                        class="mt-10 w-full bg-blue-950 hover:bg-blue-900 text-white font-bold py-4 rounded-xl transition-colors shadow-sm">
                        Proceed Payment
                    </button>
                </form>
            </div>

            {{-- Bagian Kanan: Ringkasan Tarif --}}
            <div class="lg:col-span-1">
                <div class="bg-white rounded-2xl shadow-sm p-6 sticky top-24 border border-gray-100">
                    <h3 class="font-bold text-gray-800 mb-5">Your Selected Car</h3>

                    <div class="bg-gray-50 rounded-xl overflow-hidden mb-5">
                        @if($carRental->image)
                        <img src="{{ Storage::url($carRental->image) }}" class="w-full h-32 object-cover">
                        @else
                        <div class="w-full h-32 bg-yellow-100 flex items-center justify-center">
                            <i class="fas fa-car text-yellow-500 text-3xl"></i>
                        </div>
                        @endif
                        <div class="p-4 border-t border-gray-100 bg-white">
                            <p class="font-bold text-gray-800 text-lg">{{ $carRental->name }}</p>
                        </div>
                    </div>

                    @php
                    $price = $carRental->discounted_price ?? $carRental->price;
                    @endphp

                    <div class="space-y-3 text-sm text-gray-600 mb-4 pb-4 border-b border-gray-100">
                        <div class="flex justify-between">
                            <span>Price Per Day</span>
                            <span class="font-medium text-gray-800" id="basePrice" data-price="{{ $price }}">Rp {{
                                number_format($price, 0, ',', '.') }}</span>
                        </div>
                        <div class="flex justify-between text-blue-950 font-medium">
                            <span>Duration</span>
                            <span id="summaryDays">0 Day</span>
                        </div>
                    </div>

                    <div class="space-y-2 bg-blue-950 p-4 rounded-xl border border-blue-950 text-white">
                        <div class="flex justify-between"><span>Rental Price</span><span id="totalPrice">Rp 0</span></div>
                        <div class="flex justify-between"><span>Merchant Fee (3%)</span><span id="merchantFee">Rp 0</span></div>
                        <div class="flex justify-between border-t border-blue-800 pt-2">
                            <span class="font-bold">Total Price</span>
                            <span class="font-extrabold text-xl" id="grandTotal">Rp 0</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
{{-- Library JavaScript Flatpickr --}}
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const durationDisplay = document.getElementById('durationDisplay');
        const summaryDays = document.getElementById('summaryDays');
        const totalPrice = document.getElementById('totalPrice');
        const merchantFee = document.getElementById('merchantFee');
        const grandTotal = document.getElementById('grandTotal');
        const hiddenDaysInput = document.getElementById('rentalDays');
        const startDateInput = document.getElementById('start_date');
        const endDateInput = document.getElementById('end_date');
        const basePrice = parseInt(document.getElementById('basePrice').dataset.price);

        // Inisialisasi Flatpickr Range Mode
        flatpickr("#rental_range", {
            mode: "range",
            minDate: "today",
            dateFormat: "Y-m-d",
            onClose: function(selectedDates, dateStr, instance) {
                if (selectedDates.length === 2) {
                    const start = selectedDates[0];
                    const end = selectedDates[1];
                    
                    // Hitung selisih hari
                    const diffTime = Math.abs(end - start);
                    const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24));
                    
                    // Jika pilih hari yang sama, hitung sebagai 1 hari (opsional)
                    const totalDays = diffDays === 0 ? 1 : diffDays;

                    // Update data hidden
                    startDateInput.value = instance.formatDate(start, "Y-m-d");
                    endDateInput.value = instance.formatDate(end, "Y-m-d");
                    hiddenDaysInput.value = totalDays;

                    // Update UI Tampilan
                    const label = totalDays + " Day" + (totalDays > 1 ? "s" : "");
                    durationDisplay.textContent = label;
                    summaryDays.textContent = label;

                    // Update Harga Total
                    const totalCost = basePrice * totalDays;
                    const fee = Math.round(totalCost * 0.03);
                    totalPrice.textContent = "Rp " + totalCost.toLocaleString('id-ID');
                    merchantFee.textContent = "Rp " + fee.toLocaleString('id-ID');
                    grandTotal.textContent = "Rp " + (totalCost + fee).toLocaleString('id-ID');
                }
            }
        });
    });
</script>
@endpush
@endsection