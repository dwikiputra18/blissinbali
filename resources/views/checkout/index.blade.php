@extends('layouts.front')

@section('title', 'Checkout - ' . $tourPackage->title)

@section('content')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script src="//unpkg.com/alpinejs" defer></script>

<div class="pt-24 pb-16 bg-[#F8F9FA] min-h-screen">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <h1 class="text-3xl font-bold text-gray-800 brand-font mb-8">Booking Information</h1>

        @if(session('error'))
        <div class="bg-red-50 text-red-600 p-4 rounded-xl mb-6 flex justify-between">
            {{ session('error') }}
        </div>
        @endif

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8" x-data="tourBooking({
            isActivity: {{ $tourPackage->is_activity ? 'true' : 'false' }},
            minimumQuantity: {{ $tourPackage->minimum_booking_quantity }},
            activitySinglePrice: {{ $tourPackage->activity_single_price ?? 0 }},
            activityTandemPrice: {{ $tourPackage->activity_tandem_price ?? 0 }},
            price_1_pax: {{ $tourPackage->price_1_pax ?? 0 }},
            price_2_4: {{ $tourPackage->price_2_4 ?? 0 }},
            price_5_7: {{ $tourPackage->price_5_7 ?? 0 }},
            price_8_14: {{ $tourPackage->price_8_14 ?? 0 }},
            tandem_price_2_4: {{ $tourPackage->tandem_price_2_4 ?? $tourPackage->activity_tandem_price ?? 0 }},
            tandem_price_5_7: {{ $tourPackage->tandem_price_5_7 ?? $tourPackage->activity_tandem_price ?? 0 }},
            tandem_price_8_14: {{ $tourPackage->tandem_price_8_14 ?? $tourPackage->activity_tandem_price ?? 0 }},
            basePrice: {{ $tourPackage->price_2_4 ?? 0 }}
             })" x-init="init()" x-cloak>

            {{-- Form Kiri --}}
            <div class="lg:col-span-2 space-y-6">
                <form id="checkoutForm" action="{{ route('checkout.process', $tourPackage) }}" method="POST"
                    class="bg-white rounded-2xl shadow-sm p-8 space-y-6">
                    @csrf

                    <h2 class="text-xl font-bold text-gray-800">Customer Contact Details</h2>

                    {{-- Full Name --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Full Name</label>
                        <input type="text" name="name" required
                        class="w-full px-4 rounded-xl border-gray-300 focus:border-[#C68A36] focus:ring-[#C68A36]"
                        placeholder="full name">
                        @error('name')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                    </div>

                    {{-- Email --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                        <input type="email" name="email" required
                        class="w-full px-4 rounded-xl border-gray-300 focus:border-[#C68A36] focus:ring-[#C68A36]"
                        placeholder="you@mail.com">
                        @error('email')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                    </div>

                    {{-- Phone --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">WhatsApp / Phone Number</label>
                        <div class="flex flex-col sm:flex-row gap-2">
                            <select name="country_code" x-model="form.country_code"
                                class="border rounded-xl px-3 py-2 focus:border-[#C68A36] focus:ring-[#C68A36] text-sm">
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
                            <input type="tel" name="phone" x-model="form.phone" required placeholder="81234567890"
                                class="w-full rounded-xl border-gray-300 focus:border-[#C68A36] focus:ring-[#C68A36]">
                        </div>
                        @error('phone')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                    </div>

                    <h2 class="text-xl font-bold text-gray-800 pt-2">Travel Details</h2>

                    @if($tourPackage->is_activity)
                    <div class="rounded-2xl border border-gray-200 bg-gray-50 p-5">
                        <div class="mb-4">
                            <label class="block text-sm font-bold text-gray-800">Choose Activities</label>
                            <p class="mt-1 text-xs text-gray-500">You can combine Single and Tandem rides in one booking.</p>
                        </div>
                        <div class="space-y-3">
                            <div class="flex items-center justify-between gap-4 rounded-xl border border-gray-200 bg-white p-4">
                                <div>
                                    <p class="font-bold text-gray-800">Single Ride</p>
                                    <p class="text-xs text-gray-500">1 participant</p>
                                    <p class="mt-1 text-sm font-semibold text-[#C68A36]">Single-person pricing applies</p>
                                </div>
                                <div class="flex items-center gap-2">
                                    <button type="button" @click="changeUnits('single', -1)" class="h-9 w-9 rounded-lg border border-gray-300 text-lg font-bold text-gray-700 hover:bg-gray-100">−</button>
                                    <span class="w-8 text-center font-bold" x-text="form.single_quantity"></span>
                                    <button type="button" @click="changeUnits('single', 1)" class="h-9 w-9 rounded-lg border border-gray-300 text-lg font-bold text-gray-700 hover:bg-gray-100">+</button>
                                </div>
                            </div>
                            <div class="flex items-center justify-between gap-4 rounded-xl border border-gray-200 bg-white p-4">
                                <div>
                                    <p class="font-bold text-gray-800">Tandem Ride</p>
                                    <p class="text-xs text-gray-500">2 participants per tandem</p>
                                    <p class="mt-1 text-sm font-semibold text-[#C68A36]">Group pricing applies</p>
                                </div>
                                <div class="flex items-center gap-2">
                                    <button type="button" @click="changeUnits('tandem', -1)" class="h-9 w-9 rounded-lg border border-gray-300 text-lg font-bold text-gray-700 hover:bg-gray-100">−</button>
                                    <span class="w-8 text-center font-bold" x-text="form.tandem_quantity"></span>
                                    <button type="button" @click="changeUnits('tandem', 1)" class="h-9 w-9 rounded-lg border border-gray-300 text-lg font-bold text-gray-700 hover:bg-gray-100">+</button>
                                </div>
                            </div>
                        </div>
                        <input type="hidden" name="single_quantity" x-model="form.single_quantity">
                        <input type="hidden" name="tandem_quantity" x-model="form.tandem_quantity">
                        <input type="hidden" name="pricing_option" x-model="form.pricing_option">
                        <input type="hidden" name="quantity" x-model="form.quantity">
                        <div class="mt-4 flex items-center justify-between border-t border-gray-200 pt-4 text-sm">
                            <span class="font-semibold text-gray-700">Total participants</span>
                            <span class="text-lg font-black text-gray-900" x-text="totalPax + ' pax'"></span>
                        </div>
                        <div x-show="belowMinimum" x-cloak class="mt-3 rounded-xl bg-amber-50 p-3 text-sm font-medium text-amber-800">
                            ⚠️ Please select at least <span x-text="minimumQuantity"></span> participants.
                        </div>
                        @error('single_quantity')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                        @error('tandem_quantity')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                    </div>
                    @endif

                    {{-- Date --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Booking Date</label>
                        <input type="text" id="travel_date" name="travel_date" x-model="form.date" required
                            class="w-full rounded-xl border-gray-300 focus:border-[#C68A36] focus:ring-[#C68A36]"
                            placeholder="Select date">
                        @error('travel_date')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                    </div>

                    @if(!$tourPackage->is_activity)
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Number of People (Pax)</label>
                        <div class="relative flex items-center max-w-[160px]">
                            <button type="button" @click="decrement"
                                :class="form.quantity <= minimumQuantity ? 'opacity-50 cursor-not-allowed' : ''"
                                class="bg-gray-100 border border-gray-300 rounded-l-xl px-3 py-2 hover:bg-gray-200 text-lg font-bold">−</button>
                            <input type="text" name="quantity" x-model="form.quantity" readonly
                                class="bg-[#F8F9FA] border-t border-b border-gray-300 text-center w-full py-2 font-medium">
                            <button type="button" @click="increment"
                                class="bg-gray-100 border border-gray-300 rounded-r-xl px-3 py-2 hover:bg-gray-200 text-lg font-bold">+</button>
                        </div>
                        <p class="text-[10px] text-gray-400 mt-1" x-text="quantityHint"></p>
                        @error('quantity')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                    </div>
                    @endif

                    {{-- Pickup Point --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Pickup Point</label>
                        <textarea name="pickup_point" x-model="form.pickup_point" required
                            placeholder="e.g. Hotel Grand Hyatt Bali, Jalan Nusa Dua..."
                            class="w-full rounded-xl border-gray-300 focus:border-[#C68A36] focus:ring-[#C68A36] h-20"></textarea>

                        <div class="flex items-center gap-3 p-3 bg-[#F8F9FA] rounded-xl mt-2">
                            <div class="flex-1">
                                <p class="text-sm font-medium text-gray-700">Or use current location.</p>
                                <p class="text-xs text-gray-500">We will collect your GPS coordinates.</p>
                            </div>
                            <button type="button" @click="useMyLocation"
                                class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 whitespace-nowrap text-sm font-medium">
                                📍 Use this location
                            </button>
                        </div>

                        <input type="hidden" name="latitude" :value="form.latitude">
                        <input type="hidden" name="longitude" :value="form.longitude">

                        <template x-if="locationLoading">
                            <p class="text-sm text-[#0A2240] flex items-center gap-2 mt-2">
                                <svg class="animate-spin h-4 w-4 text-[#0A2240]" xmlns="http://www.w3.org/2000/svg"
                                    fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                                        stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor"
                                        d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                                    </path>
                                </svg>
                                Getting your location...
                            </p>
                        </template>

                        <template x-if="form.latitude && form.longitude">
                            <p class="text-sm text-green-600 bg-green-50 p-2 rounded-lg mt-2">
                                ✅ Location found:
                                <span x-text="form.latitude"></span>,
                                <span x-text="form.longitude"></span>
                            </p>
                        </template>
                    </div>

                    <button type="submit" :disabled="isActivity && belowMinimum"
                        :class="isActivity && belowMinimum ? 'cursor-not-allowed bg-gray-300' : 'bg-[#0A2240] hover:bg-[#0E2F56]'"
                        class="w-full text-white font-bold py-4 rounded-lg transition-colors shadow-sm">
                        Continue to Payment
                    </button>
                    <p class="text-xs text-gray-400 text-center"><i class="fas fa-lock text-gray-300 mr-1"></i> Secure
                        payment supported by Midtrans</p>
                </form>
            </div>

            {{-- Ringkasan Pesanan Kanan --}}
            <div class="lg:col-span-1 lg:w-[calc(100%+3.5rem)]">
                <div class="bg-white rounded-2xl shadow-sm p-6 sticky top-24">
                    <h3 class="font-bold text-gray-800 mb-4">Order Summary</h3>

                    <div class="flex gap-4 mb-4 pb-4 border-b border-gray-100">
                        <div class="w-20 h-20 rounded-xl overflow-hidden flex-shrink-0 bg-gray-100">
                            @if($tourPackage->thumbnail)
                            <img src="{{ Storage::url($tourPackage->thumbnail) }}" class="w-full h-full object-cover">
                            @endif
                        </div>
                        <div>
                            <p class="text-sm font-bold text-gray-800 leading-snug">{{ $tourPackage->title }}</p>
                            <p class="text-xs text-gray-500 mt-1">{{ $tourPackage->category->name }}</p>
                        </div>
                    </div>

                    <div class="space-y-2 text-sm text-gray-600 mb-4 pb-4 border-b border-gray-100">
                        <template x-if="isActivity">
                            <div class="space-y-2">
                                <div class="flex justify-between"><span>Single Pax</span><span x-text="form.single_quantity + ' pax'"></span></div>
                                <div class="flex justify-between"><span>Tandem Units</span><span x-text="form.tandem_quantity + ' unit(s)'"></span></div>
                                <div class="flex justify-between"><span>Single Price</span><span x-text="'Rp ' + singleRate.toLocaleString('id-ID')"></span></div>
                                <div class="flex justify-between"><span>Tandem Price / pax</span><span x-text="'Rp ' + tandemRate.toLocaleString('id-ID')"></span></div>
                                <div class="flex justify-between"><span>Single Total</span><span x-text="'Rp ' + singleTotal.toLocaleString('id-ID')"></span></div>
                                <div class="flex justify-between"><span>Tandem Total</span><span x-text="'Rp ' + tandemTotal.toLocaleString('id-ID')"></span></div>
                                <div class="flex justify-between border-t border-gray-100 pt-2"><span>Total Pax</span><span class="font-medium text-gray-800" x-text="totalPax + ' pax'"></span></div>
                            </div>
                        </template>
                        <template x-if="!isActivity">
                            <div class="flex justify-between"><span>Number of People</span><span class="font-medium text-gray-800" x-text="form.quantity + ' pax'"></span></div>
                        </template>
                    </div>

                    <div class="flex justify-between items-center mb-4">
                        <div class="w-full space-y-2">
                            <div class="flex justify-between"><span>Tour Price</span><span x-text="'Rp ' + totalPrice.toLocaleString('id-ID')"></span></div>
                            <div class="flex justify-between"><span>Merchant Fee (3%)</span><span x-text="'Rp ' + merchantFee.toLocaleString('id-ID')"></span></div>
                            <div class="flex justify-between border-t border-gray-100 pt-2">
                                <span class="font-bold text-gray-800">Total Payment</span>
                                <span class="font-bold text-xl text-[#C68A36]" x-text="'Rp ' + grandTotal.toLocaleString('id-ID')"></span>
                            </div>
                        </div>
                    </div>

                    <p class="text-xs text-gray-400 italic">* Price may vary based on group size</p>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function tourBooking({ isActivity, minimumQuantity, activitySinglePrice, activityTandemPrice, price_1_pax, price_2_4, price_5_7, price_8_14, tandem_price_2_4, tandem_price_5_7, tandem_price_8_14, basePrice }) {
        return {
            isActivity,
            activitySinglePrice,
            activityTandemPrice,
            form: {
                name: '',
                email: '',
                country_code: '+62',
                phone: '',
                quantity: minimumQuantity,
                single_quantity: isActivity ? minimumQuantity : 0,
                tandem_quantity: 0,
                pricing_option: isActivity ? 'single' : null,
                date: '',
                pickup_point: '',
                latitude: '',
                longitude: ''
            },
            locationLoading: false,
            minimumQuantity,
            price_1_pax,
            price_2_4,
            price_5_7,
            price_8_14,
            tandem_price_2_4,
            tandem_price_5_7,
            tandem_price_8_14,
            pricePerPerson: isActivity ? activityTandemPrice : (price_2_4 || basePrice),
            totalPrice: isActivity ? price_1_pax : price_1_pax,
            singleRate: 0,
            tandemRate: 0,
            singleTotal: 0,
            tandemTotal: 0,
            merchantFee: 0,
            grandTotal: 0,

            get totalPax() {
                return this.isActivity ? this.form.single_quantity + (this.form.tandem_quantity * 2) : this.form.quantity;
            },

            get belowMinimum() {
                return this.totalPax < this.minimumQuantity;
            },

            get quantityHint() {
                return `* Minimum ${this.minimumQuantity} pax required`;
            },

            init() {
                flatpickr("#travel_date", { minDate: "today" });
                this.updatePrice();
            },

            increment() {
                this.form.quantity += 1;
                this.updatePrice();
            },
            decrement() {
                if (this.form.quantity > this.minimumQuantity) {
                    this.form.quantity -= 1;
                    this.updatePrice();
                }
            },

            changeUnits(type, amount) {
                const field = type + '_quantity';
                const nextValue = Math.max(0, this.form[field] + amount);
                const nextTotalPax = type === 'single'
                    ? nextValue + (this.form.tandem_quantity * 2)
                    : this.form.single_quantity + (nextValue * 2);

                if (nextTotalPax < this.minimumQuantity) {
                    return;
                }

                this.form[field] = nextValue;
                this.updatePrice();
            },

            updatePrice() {
                if (this.isActivity) {
                    const single = this.form.single_quantity;
                    const tandem = this.form.tandem_quantity;
                    this.form.quantity = this.totalPax;
                    this.form.pricing_option = single > 0 && tandem > 0 ? 'mixed' : (single > 0 ? 'single' : 'tandem');
                    const q = this.totalPax;
                    const tier = q === 1 ? '1_pax' : (q >= 8 ? '8_14' : (q >= 5 ? '5_7' : '2_4'));
                    const singleRate = q === 1
                        ? (this.price_1_pax || this.activitySinglePrice || this.price_2_4 || 0)
                        : (this['price_' + tier] || 0);
                    const tandemRate = this['tandem_price_' + tier] || 0;
                    this.singleRate = singleRate;
                    this.tandemRate = tandemRate;
                    this.singleTotal = single * singleRate;
                    this.tandemTotal = tandem * 2 * tandemRate;
                    this.pricePerPerson = singleRate;
                    this.totalPrice = this.singleTotal + this.tandemTotal;
                    this.updateTotalWithMerchantFee();
                    return;
                }
                const q = this.form.quantity;
                if (q === 1) {
                    this.pricePerPerson = this.price_1_pax;
                } else if (q <= 4) {
                    this.pricePerPerson = this.price_2_4;
                } else if (q >= 5 && q <= 7) {
                    this.pricePerPerson = this.price_5_7;
                } else if (q >= 8) {
                    this.pricePerPerson = this.price_8_14;
                } else {
                    this.pricePerPerson = basePrice;
                }
                this.singleRate = this.pricePerPerson;
                this.singleTotal = this.pricePerPerson * q;
                this.tandemRate = 0;
                this.tandemTotal = 0;
                this.totalPrice = this.pricePerPerson * q;
                this.updateTotalWithMerchantFee();
            },

            updateTotalWithMerchantFee() {
                this.merchantFee = Math.round(this.totalPrice * 0.03);
                this.grandTotal = this.totalPrice + this.merchantFee;
            },

            useMyLocation() {
                if (!navigator.geolocation) {
                    alert('❌ Geolocation is not supported by this browser.');
                    return;
                }
                this.locationLoading = true;
                this.form.pickup_point = '📡 Detecting your location...';

                navigator.geolocation.getCurrentPosition(
                    (pos) => {
                        const lat = pos.coords.latitude;
                        const lng = pos.coords.longitude;
                        const accuracy = pos.coords.accuracy;

                        this.locationLoading = false;
                        this.form.latitude = lat.toFixed(8);
                        this.form.longitude = lng.toFixed(8);

                        if (accuracy > 50) {
                            alert('⚠️ Location may be inaccurate. Try in an open area.');
                        }

                        this.form.pickup_point = '📍 Finding address from coordinates...';
                        this.getAddressFromCoordinates(lat, lng);
                    },
                    (err) => {
                        this.locationLoading = false;
                        let msg = '❌ Unable to get location: ';
                        switch (err.code) {
                            case err.PERMISSION_DENIED: msg += 'Location permission denied.'; break;
                            case err.POSITION_UNAVAILABLE: msg += 'Location information unavailable.'; break;
                            case err.TIMEOUT: msg += 'Location request timed out.'; break;
                            default: msg += err.message;
                        }
                        alert(msg);
                    },
                    { enableHighAccuracy: true, timeout: 15000, maximumAge: 0 }
                );
            },

            getAddressFromCoordinates(lat, lng) {
                const url = `https://nominatim.openstreetmap.org/reverse?lat=${lat}&lon=${lng}&format=jsonv2&addressdetails=1&zoom=18`;
                fetch(url, {
                    headers: { 'Accept-Language': 'en' }
                })
                    .then(res => res.json())
                    .then(json => {
                        if (json && json.display_name) {
                            this.form.pickup_point = json.display_name;
                        } else {
                            this.form.pickup_point = `Coordinates: ${lat.toFixed(6)}, ${lng.toFixed(6)} — please fill in manually.`;
                            alert('Address not found. Please fill in manually.');
                        }
                    })
                    .catch(() => {
                        this.form.pickup_point = `Coordinates: ${lat.toFixed(6)}, ${lng.toFixed(6)} — please fill in manually.`;
                    });
            }
        }
    }
</script>
@endsection