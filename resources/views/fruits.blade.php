<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Fruits') }}
        </h2>
    </x-slot>

    <section class="bg-gray-50 dark:bg-gray-900 p-3 sm:p-5">
        <div class="mx-auto max-w-screen-xl px-4 lg:px-12">
            @if($errors->hasBag('fruit'))
            @foreach($errors->fruit->all() as $key => $error)
            <div id="fruitAlert{{$key}}"
                 class="flex items-center p-4 mb-4 text-red-800 bg-red-50 dark:text-red-400 dark:bg-gray-800 dark:border-red-800"
                 role="alert">
                <div class="ms-3 text-sm font-medium">
                    {{ $error }}
                </div>
                <button
                    type="button"
                    class="ms-auto -mx-1.5 -my-1.5 bg-red-50 text-red-500 rounded-lg focus:ring-2 focus:ring-red-400 p-1.5 hover:bg-red-200 inline-flex items-center justify-center h-8 w-8 dark:bg-gray-800 dark:text-red-400 dark:hover:bg-gray-700"
                    data-dismiss-target="#fruitAlert{{$key}}"
                    aria-label="Close">
                    <span class="sr-only">Dismiss</span>
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                         viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                </button>
            </div>
            @endforeach
            @endif

            <!-- Start coding here -->
            <div class="bg-white dark:bg-gray-800 relative shadow-md sm:rounded-lg overflow-hidden">
                <div
                    class="flex flex-col md:flex-row items-center justify-end space-y-3 md:space-y-0 md:space-x-4 p-4">
                    <div
                        class="w-full md:w-auto flex flex-col md:flex-row space-y-2 md:space-y-0 items-stretch md:items-center justify-end md:space-x-3 flex-shrink-0">
                        <button type="button"
                                data-modal-target="addFruitModal"
                                data-modal-toggle="addFruitModal"
                                class="flex items-center justify-center text-white bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-primary-600 dark:hover:bg-primary-700 focus:outline-none dark:focus:ring-primary-800">
                            <svg class="h-3.5 w-3.5 mr-2" fill="currentColor" viewbox="0 0 20 20"
                                 xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                <path clip-rule="evenodd" fill-rule="evenodd"
                                      d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z"/>
                            </svg>
                            {{ __('Add Fruit') }}
                        </button>
                    </div>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-4 py-3">{{ __('Fruit Name') }}</th>
                            <th scope="col" class="px-4 py-3">{{ __('Category') }}</th>
                            <th scope="col" class="px-4 py-3">{{ __('Unit') }}</th>
                            <th scope="col" class="px-4 py-3">{{ __('Price') }}</th>
                            <th scope="col" class="px-4 py-3">{{ __('Date Created') }}</th>
                            <th scope="col" class="px-4 py-3">{{ __('Last Updated') }}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if($fruits->total() > 0)
                        @foreach($fruits as $fruit)
                        <tr class="border-b dark:border-gray-700">
                            <td scope="row"
                                class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">{{
                                $fruit->name }}
                            </td>
                            <td scope="row"
                                class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">{{
                                $fruit->category->name }}
                            </td>
                            <td scope="row"
                                class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">{{
                                $fruit->unit }}
                            </td>
                            <td scope="row"
                                class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">{{
                                $fruit->price }}
                            </td>
                            <td class="px-4 py-3">{{ \Carbon\Carbon::parse($fruit->created_at)->toDateTimeString()
                                }}
                            </td>
                            <td class="px-4 py-3">{{ \Carbon\Carbon::parse($fruit->updated_at)->toDateTimeString()
                                }}
                            </td>
                        </tr>
                        @endforeach
                        @else
                        <tr class="border-b dark:border-gray-700">
                            <td colspan="6"
                                scope="row"
                                class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{ __('No fruits created yet.') }}
                            </td>
                        </tr>
                        @endif
                        </tbody>
                    </table>
                </div>
                <nav
                    class="flex flex-col md:flex-row justify-between items-start md:items-center space-y-3 md:space-y-0 p-4"
                    aria-label="Table navigation">
                <span class="text-sm font-normal text-gray-500 dark:text-gray-400">
                    Per Page:
                    <span class="font-semibold text-gray-900 dark:text-white">{{ $fruits->perPage() }}</span>
                    | Total:
                    <span class="font-semibold text-gray-900 dark:text-white">{{ $fruits->total() ?? 0}}</span>
                </span>
                    @if($fruits->hasPages())
                    <ul class="inline-flex items-stretch -space-x-px">
                        <li>
                            <a href="{{ $fruits->previousPageUrl() }}"
                               class="flex items-center justify-center h-full py-1.5 px-3 ml-0 text-gray-500 bg-white rounded-l-lg border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
                                <span class="sr-only">Previous</span>
                                <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewbox="0 0 20 20"
                                     xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd"
                                          d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z"
                                          clip-rule="evenodd"/>
                                </svg>
                            </a>
                        </li>
                        @for ($i = 1; $i <= $fruits->lastPage(); $i++)
                        <li>
                            <a href="{{ $fruits->url($i)}}"
                               @if($i== $fruits->currentPage())
                                style="pointer-events: none"
                                @endif
                                class="flex items-center justify-center text-sm py-2 px-3 leading-tight text-gray-500
                                bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800
                                dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700
                                dark:hover:text-white">{{$i}}</a>
                        </li>
                        @endfor


                        <li>
                            <a href="{{ $fruits->nextPageUrl() }}"
                               class="flex items-center justify-center h-full py-1.5 px-3 leading-tight text-gray-500 bg-white rounded-r-lg border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
                                <span class="sr-only">Next</span>
                                <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewbox="0 0 20 20"
                                     xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd"
                                          d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                          clip-rule="evenodd"/>
                                </svg>
                            </a>
                        </li>
                    </ul>
                    @endif
                </nav>

                <!-- Main modal -->
                <div id="addFruitModal" tabindex="-1" aria-hidden="true"
                     class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                    <div class="relative p-4 w-full max-w-md max-h-full">
                        <!-- Modal content -->
                        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                            <!-- Modal header -->
                            <div
                                class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                                    {{__('Create New Fruit')}}
                                </h3>
                                <button type="button"
                                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                                        data-modal-toggle="addFruitModal">
                                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                         fill="none" viewBox="0 0 14 14">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                              stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                    </svg>
                                    <span class="sr-only">Close modal</span>
                                </button>
                            </div>
                            <!-- Modal body -->
                            <form class="p-4 md:p-5" action="{{route('fruit.store')}}" method="POST">
                                @csrf
                                <div class="grid gap-4 mb-4 grid-cols-2">
                                    <div class="col-span-2">
                                        <label for="category_id"
                                               class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{__('Select
                                            a category') }}</label>
                                        <select id="category_id"
                                                name="category_id"
                                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                            @foreach($categoryOptions as $key => $option)
                                            <option value="{{$option['value']}}" @if(0== $key) selected @endif>
                                                {{$option['label']}}
                                            </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-span-2">
                                        <label for="name"
                                               class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{
                                            __('Name')}}</label>
                                        <input type="text" name="name" id="name" value="{{old('name')}}"
                                               class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                               placeholder="{{__('Type fruit name') }}" required="">
                                    </div>
                                    <div class="col-span-2">
                                        <label for="unit"
                                               class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{__('Select
                                            a unit') }}</label>
                                        <select id="unit"
                                                name="unit"
                                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                            <option value="pcs" selected>Pcs</option>
                                            <option value="kg">Kg</option>
                                            <option value="pack">Pack</option>
                                        </select>
                                    </div>
                                    <div class="col-span-2">
                                        <label for="price"
                                               class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{
                                            __("Price") }}</label>
                                        <input type="number"
                                               id="price"
                                               name="price"
                                               aria-describedby="helper-text-explanation"
                                               class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                               placeholder="123" required/>
                                    </div>
                                </div>
                                <button type="submit"
                                        class="text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                    <svg class="me-1 -ms-1 w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                                         xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd"
                                              d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"
                                              clip-rule="evenodd"></path>
                                    </svg>
                                    {{ __('Add new fruit') }}
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-app-layout>
