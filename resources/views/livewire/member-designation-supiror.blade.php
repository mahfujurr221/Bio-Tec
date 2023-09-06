<div class="col-12">
    <div class="row">
        <div class="form-group col-md-6" wire:model="designation_id">
            <label for="">Designation</label>
            <select name="sales_designation_id" id="" class="form-control" wire:model.defer="designation_id">
                @foreach (\App\SalesDesignation::get() as $item)
                    <option value="{{ $item->id }}" {{ old('sales_designation_id') == $item->id ? 'SELECTED' : '' }}>
                        {{ $item->name }}</option>
                @endforeach
            </select>
            @if ($errors->has('sales_designation_id'))
                <div class="alert alert-danger">{{ $errors->first('sales_designation_id') }}</div>
            @endif
        </div>

        @if ($designation_id)
            @php
                $designation = \App\SalesDesignation::find($designation_id);
                $next_designation = \App\SalesDesignation::where('id', '>', $designation_id)->where('level', '>', $designation->level)
                    ->orderBy('level')
                    ->first();
                if ($next_designation) {
                    //if auth role is warehouse admin 
                    if (auth()->user()->hasRole('WarehouseAdmin')) {
                        $supiriors = \App\SalesMember::where('warehouse_id', auth()->user()->warehouse_id)
                            ->where('sales_designation_id', $next_designation->id);
                    } else {
                        $supiriors = \App\SalesMember::where('sales_designation_id', $next_designation->id);
                    }
                    if ($sales_member) {
                        $supiriors = $supiriors->where('id', '!=', $sales_member->id);
                    }
                    $supiriors = $supiriors->get();
                } else {
                    $supiriors = collect([]);
                }
            @endphp
            {{-- @if ($supiriors->count()) --}}
            <div class="form-group col-md-6">
                <label for="">Supiror</label>
                <select name="supirior_id" id="" class="form-control" wire:model.defer="supirior_id">
                    @foreach ($supiriors as $item)
                        <option value="{{ $item->id }}" {{ old('supirior_id') == $item->id ? 'SELECTED' : '' }}>
                            {{ $item->name }} - {{ $item->designation->name }}({{ $item->warehouse->name }}) </option>
                    @endforeach
                </select>
                @if ($errors->has('supirior_id'))
                    <div class="alert alert-danger">{{ $errors->first('supirior_id') }}</div>
                @endif
            </div>
            {{-- @endif --}}
        @endif
    </div>
</div>
