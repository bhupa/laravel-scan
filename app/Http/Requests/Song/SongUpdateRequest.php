<?php

namespace App\Http\Requests\Song;

use App\Http\Requests\CustomFormRequest;
use Illuminate\Foundation\Http\FormRequest;

class SongUpdateRequest extends CustomFormRequest
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
            'name'=>'required|unique:songs,name,'.$this->id,
            'status'=>'required|boolean',
            'playlist_id'=>'required|exists:playlists,id',
            'unique_id'=>'required'
        ];
    }
}
