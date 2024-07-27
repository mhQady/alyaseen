<div id="physical_fields" @class(['card','mb-4', 'd-none'=> old('type', $product->type) !=
   \App\Enums\Product\ProductTypes::Physical->value])>
   <div class="card-body">
      <div class="d-flex justify-content-between">
         <h6>@lang('main.require_shipping')</h6>
         <div class="form-check form-switch ms-1">
            <input class="form-check-input" @checked(old('require_shipping',$product->data['require_shipping'] ?? null)
            == 1)
            name="data[require_shipping]" value="1" type="checkbox" id="showPhysicalFieldsCheck">
            <label class="form-check-label" for="showPhysicalFieldsCheck"></label>
         </div>
         @error('data.require_shipping')
         <div class="text text-danger">{{ $message }}</div>
         @enderror
      </div>
      <div class="row mt-2" id="physical_fields-container">
         <div class="col-12 col-sm-12 mt-3 mt-sm-0">
            <div class="row">
               <div class="col-12">
                  <label class="control-label">@lang('main.weight')</label>
                  <div class="input-group">
                     <input type="number" class="form-control" name="data[weight]" min="1" step="any"
                        value="{{ old('weight',$product->data['weight'] ?? null) }}">
                     @error('data.weight')
                     <div class="text text-danger">{{ $message }}</div>
                     @enderror
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
