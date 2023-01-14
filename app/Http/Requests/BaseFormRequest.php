<?php 

namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\ValidationException;
use RealRashid\SweetAlert\Facades\Alert;

class BaseFormRequest extends FormRequest{
  
  protected function failedValidation(Validator $validator)
  {
      $html = "<ul style='list-style: none;'>";
      foreach($validator->getMessageBag()->getMessages() as $error) {
          $html .= "<li>$error[0]</li>";
      }
      $html .= "</ul>";
      Alert::html('Error during action !', $html, 'error');

      throw (new ValidationException($validator))
                  ->errorBag($this->errorBag)
                  ->redirectTo($this->getRedirectUrl());
  }
}

?>