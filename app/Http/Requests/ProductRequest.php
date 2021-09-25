<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
            "category_id" => ["required","numeric"],
            "name" => ["required","max:255"],
          /*  "hsn_code" => ["required"],
            "product_code" => ["required"],
            "gst_rate" => ["required","numeric"],
            "product_volume" =>["required"],
            "part_no"=>["required"],
            "image" => ["nullable","image"],
            "minimum_selling_price" => ["required","numeric"],
            "selling_price" => ["required","numeric"],
            "is_machine_part" => ["boolean"],
            "is_active" => ["boolean"]*/
        ];
    }
}
