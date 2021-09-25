<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use App\User;

class UserRequest extends FormRequest
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
       $user = User::find($this->segment(2));
       if (!empty($user)) {
           $id = $user->id;
       }else{
            $id = "";
       }
        return [
            "user_type" => ["required"],
            "name" => ["required"],
            "group_id" => ["required"],
            "address" => ["required"],
            "city"=>["required"],
            "zip_code" => ["required"],
            "state" => ["required"],
            "country" => ["required"],
            "mobile_number"=>["required","numeric","unique:users,mobile_number,$id","digits:10"]
        ];
    }
}
