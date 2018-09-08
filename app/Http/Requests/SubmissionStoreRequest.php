<?php

namespace App\Http\Requests;

use App\Rules\LeastOne;
use App\Rules\Phone;
use Illuminate\Foundation\Http\FormRequest;

class SubmissionStoreRequest extends FormRequest
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
        $rules = [
            'submissions.*.full_name' => 'required|regex:/^[a-zA-ZА-ЯЦцУуШшЩщФфЫыРрЭэЧчТтЬьЮюЪъХхЁа-яё1\s]+$/|max:30',
            'submissions.*.phone' => ['required', 'string', 'max:50', new Phone],
            'submissions' => [new LeastOne('isLeader')],
        ];

        return $rules;
    }

    /**
     * Custom message for validation
     *
     * @return array
     */
    public function messages()
    {
        return [

        ];
    }
}
