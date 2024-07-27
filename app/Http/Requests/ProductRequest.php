<?php

namespace App\Http\Requests;

use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use App\Enums\Product\StatusEnum;
use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }


    public function rules(): array
    {
        return [
            'name' => ['required', 'array'],
            'name.*' => ['required', 'string', 'min:3', 'max:255'],
            'description' => ['required', 'array'],
            'description.*' => ['nullable', 'string', 'min:3', 'max:3000'],
            'slug' => ['required', 'string', Rule::unique('products')->ignore($this->product)],
            'min_purchase_qty' => ['required', 'integer', 'min:1'],
            'max_purchase_qty' => ['required', 'integer', 'min:0'],
            'price' => ['required', 'numeric'],
            'sku' => ['required', 'string', Rule::unique('products')->ignore($this->product)],
            'current_stock' => ['required', 'integer', 'min:0'],
            'status' => ['required', 'integer', Rule::in(StatusEnum::values())],
            'category_id' => ['required', 'integer', 'exists:categories,id'],
        ];
    }

    protected function prepareForValidation(): void
    {
        $this->merge(['slug' => Str::slug($this->name['en'] ?? $this->name['ar'])]);

        // if (!is_array($this->files_ids))
        //     $this->merge(['files_ids' => explode(',', $this->files_ids)]);
    }
}
