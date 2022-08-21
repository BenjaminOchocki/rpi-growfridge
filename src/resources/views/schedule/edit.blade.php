<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Edit Schedule Entry') }}
        </h2>
    </x-slot>

    <div class="font-sans antialiased">
        <div class="flex flex-col items-center min-h-screen pt-6 bg-gray-100 sm:pt-0">

            <div class="w-full px-16 py-20 mt-6 overflow-hidden bg-white rounded-lg lg:max-w-4xl">

                <div class="w-full px-6 py-4 bg-white rounded shadow-md ring-1 ring-gray-900/10">
                    <form method="POST" action="{{ route('schedule.update',$schedule->id) }}">
                        @csrf
                        @method('PUT')
                        <!-- condition_id -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700" for="condition_id">
                                Condition
                            </label>

                            <select name="condition_id" class="form-control">
                                @foreach($conditions as $condition)
                                    @if($condition->id == $schedule->condition_id)
                                        <option value="{{$condition->id}}" selected>{{$condition->name}}</option>
                                    @else
                                        <option value="{{$condition->id}}">{{$condition->name}}</option>
                                    @endif
                                @endforeach
                            </select>
                            @error('condition_id')
                            <span class="text-red-600 text-sm">
                                {{ $message }}
                            </span>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700" for="condition_start">
                                Condition start
                            </label>

                            <input
                                class="block w-full mt-1 border-gray-300 rounded-md shadow-sm placeholder:text-gray-400 placeholder:text-right focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                                type="text" name="condition_start" placeholder="256" value="{{old('condition_start',$schedule->condition_start)}}">
                            @error('condition_start')
                            <span class="text-red-600 text-sm">
                                {{ $message }}
                            </span>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700" for="condition_end">
                                Condition end
                            </label>

                            <input
                                class="block w-full mt-1 border-gray-300 rounded-md shadow-sm placeholder:text-gray-400 placeholder:text-right focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                                type="text" name="condition_end" placeholder="256" value="{{old('condition_end',$schedule->condition_end)}}">
                            @error('condition_end')
                            <span class="text-red-600 text-sm">
                                {{ $message }}
                            </span>
                            @enderror
                        </div>

                        <div class="flex items-center justify-start mt-4">
                            <button type="submit"
                                    class="inline-flex items-center px-6 py-2 text-sm font-semibold rounded-md text-sky-100 bg-sky-500 hover:bg-sky-700 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300">
                                Update
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
