<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Sale') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="flex items-center gap-4 text-l mb-5">
                        <h3 class="text-lg font-semibold">Sale Management Page</h3>
                        <p class="text-gray-600 dark:text-gray-400">-- Here you can manage the sale information.</p>
                    </div>
                    <div class="text-l relative overflow-x-auto">
                        @if(count($sale_items) > 0)
                        <div class="overflow-hidden border border-gray-200 dark:border-gray-700 sm:rounded-lg">
                            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                                <thead class="bg-gray-50 dark:bg-gray-700">
                                    <tr>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                            Product name
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                            Quantity
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                            Total Price
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                            Actions
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="bg-gray-500 divide-y divide-gray-200 dark:divide-gray-700">
                                    @foreach($sale_items as $sale_item)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 dark:text-gray-100">{{ $sale_item->item->name }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">{{ $sale_item->amount }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">{{ $sale_item->total_price }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                            <form action="{{ route('saleLineItem.delete') }}" method="POST" class="form-horizontal">
                                                @csrf
                                                @method('delete')

                                                <input type="hidden" name="id" value="{{ $sale_item->id }}">
                                                <button type="submit" class="bg-red-500 hover:bg-red-600 text-white py-1 px-3 rounded-lg transition duration-300 ease-in-out">Remove</button>
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        @else
                        <p class="mt-4 text-gray-600 dark:text-gray-400">No sale items found.</p>
                        @endif
                    </div>

                    <div class="py-4 mt-3 text-xl font-bold">
                        Grand Total: {{ $total_price }} baht

                        <div class="flex py-4">
                            <form action="{{ route('payment.update_member') }}" method="POST" class="form-horizontal">
                                {{ csrf_field() }}
                                @method("patch")
                                <div class="flex items-center">
                                    <div class="mt-3">
                                        <label for="citizen_id">CitizenID</label>
                                    </div>
                                    <div class="mt-3">
                                        <input name="citizen_id" id="citizen_id" value="{{ old('citizen_id') }}" class="dark:bg-gray-900 ml-5">
                                    </div>
                                    <input type="hidden" name="sale_id" value="{{ $sale_id }}">
                                    <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 ml-4 rounded mt-3">
                                        {{ __('Add member') }}
                                    </button>
                                </div>
                            </form>

                            <form action="{{ route('payment.update') }}" method="POST" class="form-horizontal ml-4">
                                {{ csrf_field() }}
                                @method("patch")
                                <div>
                                    <input type="hidden" name="sale_id" value="{{ $sale_id }}">
                                    <button type="submit" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded mt-3">
                                        {{ __('Pay') }}
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>

                    @include('sale.sale-create-form')

                    
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
