@props(['disabled' => false])

<input 
    @disabled($disabled)

    {{ $attributes->merge([
        'class' => '
            w-full
            rounded-xl
            border
            border-gray-300
            bg-white
            text-gray-900
            placeholder-gray-400
            px-4
            py-3
            focus:border-pink-500
            focus:ring-pink-500
        '
    ]) }}

>