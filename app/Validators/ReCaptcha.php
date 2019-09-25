<?php

namespace App\Validators;

class ReCaptcha
{
    public function validate($attribute, $value, $parameters, $validator)
    {
        
        $curl = curl_init();
    
         $captcha_verify_url = "https://www.google.com/recaptcha/api/siteverify";
    
          curl_setopt($curl, CURLOPT_URL,$captcha_verify_url);
         curl_setopt($curl, CURLOPT_POST, true);
          curl_setopt($curl, CURLOPT_POSTFIELDS, "secret=6LdxwJ8UAAAAALyBrWJGFR37Qvr1n0MKVqwB3AnJ&response=".$value);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    
         $captcha_output = curl_exec ($curl);
            curl_close ($curl);
    $body = json_decode($captcha_output);



        return $body->success;
    }
}