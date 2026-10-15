<x-guest-layout>

<h2 class="text-3xl font-bold text-[#172033]">
Create Account
</h2>

<p class="mt-2 text-gray-500">
Join BeautyStore today
</p>


<form method="POST" action="{{ route('register') }}" class="mt-8">

@csrf


<div>

<x-input-label for="name" value="Name"/>

<x-text-input
id="name"
class="block mt-2 w-full rounded-xl"
type="text"
name="name"
:value="old('name')"
required autofocus />

<x-input-error :messages="$errors->get('name')" />

</div>



<div class="mt-5">

<x-input-label for="email" value="Email"/>

<x-text-input
id="email"
class="block mt-2 w-full rounded-xl"
type="email"
name="email"
:value="old('email')"
required />

<x-input-error :messages="$errors->get('email')" />

</div>



<div class="mt-5">

<x-input-label for="password" value="Password"/>

<x-text-input
id="password"
class="block mt-2 w-full rounded-xl"
type="password"
name="password"
required />

</div>




<div class="mt-5">

<x-input-label 
for="password_confirmation"
value="Confirm Password"/>


<x-text-input
id="password_confirmation"
class="block mt-2 w-full rounded-xl"
type="password"
name="password_confirmation"
required />


</div>



<button
class="mt-7 w-full bg-pink-600 text-white py-3 rounded-xl">

Register

</button>


</form>



<div class="text-center mt-6">

<a href="{{ route('login') }}"
class="text-pink-600">

Already have account?

</a>

</div>


</x-guest-layout>