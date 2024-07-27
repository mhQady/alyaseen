<div class="card mt-4">
    <div class="card-body">
        <div class="row">
            <div class="col-12">
                <div class="form-group">
                    <div class="d-flex gap-2 align-items-center mb-1">
                        <label class="mb-0">@lang('main.price')</label>
                    </div>
                    <input type="number" min="0.00" step="0.01" name="price" class="form-control"
                        value="{{ old('price',$product->price) }}">
                    @error('price')
                    <div class="text text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="col-12">
                <div class="form-group">
                    <div class="d-flex gap-2 align-items-center mb-1">
                        <label class="mb-0">@lang('main.stock')</label>
                    </div>
                    <input type="number" step="1" min="0" name="current_stock" class="form-control"
                        value="{{ old('current_stock',$product->current_stock) }}">
                    @error('current_stock')
                    <div class="text text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <div class="d-flex gap-2 align-items-center mb-1">
                        <label class="mb-0">@lang('main.min_purchase_qty')</label>
                    </div>
                    <input type="number" step="1" min="1" name="min_purchase_qty"
                        value="{{ old('min_purchase_qty',$product->min_purchase_qty) }}" class="form-control">
                    @error('min_purchase_qty')
                    <div class="text text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <div class="d-flex gap-2 align-items-center mb-1">
                        <label class="mb-0">@lang('main.max_purchase_qty')</label>
                    </div>
                    <input type="number" step="1" min="0" name="max_purchase_qty"
                        value="{{ old('max_purchase_qty',$product->max_purchase_qty) }}" class="form-control">
                    @error('max_purchase_qty')
                    <div class="text text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>
    </div>
</div>