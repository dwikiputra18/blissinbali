@extends('layouts.front')

@section('title', 'Help Center | Bliss in Bali')

@section('content')
<div class="bg-gray-50 min-h-screen">
    <!-- Hero Section -->
    <div class="bg-indigo-900 text-white pt-32 pb-24 px-4 sm:px-6 lg:px-8 text-center relative overflow-hidden">
        <!-- SVG Pattern Background -->
        <div class="absolute inset-0 opacity-10">
            <svg class="w-full h-full" xmlns="http://www.w3.org/2000/svg" width="100%" height="100%">
                <defs>
                    <pattern id="pattern" width="40" height="40" patternUnits="userSpaceOnUse">
                        <path d="M0 40L40 0H20L0 20M40 40V20L20 40" fill="none" stroke="currentColor" stroke-width="2" />
                    </pattern>
                </defs>
                <rect width="100%" height="100%" fill="url(#pattern)" />
            </svg>
        </div>

        <div class="relative z-10 max-w-3xl mx-auto">
            <h1 class="text-4xl md:text-5xl font-extrabold brand-font mb-6 drop-shadow-md">How can we help you?</h1>
            <p class="text-indigo-200 text-lg mb-8">Search our knowledge base or browse categories below to find the answers you need.</p>
            
            <div class="relative max-w-2xl mx-auto">
                <input type="text" placeholder="Search for answers (e.g., 'refund policy')..." class="w-full pl-12 pr-4 py-4 rounded-full text-gray-800 shadow-xl focus:outline-none focus:ring-4 focus:ring-yellow-500 transition-all font-medium">
                <i class="fas fa-search absolute left-5 top-1/2 -translate-y-1/2 text-gray-400 text-lg"></i>
                <button class="absolute right-2 top-1/2 -translate-y-1/2 bg-yellow-500 hover:bg-yellow-600 text-white px-6 py-2.5 rounded-full font-bold transition-colors">Search</button>
            </div>
        </div>
    </div>

    <!-- Quick Links / Topics -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 -mt-10 relative z-20">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            <!-- Card 1 -->
            <a href="#faq" class="bg-white p-6 rounded-2xl shadow-lg border border-gray-100 hover:-translate-y-2 hover:shadow-xl transition-all duration-300 text-center group block">
                <div class="w-14 h-14 bg-indigo-50 text-indigo-600 rounded-full flex items-center justify-center mx-auto mb-4 group-hover:bg-indigo-600 group-hover:text-white transition-colors duration-300">
                    <i class="fas fa-calendar-check text-2xl"></i>
                </div>
                <h3 class="text-lg font-bold text-gray-900 mb-2 brand-font">Booking & Payment</h3>
                <p class="text-sm text-gray-500 line-clamp-2">Learn how to book, manage your reservations, and payment methods.</p>
            </a>
            <!-- Card 2 -->
            <a href="#faq" class="bg-white p-6 rounded-2xl shadow-lg border border-gray-100 hover:-translate-y-2 hover:shadow-xl transition-all duration-300 text-center group block">
                <div class="w-14 h-14 bg-orange-50 text-orange-500 rounded-full flex items-center justify-center mx-auto mb-4 group-hover:bg-orange-500 group-hover:text-white transition-colors duration-300">
                    <i class="fas fa-map-marked-alt text-2xl"></i>
                </div>
                <h3 class="text-lg font-bold text-gray-900 mb-2 brand-font">Tours & Activities</h3>
                <p class="text-sm text-gray-500 line-clamp-2">Detailing what to expect, pickup times, and tour itineraries.</p>
            </a>
            <!-- Card 3 -->
            <a href="#faq" class="bg-white p-6 rounded-2xl shadow-lg border border-gray-100 hover:-translate-y-2 hover:shadow-xl transition-all duration-300 text-center group block">
                <div class="w-14 h-14 bg-red-50 text-red-500 rounded-full flex items-center justify-center mx-auto mb-4 group-hover:bg-red-500 group-hover:text-white transition-colors duration-300">
                    <i class="fas fa-undo-alt text-2xl"></i>
                </div>
                <h3 class="text-lg font-bold text-gray-900 mb-2 brand-font">Cancellations</h3>
                <p class="text-sm text-gray-500 line-clamp-2">Understand our refund policies and how to cancel a trip.</p>
            </a>
            <!-- Card 4 -->
            <a href="#contact" class="bg-white p-6 rounded-2xl shadow-lg border border-gray-100 hover:-translate-y-2 hover:shadow-xl transition-all duration-300 text-center group block">
                <div class="w-14 h-14 bg-green-50 text-green-500 rounded-full flex items-center justify-center mx-auto mb-4 group-hover:bg-green-500 group-hover:text-white transition-colors duration-300">
                    <i class="fas fa-headset text-2xl"></i>
                </div>
                <h3 class="text-lg font-bold text-gray-900 mb-2 brand-font">Contact Support</h3>
                <p class="text-sm text-gray-500 line-clamp-2">Need human help? Reach out to our 24/7 support team directly.</p>
            </a>
        </div>
    </div>

    <!-- FAQ Section -->
    <div id="faq" class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-20">
        <div class="text-center mb-12">
            <span class="text-orange-500 font-bold uppercase tracking-wider text-sm">Got Questions?</span>
            <h2 class="text-3xl md:text-4xl font-extrabold text-gray-900 mt-2 mb-4 brand-font">Frequently Asked Questions</h2>
            <div class="w-16 h-1 bg-indigo-600 mx-auto rounded-full"></div>
        </div>

        <div class="space-y-4">
            <!-- FAQ 1 -->
            <details class="group bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden [&_summary::-webkit-details-marker]:hidden">
                <summary class="flex items-center justify-between p-6 cursor-pointer bg-white hover:bg-gray-50 transition-colors">
                    <h3 class="font-bold text-gray-900 text-lg pr-4">How do I make a booking?</h3>
                    <span class="flex-shrink-0 bg-indigo-50 text-indigo-600 w-8 h-8 rounded-full flex items-center justify-center group-open:rotate-45 transition-transform duration-300">
                        <i class="fas fa-plus"></i>
                    </span>
                </summary>
                <div class="px-6 pb-6 text-gray-600 leading-relaxed border-t border-gray-50 pt-4">
                    Booking is easy! Simply browse our available tours, select your desired date and options, and click "Booking". Follow the secure checkout process to confirm your reservation. You will receive an email confirmation shortly after.
                </div>
            </details>

            <!-- FAQ 2 -->
            <details class="group bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden [&_summary::-webkit-details-marker]:hidden">
                <summary class="flex items-center justify-between p-6 cursor-pointer bg-white hover:bg-gray-50 transition-colors">
                    <h3 class="font-bold text-gray-900 text-lg pr-4">What payment methods do you accept?</h3>
                    <span class="flex-shrink-0 bg-indigo-50 text-indigo-600 w-8 h-8 rounded-full flex items-center justify-center group-open:rotate-45 transition-transform duration-300">
                        <i class="fas fa-plus"></i>
                    </span>
                </summary>
                <div class="px-6 pb-6 text-gray-600 leading-relaxed border-t border-gray-50 pt-4">
                    We accept various payment methods through our secure Midtrans payment gateway, including Credit/Debit Cards (Visa, Mastercard), Bank Transfers (Virtual Accounts), and popular E-Wallets.
                </div>
            </details>

            <!-- FAQ 3 -->
            <details class="group bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden [&_summary::-webkit-details-marker]:hidden">
                <summary class="flex items-center justify-between p-6 cursor-pointer bg-white hover:bg-gray-50 transition-colors">
                    <h3 class="font-bold text-gray-900 text-lg pr-4">Can I cancel my tour and get a refund?</h3>
                    <span class="flex-shrink-0 bg-indigo-50 text-indigo-600 w-8 h-8 rounded-full flex items-center justify-center group-open:rotate-45 transition-transform duration-300">
                        <i class="fas fa-plus"></i>
                    </span>
                </summary>
                <div class="px-6 pb-6 text-gray-600 leading-relaxed border-t border-gray-50 pt-4">
                    Yes, we offer refunds depending on when you cancel. Cancellations made more than 7 days prior receive a full refund (minus admin fees). Cancellations 3-6 days prior get a 50% refund. Please check our <a href="{{ route('terms') }}" class="text-indigo-600 font-semibold hover:underline">Terms & Conditions</a> for complete details.
                </div>
            </details>

            <!-- FAQ 4 -->
            <details class="group bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden [&_summary::-webkit-details-marker]:hidden">
                <summary class="flex items-center justify-between p-6 cursor-pointer bg-white hover:bg-gray-50 transition-colors">
                    <h3 class="font-bold text-gray-900 text-lg pr-4">Are meals included in the tour packages?</h3>
                    <span class="flex-shrink-0 bg-indigo-50 text-indigo-600 w-8 h-8 rounded-full flex items-center justify-center group-open:rotate-45 transition-transform duration-300">
                        <i class="fas fa-plus"></i>
                    </span>
                </summary>
                <div class="px-6 pb-6 text-gray-600 leading-relaxed border-t border-gray-50 pt-4">
                    It depends on the specific tour package. Please check the "Inclusions" tab on the individual tour details page to see if lunch, dinner, or snacks are provided.
                </div>
            </details>

            <!-- FAQ 5 -->
            <details class="group bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden [&_summary::-webkit-details-marker]:hidden">
                <summary class="flex items-center justify-between p-6 cursor-pointer bg-white hover:bg-gray-50 transition-colors">
                    <h3 class="font-bold text-gray-900 text-lg pr-4">Do you provide airport transfers?</h3>
                    <span class="flex-shrink-0 bg-indigo-50 text-indigo-600 w-8 h-8 rounded-full flex items-center justify-center group-open:rotate-45 transition-transform duration-300">
                        <i class="fas fa-plus"></i>
                    </span>
                </summary>
                <div class="px-6 pb-6 text-gray-600 leading-relaxed border-t border-gray-50 pt-4">
                    Yes! We offer convenient airport pickup and drop-off services. You can arrange this via our Car Rental section or contact our support team to add it to your existing tour package.
                </div>
            </details>
        </div>
    </div>

    <!-- Still Need Help Contact Block -->
    <div id="contact" class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pb-20">
        <div class="bg-gradient-to-r from-indigo-600 to-indigo-800 rounded-3xl p-8 md:p-12 text-center text-white shadow-2xl relative overflow-hidden">
            <!-- Decorative Elements -->
            <div class="absolute top-0 right-0 -translate-y-1/2 translate-x-1/3 w-64 h-64 bg-white/10 rounded-full blur-3xl"></div>
            <div class="absolute bottom-0 left-0 translate-y-1/2 -translate-x-1/3 w-64 h-64 bg-orange-400/20 rounded-full blur-3xl"></div>
            
            <div class="relative z-10 w-20 h-20 bg-white/20 backdrop-blur rounded-full flex items-center justify-center mx-auto mb-6">
                <i class="fas fa-envelope-open-text text-4xl text-white"></i>
            </div>
            <h2 class="text-3xl font-extrabold brand-font mb-4">Still need help?</h2>
            <p class="text-indigo-100 text-lg max-w-2xl mx-auto mb-8">Our dedicated customer support team is available 24/7 to assist you with any inquiries or special requests.</p>
            
            <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
                <a href="mailto:cs@blissinbali.com" class="bg-white text-indigo-700 hover:bg-gray-50 font-bold py-3.5 px-8 rounded-full transition-colors shadow-lg flex items-center gap-2">
                    <i class="fas fa-envelope"></i> Email Support
                </a>
                <a href="https://wa.me/6281266718008" target="_blank" class="bg-green-500 hover:bg-green-600 text-white font-bold py-3.5 px-8 rounded-full transition-colors shadow-lg flex items-center gap-2">
                    <i class="fab fa-whatsapp text-lg"></i> Chat on WhatsApp
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
