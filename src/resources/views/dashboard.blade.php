<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Growfridge System Overview') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div style="display: flex; flex-direction: row">
                        <div>
                            <p class="left">Current Temperature: {{ $temperature }} °C</p>
                            <p class="left">Set Temperature: {{ $setTemp }} / Temperature max : {{ $setTemp + $tem_delta_top }} / Temperature min : {{ $setTemp - $tem_delta_bot }}</p>
                            <br>
                            <p class="left">Current Humidity: {{ $humidity }} %</p>
                            <p class="left">Set Humidity: {{ $setHum }} / Humidity max : {{ $setHum + $hum_delta_top }} / Humidity min : {{ $setHum - $hum_delta_bot }}</p>
                            <br>
                            <p class="left">Active Condition Start: {{ $condition_start }}</p>
                            <p class="left">Active Condition End  : {{ $condition_end }}</p>
                        </div>
                        <div style="max-width: 33%; max-height: 33%; float: right; margin-left: auto;">
                            <img src="{{URL('/pic.jpg')}}" alt="Growfridge Preview">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
