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
    public function authorize(): bool
    {
        return true;
    }

    public function getLinkDetails(CreateLinkRequest $request): LinkDetails
    {
        $linkDetails = new LinkDetails();
        $linkDetails->setOriginalUrl($request->originalUrl);
        $linkDetails->setIsPublic($request->isPublic);

        return $linkDetails;
    }

    public function rules(): array
    {
        return [
            'originalUrl' => 'required',
            'isPublic' => 'required',
        ];
    }


}

