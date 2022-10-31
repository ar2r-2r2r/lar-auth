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
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'originalUrl' => 'required',
            'isPublic'=>'required',
            new linkDetails('originalUrl', 'isPublic'),
        ];
    }
}
