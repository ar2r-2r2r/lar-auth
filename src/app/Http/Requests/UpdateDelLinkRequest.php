<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateDelLinkRequest extends FormRequest
{

    private int|string $linkId;

    /**
     * @return int|string
     */
    public function getLinkId(): int|string
    {
        return $this->linkId;
    }

    /**
     * @param int|string $linkId
     */
    public function setLinkId(int|string $linkId): void
    {
        $this->linkId = $linkId;
    }


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
            'linkId' => 'required',
        ];
    }


}
