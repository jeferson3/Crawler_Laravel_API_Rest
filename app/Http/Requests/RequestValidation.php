<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

class RequestValidation extends FormRequest
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
            'coin'   => 'required',
            'value'  => 'required'
        ];
    }

    /**
     * @param Validator $validator
     * @return array
     */
    protected function failedValidation(Validator $validator): array
    {
        $clientErrors = [];
        foreach ($validator->getMessageBag()->toArray() as $key => $value) {
            $clientErrors[] = $value;
        }

        $response = response()->json([
            'status'  => false,
            'message' => 'Dados inválidos!',
            'errors'  => $clientErrors
        ], 400);

        throw new HttpResponseException($response);
    }
}
