<html class="dark">
<div class="panel-body mt-10">

    <form action="{{ route('saleLineItem.create') }}" method="POST" class="form-horizontal">
        {{ csrf_field() }}

        <input type="hidden" name="sale_id" value="{{ $sale->id }}">

        <div class="flex form-group">
            <div>
                <label for="item_id" class="col-sm-3 control-label">Product</label>
                <div class="col-sm-6 mt-3">
                    <select name="item_id" id="item_id" class="form-control dark:bg-gray-900">
                            <option value="none">select a product</option>
                            @foreach($items as $option)
                                @if(old('item_id') == $option->id)
                                    <option value="{{ $option->id }}" selected="true">{{ $option->name }} -- {{ $option->price }} baht</option>
                                @else
                                    <option value="{{ $option->id }}">{{ $option->name }} -- {{ $option->price }} baht</option>
                                @endif
                            @endforeach
                    </select>
                </div>
            </div>
            
            <div class="ms-3">
                <label for="amount" class="col-sm-3 control-label">Amount</label>
                <div class="col-sm-6 mt-3 dark:bg-gray-900">
                    <input type="text" name="amount" id="amount" class="form-control dark:bg-gray-900" value="{{ old('amount') }}">
                </div>
            </div>

            <div class="col-sm-offset-3 col-sm-6 mt-10">
                <x-primary-button class="ms-3">
                    {{ __('Add to SaleLineItem') }}
                </x-primary-button>
            </div>
        </div>

    </form>
</div>