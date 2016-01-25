<?php

namespace AFG\Http\Requests;

use AFG\Http\Requests\Request;

class chartsCategoriesRequest extends Request
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
        if(count($this->request->all())>0)
        {
            return [
                'year'=> 'required',
                'priority' => 'required'
            ];
        }

        return [
            //
        ];
    }
}
