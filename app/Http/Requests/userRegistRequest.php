<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class userRegistRequest extends FormRequest
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
/*            'nick_name' => 'required',
            'email' => 'required',
            'year' => 'required|integer|between:1950,2050',
            'month' => 'required|integer|between:01,12',
            'day' => 'required|integer|between:01,31',
            'postalcode' => 'required',
            'address' => 'required',
            'job_kind' => 'required',
            'job_hist' => 'required',
            'password' => 'required',
            'accept' => 'required'*/
        ];
    }
}
