@props(['user' => null, 'size' => 'md', 'class' => ''])

@php
$user = $user ?? Auth::user();
$sizeClasses = [
    'xs' => 'w-6 h-6 text-xs',
    'sm' => 'w-8 h-8 text-sm',
    'md' => 'w-10 h-10 text-sm',
    'lg' => 'w-16 h-16 text-lg',
    'xl' => 'w-20 h-20 text-xl',
    '2xl' => 'w-24 h-24 text-2xl'
];
$avatarSize = $sizeClasses[$size] ?? $sizeClasses['md'];
@endphp

<div class="rounded-full bg-gray-200 overflow-hidden {{ $avatarSize }} {{ $class }}">
    @if($user && $user->avatar_url)
        <img src="{{ $user->avatar_url }}" alt="{{ $user->name }}" class="w-full h-full object-cover">
    @elseif($user)
        <div class="w-full h-full flex items-center justify-center bg-primary text-white font-bold">
            {{ $user->initials }}
        </div>
    @else
        <div class="w-full h-full flex items-center justify-center bg-gray-300 text-gray-600 font-bold">
            ?
        </div>
    @endif
</div>