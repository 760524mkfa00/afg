<?php

namespace AFG\Http\Requests;

use AFG\Http\Requests\Request;

class InvoiceRequest extends Request
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
     * @return array
     */
    public function rules()
    {
        return [
            'scope' => 'required',
            'invoice' => 'required',
            'fees' => 'required|numeric',
            'taxRate_id' => 'required|numeric',
        ];
    }
}
