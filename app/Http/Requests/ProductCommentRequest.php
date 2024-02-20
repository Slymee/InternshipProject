<?php
declare(strict_types=1);
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductCommentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'product_id' => ['required', 'bail'],
            'user_id' => ['required', 'bail'],
            'comment' => ['required', 'bail'],
            'comment_image' => ['nullable','image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048'],
        ];
    }
}
