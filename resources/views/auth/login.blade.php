<x-guest-layout>


<h2
class="
text-2xl
font-black
text-gray-900
dark:text-white
mb-2
">

Welcome Back 👋

</h2>


<p
class="
text-sm
text-gray-500
dark:text-gray-400
mb-6
">

Login to order your favorite dishes

</p>



<x-auth-session-status 
class="mb-4"
:status="session('status')" />



<form method="POST" action="{{ route('login') }}">

@csrf



<div>

<x-input-label 
for="email"
:value="__('Email')"
/>


<x-text-input

id="email"

class="
block
mt-2
w-full

rounded-xl

border-gray-200
dark:border-gray-700

dark:bg-gray-800
dark:text-white
placeholder-gray-400 dark:placeholder-gray-500
dark:bg-gray-800/80

focus:border-amber-400
focus:ring-amber-400
"

type="email"

name="email"

:value="old('email')"

required

autofocus

/>


<x-input-error
:messages="$errors->get('email')"
class="mt-2"
/>


</div>





<div class="mt-5">


<x-input-label
for="password"
:value="__('Password')"
/>


<x-text-input

id="password"

class="
block
mt-2
w-full

rounded-xl

border-gray-200
dark:border-gray-700

placeholder-gray-400 dark:placeholder-gray-500
dark:bg-gray-800/80

dark:text-white

focus:border-amber-400
focus:ring-amber-400

"

type="password"

name="password"

required

/>


<x-input-error
:messages="$errors->get('password')"
class="mt-2"
/>


</div>





<div class="flex items-center justify-between mt-6">


<label class="flex items-center gap-2">


<input
type="checkbox"
name="remember"
class="
rounded
border-gray-300
text-amber-500
focus:ring-amber-400
">


<span
class="
text-sm
text-gray-600
dark:text-gray-400
">

Remember me

</span>


</label>



@if(Route::has('password.request'))

<a
href="{{ route('password.request') }}"

class="
text-sm
text-amber-600
hover:text-amber-700
font-semibold
">

Forgot Password?

</a>

@endif


</div>




<button

class="
mt-6
w-full

bg-amber-400

hover:bg-amber-500

text-gray-900

font-black

py-3

rounded-2xl

shadow-lg
shadow-amber-400/20

transition

">

Login

</button>



<p
class="
text-center
text-sm
mt-6
text-gray-600
dark:text-gray-400
">

Don't have account?

<a
href="{{ route('register') }}"
class="
text-amber-600
font-bold
">

Register

</a>

</p>



</form>


</x-guest-layout>