<?php

namespace AFG\Http\Requests;

use AFG\Http\Requests\Request;

class ProjectRequest extends Request
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
            'region_id' => 'required',
            'category_id' => 'required',
            'location_id' => 'required',
            'project_description' => 'required',
            'client_id' => 'required',
            'priority_number' => 'required',
            'priority_id' => 'required',
            'year' => 'required',
        ];
    }
}
