<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Qrcode;

class UpdateQrcodeRequest extends FormRequest
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
        //$rules = Qrcode::$rules;
        
        return [
            'product_name' => 'required|max:255',
            'user_id' => 'required',
            'company_name' => 'required|max:255',
            'callback_url' => 'required',
            'product_name' => 'required',
            'amount' => 'required',
        ];

    }
}
