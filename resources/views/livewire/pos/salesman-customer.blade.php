<div>
    <div class="form-group">
        <label for="">Salesman</label>
        <select name="sales_member_id" id="" class="form-control" data-provide="selectpicker"
            data-live-search="true" data-size="10" wire:model="sales_man">
            <option value="">Select Salesman</option>
            @foreach (\App\SalesMember::where('sales_designation_id', 1)->get() as $item)
                <option value="{{ $item->id }}" {{ old('sales_member_id') == $item->id ? 'SELECTED' : '' }}>
                    {{ $item->name }}</option>
            @endforeach
        </select>
        @if ($errors->has('sales_member_id'))
            <div class="alert alert-danger">{{ $errors->first('sales_member_id') }}</div>
        @endif
    </div>

    <div class="form-group">
        <div class="row">
            <div class="col-10">
                <label for="">Customer</label>
                <select name="customer_id" id="" class="form-control" data-provide="selectpicker"
                    data-live-search="true" data-size="10">
                    <option value="">Select Customer</option>
                    @foreach ($customers as $item)
                        <option value="{{ $item->id }}" {{ old('customer_id') == $item->id ? 'SELECTED' : '' }}>
                            {{ $item->name }}</option>
                    @endforeach
                </select>
                @if ($errors->has('customer_id'))
                    <div class="alert alert-danger">{{ $errors->first('customer_id') }}</div>
                @endif
            </div>
            <div class="col-2 mt-2">
              <br>
                <a href="" class="btn btn-primary" data-toggle="modal" data-target="#customerAddModal">Add
                    Customer</a>
            </div>
        </div>
    </div>
</div>
