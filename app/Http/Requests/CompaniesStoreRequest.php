<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class CompaniesStoreRequest extends FormRequest {

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize() {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(Request $request) {
        $requestVal = [];
        $requestVal['name'] = $request->id ? 'required|unique:companies,name,' . $request->id : 'required|unique:companies,name';
        if (isset($request->email))
            $requestVal['email'] = 'email';
        if (isset($request->website))
            $requestVal['website'] = 'regex:' . '/^(https?:\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.-]*)*\/?$/';
        if (!$request->id) {
            $requestVal['logo'] = 'required|image|dimensions:min_width=100,min_height=100';
        }
        $request->validate($requestVal);
        return $requestVal;
    }

}
