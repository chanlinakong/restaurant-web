<x-app-layout :title="'Payment'">
    <div class="max-w-5xl mx-auto py-10">
        <div class="grid lg:grid-cols-3 gap-8"> {{-- Payment Form --}} <div class="lg:col-span-2">
                @include('pages.payment.partials.payment-card')
            </div> {{-- Order Summary --}} <div>
                @include('pages.payment.partials.order-summary')
            </div>
        </div>
    </div>
    
    <script src="https://js.stripe.com/v3/"></script>

    @vite('resources/js/payment.js')
</x-app-layout>