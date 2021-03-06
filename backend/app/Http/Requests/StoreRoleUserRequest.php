<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreRoleUserRequest extends FormRequest
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
            'role_id' => [
                'required',
                'integer',
                'min:1',
                Rule::unique('role_user')->where(function ($query) {
                    $query->where('user_id', $this->user->id)
                        ->where('role_id', $this->role_id);
                })
            ]
        ];
    }
}
