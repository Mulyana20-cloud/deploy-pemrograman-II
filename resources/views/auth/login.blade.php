<x-guest-layout>


<div>


<h2 class="
text-3xl
sm:text-4xl
font-bold
text-[#172033]
leading-tight
">

Welcome Back 👋

</h2>


<p class="
mt-3
text-gray-500
text-base
">

Login to continue shopping

</p>



<x-auth-session-status 
class="mt-4 mb-4"
:status="session('status')" />



<form method="POST" action="{{ route('login') }}" class="mt-8">

@csrf



<div>

<x-input-label 
for="email"
value="Email"
/>


<input
id="email"
type="email"
name="email"
value="{{ old('email') }}"
required
autofocus
class="
mt-2
w-full
rounded-xl
border-gray-300
focus:border-pink-500
focus:ring-pink-500
py-3
"
/>


<x-input-error 
:messages="$errors->get('email')"
class="mt-2"
/>


</div>




<div class="mt-5">


<x-input-label
for="password"
value="Password"
/>


<input
id="password"
type="password"
name="password"
required
class="
mt-2
w-full
rounded-xl
border-gray-300
focus:border-pink-500
focus:ring-pink-500
py-3
"
/>


<x-input-error
:messages="$errors->get('password')"
class="mt-2"
/>


</div>




<div class="mt-5">

<label class="
flex
items-center
gap-3
text-sm
text-gray-600
">


<input
type="checkbox"
name="remember"
class="
rounded
border-gray-300
text-pink-600
focus:ring-pink-500
">


Remember me


</label>

</div>




<button
class="
mt-7
w-full
bg-pink-600
hover:bg-pink-700
text-white
py-3
rounded-xl
font-semibold
transition
">

Login

</button>



</form>





<div class="text-center mt-8">


<p class="text-gray-500 text-sm">

Don't have an account?

</p>


<a href="{{ route('register') }}"
class="
text-pink-600
font-semibold
">

Create Account

</a>


</div>





<div class="text-center mt-5">

<a href="/"
class="
text-sm
text-gray-400
">

← Back Home

</a>

</div>


</div>


</x-guest-layout>