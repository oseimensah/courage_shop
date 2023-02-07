@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'block w-full sm:text-sm  border border-gray-300 px-4 py-2 text-gray-600 text-sm rounded focus:ring-0 focus:border-primary placeholder-gray-400']) !!}>
