<?php

namespace App\Http\Requests;
use App\Models\LinkDetails;
use Illuminate\Foundation\Http\FormRequest;

class CreateLinkRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'originalUrl' => 'required|unique:links',
            'isPublic'=>'required',
        ];
    }
    public function messages()
    {
        return[
            'originalUrl.required'=>'A originalUrl is required',
            'isPublic'=>'A isPublic  is required',
        ];
    }
}
