<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Manage Items') }}
        </h2>
    </x-slot>
    
    <html class="dark">
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="flex items-center gap-4 text-l mb-5">
                        <h3 class="text-lg font-semibold">Item Management Page</h3>
                        <p class="text-gray-600 dark:text-gray-400">-- Here you can manage the items information.</p>
                    </div>

                    <div class="text-lg overflow-x-auto">
                        @if(count($items) > 0)
                        <div class="overflow-hidden border border-gray-200 dark:border-gray-700 sm:rounded-lg">
                            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                                <thead class="bg-gray-50 dark:bg-gray-700">
                                    <tr>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                            Product Name
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                            Description
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                            In Stock
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                            Price
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                            Actions
                                        </th>
                                        <th>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="bg-gray-500 divide-y divide-gray-200 dark:divide-gray-700">
                                    @foreach($items as $item)
                                    <tr>
                                        <form action="{{ route('item.update') }}" method="POST" class="form-horizontal">
                                            @csrf
                                            @method('patch')
                                            <input type="hidden" name="item_id" value="{{ $item->id }}">
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <input class="dark:bg-gray-900 border border-gray-300 rounded-md px-2 py-1" name="name" id="name" value="{{ $item->name }}">
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <input class="dark:bg-gray-900 border border-gray-300 rounded-md px-2 py-1" name="description" id="description" value="{{ $item->description }}">
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <input class="dark:bg-gray-900 border border-gray-300 rounded-md px-2 py-1" name="amount" id="amount" value="{{ $item->amount }}">
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <input class="dark:bg-gray-900 border border-gray-300 rounded-md px-2 py-1" name="price" id="price" value="{{ $item->price }}">
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                                <button type="submit" class="dark:bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                                    {{ __('Update') }}
                                                </button>
                                            </td>
                                        </form>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                            <form action="{{ route('item.destroy') }}" method="POST" class="form-horizontal">
                                                        @csrf
                                                        @method('delete')
                                                        <input type="hidden" name="item_id" value="{{ $item->id }}">
                                                        <button type="submit" class="dark:bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded ml-3">
                                                            {{ __('Delete') }}
                                                        </button>
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        @else
                            <p class="mt-4 text-center">No items found.</p>
                        @endif
                    </div>

                </div>
                <div class="flex justify-end">
                    <x-link-button
                            tag="a"
                            href="{{ route('items-create') }}"
                            class="mt-4 mr-4 mb-4 dark:bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded"
                    >
                        {{ __('Add New Item') }}
                    </x-link-button>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
