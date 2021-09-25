<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Company;
use Illuminate\Http\Request;

class CompanyRequest extends FormRequest
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
    public function rules(Request $request)
    {
        $company = Company::find($this->segment(2));
        if (!empty($company)) {
            $id = $company->id;
        }else{
            $id = "";
        }
        return [
            'name' => ["required"],
            'address' => ["required"],
            'city' => ['required'],
            'zipcode' =>["required","numeric"],
            'state' => ["required"],
            'country' => ["required"],
            'email'=>["required","unique:companies,email,$id"],
            'logo' => ["nullable","image"],
            'header_image' => ["nullable","image"],
            'footer_image' => ["nullable","image"],
            'phone' => ["nullable","numeric","digits:10"],
            'phone_number' => ["nullable","numeric","digits:10"],
        ];
      
    }
}
