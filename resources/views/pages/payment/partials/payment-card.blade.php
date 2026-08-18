<div class="bg-white dark:bg-gray-800 rounded-3xl shadow-sm border border-gray-100 dark:border-gray-700 p-6 sm:p-8">
    <div class="flex items-center gap-3 mb-6">
        <div class="w-12 h-12 rounded-2xl bg-amber-100 dark:bg-amber-900/30 flex items-center justify-center"> 
            <svg
                xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-amber-600 dark:text-amber-400" fill="none"
                viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a5 5 0 00-10 0v2M5 9h14l-1 10H6L5 9z" />
            </svg> 
        </div>
        <div>
            <h1 class="text-2xl sm:text-3xl font-extrabold text-gray-900 dark:text-white"> Secure Payment </h1>
            <p class="text-gray-500 dark:text-gray-400 mt-1"> Complete your payment securely with Stripe. </p>
        </div>
    </div> 
    <div id="payment-element"></div>
    <button id="payBtn"
        class="w-full bg-amber-400 hover:bg-amber-500 text-gray-900 font-extrabold py-3 rounded-2xl transition duration-200 shadow-lg shadow-amber-400/20 mt-3">
        Pay with Stripe 
    </button>
    <p id="paymentMessage" class="hidden mt-4 text-sm text-center text-red-500"> </p>
</div>