<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Item') }}
        </h2>
    </x-slot>
    
    <html class="dark">
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    <div class="text-l relative overflow-x-auto">
                        @if(count($items) > 0)
                        <table class="w-full text-left text-gray-500 dark:text-gray-400">
                            <thead class="text-xs text-left text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th class="px-6 py-4">
                                        Product name
                                    </th>
                                    <th class="px-6 py-4">
                                        Description
                                    </th>
                                    <th class="px-6 py-4">
                                        In Stock
                                    </th>
                                    <th class="px-6 py-4">
                                        Price
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="text-left">
                            @foreach($items as $item)
                                <tr>
                                    <form action="{{ route('item.update') }}" method="POST" class="form-horizontal">
                                    @csrf
                                    @method('patch')

                                    <input type="hidden" name="item_id" value="{{ $item->id }}">

                                    <td class="px-6 py-4 text-center"><input class="dark:bg-gray-900" name="name" id="name" value="{{ $item->name }}"></td>
                                    <td class="px-6 py-4 text-center"><input class="dark:bg-gray-900" name="description" id="description" value="{{ $item->description }}"></td>
                                    <td class="px-6 py-4 text-center"><input class="dark:bg-gray-900" name="amount" id="amount" value="{{ $item->amount }}"></td>
                                    <td class="px-6 py-4 text-center"><input class="dark:bg-gray-900" name="price" id="price" value="{{ $item->price }}"></td>
                                    <td class="px-6 py-4 text-center">
                                        <x-primary-button class="mt-4">
                                            {{ __('Confirm Edit') }}
                                        </x-primary-button>
                                    </td>
                                    </form>
                                    <td>
                                        <form action="{{ route('item.destroy') }}" method="POST" class="form-horizontal">
                                        @csrf
                                        @method('delete')
                                        <input type="hidden" name="item_id" value="{{ $item->id }}">
                                        <x-primary-button class="mt-4">
                                            {{ __('Delete') }}
                                        </x-primary-button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        @endif
                    </div>


                </div>
                <x-link-button
                        tag="a"
                        href="{{route('items-create')}}"
                        class="mt-4 ml-4 mb-4"
                >
                    Add item
                </x-link-button>
            </div>
        </div>
    </div>
</x-app-layout>