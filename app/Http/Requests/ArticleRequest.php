<?php

namespace Corp\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ArticleRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if(\Auth::user()->canDo('ADD_ARTICLES')){
            return TRUE;
        }
            
        else{
            abort(404);
        }
    }
    
    protected function getValidatorInstance() 
    {
        $validator = parent::getValidatorInstance();
        
        
        $validator->sometimes('alias','unique:articles|max:255', function($input){
           
            if($this->route()->hasParameter('article')){
                $model = $this->route()->parameter('article');                
                return($model !== $input->alias) && !empty($input->alias);
            }
            
            return !empty($input->alias);
            
        }); 
        
        return $validator;
        
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {

        
        return [
            'title' =>'required|max:255',
            'text' => 'required',
            'category_id' => 'required|integer',
            
        ];
    }
}
