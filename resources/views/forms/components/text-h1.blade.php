<script defer src="https://unpkg.com/alpinejs-money@latest/dist/money.min.js"></script>
<x-dynamic-component
    :component="$getFieldWrapperView()"
    :field="$field"
>

@php
    // Store the unformatted price in a component property
    $price = number_format($getState(),2);
    $bg = $getBackgroundColor();
@endphp

    <div 
    x-data="{ 
        state: $wire.$entangle('{{ $getStatePath() }}') 
    }">
       <div class="text-7xl flex justify-end {{ $bg }}">
            <h1 >{{ $price }}</h1>
            <h1 class="ml-8"> บาท</h1>
       </div>
    </div>
</x-dynamic-component>
