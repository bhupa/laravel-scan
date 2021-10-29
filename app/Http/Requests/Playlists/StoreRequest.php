<?php

namespace App\Http\Requests\Playlists;

use App\Http\Requests\CustomFormRequest;
use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends CustomFormRequest
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
        
        if($this->type == 'file'){
            return [
                'title'=>'required|unique:playlists,title',
                'type'=>'required|in:file,link',
                'value'=>'required|file'
            ];
        }else{
            return [
                'title'=>'required|unique:playlists,title',
                'type'=>'required|in:file,link',
                'value'=>'required|url'
            ];
        }
        
    }
}
