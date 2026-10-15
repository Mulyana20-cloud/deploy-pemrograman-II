<x-guest-layout>


<h2 class="text-3xl font-bold">
Forgot Password
</h2>


<p class="mt-3 text-gray-500">

Enter your email and we will send password reset link.

</p>



<form method="POST" action="{{ route('password.email') }}" class="mt-8">

@csrf


<x-input-label
for="email"
value="Email"
/>


<x-text-input
id="email"
class="block mt-2 w-full rounded-xl"
type="email"
name="email"
required
/>


<x-input-error :messages="$errors->get('email')" />


<button
class="mt-7 w-full bg-pink-600 text-white py-3 rounded-xl">

Send Reset Link

</button>


</form>


</x-guest-layout>