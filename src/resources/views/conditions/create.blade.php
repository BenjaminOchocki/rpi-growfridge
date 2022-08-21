<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Create Condition') }}
        </h2>
    </x-slot>

    <div class="font-sans antialiased">
        <div class="flex flex-col items-center min-h-screen pt-6 bg-gray-100 sm:pt-0">

            <div class="max-w-7xl px-16 py-20 mt-6 overflow-hidden bg-white rounded-lg lg:max-w-4xl"style="min-width: 768px">

                <div class="max-w-7xl px-6 py-4 bg-white rounded shadow-md ring-1 ring-gray-900/10">
                    <form method="POST" action="{{ route('conditions.store') }}">
                        @csrf
                        <!-- name -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700" for="name">
                                name
                            </label>

                            <input
                                class="block w-full mt-1 border-gray-300 rounded-md shadow-sm placeholder:text-gray-400 placeholder:text-right focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                                type="text" name="name" placeholder="256" value="{{old('name')}}">
                            @error('name')
                            <span class="text-red-600 text-sm">
                                {{ $message }}
                            </span>
                            @enderror
                        </div>

                        <!-- Info -->
                        <div class="mt-4">
                            <label class="block text-sm font-medium text-gray-700" for="info">
                                Info
                            </label>
                            <textarea name="info"
                                      class="block w-full mt-1 border-gray-300 rounded-md shadow-sm placeholder:text-gray-400 placeholder:text-right focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                                      rows="4" placeholder="400"> {{old('info')}}</textarea>
                            @error('info')
                            <span class="text-red-600 text-sm">
                                {{ $message }}
                            </span>
                            @enderror
                        </div>

                        <!-- light_white -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700" for="light_white">
                                Light white status (0=off, 1=on)
                            </label>

                            <input
                                class="block w-full mt-1 border-gray-300 rounded-md shadow-sm placeholder:text-gray-400 placeholder:text-right focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                                type="text" name="light_white" placeholder="1" value="{{old('light_white')}}">
                            @error('light_white')
                            <span class="text-red-600 text-sm">
                                {{ $message }}
                            </span>
                            @enderror
                        </div>

                        <!-- light_red -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700" for="light_red">
                                Light red status (0=off, 1=on)
                            </label>

                            <input
                                class="block w-full mt-1 border-gray-300 rounded-md shadow-sm placeholder:text-gray-400 placeholder:text-right focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                                type="text" name="light_red" placeholder="1" value="{{old('light_red')}}">
                            @error('light_red')
                            <span class="text-red-600 text-sm">
                                {{ $message }}
                            </span>
                            @enderror
                        </div>

                        <!-- temperature -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700" for="temperature">
                                Temperature
                            </label>

                            <input
                                class="block w-full mt-1 border-gray-300 rounded-md shadow-sm placeholder:text-gray-400 placeholder:text-right focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                                type="text" name="temperature" placeholder="5" value="{{old('temperature')}}">
                            @error('temperature')
                            <span class="text-red-600 text-sm">
                                {{ $message }}
                            </span>
                            @enderror
                        </div>

                        <!-- temp_delta_top -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700" for="temp_delta_top">
                                Temperature delta top
                            </label>

                            <input
                                class="block w-full mt-1 border-gray-300 rounded-md shadow-sm placeholder:text-gray-400 placeholder:text-right focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                                type="text" name="temp_delta_top" placeholder="5" value="{{old('temp_delta_top')}}">
                            @error('temp_delta_top')
                            <span class="text-red-600 text-sm">
                                {{ $message }}
                            </span>
                            @enderror
                        </div>

                        <!-- temp_delta_bot -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700" for="temp_delta_bot">
                                Temperature delta bot
                            </label>

                            <input
                                class="block w-full mt-1 border-gray-300 rounded-md shadow-sm placeholder:text-gray-400 placeholder:text-right focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                                type="text" name="temp_delta_bot" placeholder="5" value="{{old('temp_delta_bot')}}">
                            @error('temp_delta_bot')
                            <span class="text-red-600 text-sm">
                                {{ $message }}
                            </span>
                            @enderror
                        </div>

                        <!-- humidity -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700" for="humidity">
                                Humidity
                            </label>

                            <input
                                class="block w-full mt-1 border-gray-300 rounded-md shadow-sm placeholder:text-gray-400 placeholder:text-right focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                                type="text" name="humidity" placeholder="5" value="{{old('humidity')}}">
                            @error('humidity')
                            <span class="text-red-600 text-sm">
                                {{ $message }}
                            </span>
                            @enderror
                        </div>

                        <!-- hum_delta_top -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700" for="hum_delta_top">
                                Humidity delta top
                            </label>

                            <input
                                class="block w-full mt-1 border-gray-300 rounded-md shadow-sm placeholder:text-gray-400 placeholder:text-right focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                                type="text" name="hum_delta_top" placeholder="5" value="{{old('hum_delta_top')}}">
                            @error('hum_delta_top')
                            <span class="text-red-600 text-sm">
                                {{ $message }}
                            </span>
                            @enderror
                        </div>

                        <!-- hum_delta_bot -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700" for="hum_delta_bot">
                                Humidity delta bot
                            </label>

                            <input
                                class="block w-full mt-1 border-gray-300 rounded-md shadow-sm placeholder:text-gray-400 placeholder:text-right focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                                type="text" name="hum_delta_bot" placeholder="5" value="{{old('hum_delta_bot')}}">
                            @error('hum_delta_bot')
                            <span class="text-red-600 text-sm">
                                {{ $message }}
                            </span>
                            @enderror
                        </div>

                        <div class="flex items-center justify-start mt-4">
                            <button type="submit"
                                    class="inline-flex items-center px-6 py-2 text-sm font-semibold rounded-md text-sky-100 bg-sky-500 hover:bg-sky-700 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300"
                                    style="border: 1px solid #212529">
                                Save
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
