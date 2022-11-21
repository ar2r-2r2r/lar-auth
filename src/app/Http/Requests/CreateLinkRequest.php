<?php

namespace App\Http\Requests;
use App\Models\LinkDetails;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class CreateLinkRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function getLinkDetails(CreateLinkRequest $request):LinkDetails{
        $linkDetails = new LinkDetails();
        $linkDetails->setOriginalUrl($request->originalUrl);
        $linkDetails->setIsPublic($request->isPublic);
        return $linkDetails;
    }
    public function rules(): array
    {
        return [
            'originalUrl' => 'required|unique:links',
            'isPublic'=>'required',
        ];
    }
    public function messages(): array
    {
        return[
            'originalUrl.required'=>'A originalUrl is required',
            'isPublic'=>'A isPublic  is required',
        ];
    }
}
