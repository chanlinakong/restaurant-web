<x-app-layout :title="'Payment Success'">
    <div class="max-w-xl mx-auto py-16 text-center">
        <div class="bg-white dark:bg-gray-800 rounded-3xl shadow-sm border border-gray-100 dark:border-gray-700 p-10">
            <div
                class="w-20 h-20 mx-auto rounded-full bg-green-100 dark:bg-green-900/30 flex items-center justify-center mb-6">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-10 h-10 text-green-600 dark:text-green-400" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                </svg> </div>
            <h1 class="text-3xl font-extrabold text-gray-900 dark:text-white mb-3"> Payment Successful </h1>
            <p class="text-gray-500 dark:text-gray-400"> Please wait while we confirm and create your order. </p>
        </div>
    </div> 
    @vite('resources/js/payment-success.js')
</x-app-layout>