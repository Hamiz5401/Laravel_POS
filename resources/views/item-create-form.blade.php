<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Create New Item') }}
        </h2>
    </x-slot>

    <html class="dark">
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    <div class="panel-body mt-10">

                        <form action="{{ route('item.create') }}" method="POST" class="form-horizontal">
                            {{ csrf_field() }}

                            <div class="flex form-group">
                                <div>
                                    <label for="item_name" class="col-sm-3 control-label">New Product name</label>
                                    <div class="col-sm-6 mt-3">
                                        <input type="text" name="new_item_name" id="new_item_name" class="form-control" value="{{ old('new_item_name') }}">
                                    </div>
                                </div>

                                <div class="ms-3">
                                    <label for="item_description" class="col-sm-3 control-label">New Product description</label>
                                    <div class="col-sm-6 mt-3">
                                        <input type="text" name="new_item_description" id="new_item_description" class="form-control" value="{{ old('new_item_description') }}">
                                    </div>
                                </div>
                                
                                <div class="ms-3">
                                    <label for="amount" class="col-sm-3 control-label">Amount</label>
                                    <div class="col-sm-6 mt-3">
                                        <input type="text" name="new_amount" id="new_amount" class="form-control" value="{{ old('new_amount') }}">
                                    </div>
                                </div>

                                <div class="ms-3">
                                    <label for="price" class="col-sm-3 control-label">Price</label>
                                    <div class="col-sm-6 mt-3">
                                        <input type="text" name="new_price" id="new_price" class="form-control" value="{{ old('new_price') }}">
                                    </div>
                                </div>
                            </div>


                            <div class="form-group mt-4">
                                <div class="col-sm-offset-3 col-sm-6">
                                    <x-primary-button class="ms-3">
                                        {{ __('Create item') }}
                                    </x-primary-button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>