<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

//add this line, we will use Laravel HTTP to call OpenAI API !
use Illuminate\Support\Facades\Http;

class GPT3Controller extends Controller
{

    //OpenAI GPT3 Engine names :
    private $engines = [
       "babbage" => "text-babbage-001",
       "curies" => "text-curie-001",
       "ada" => "text-ada-001",
       "davinci" => "text-davinci-001"
    ];

    //Put your OpenAI API Token !
    private $token = "TOKEN";

    public function index(Request $request){


      //prompt or you can say user input
      $prompt = $request->chatQuerry;
      

      //choose model !
      //Davinci is the most powerful engine
      $engine = $this->engines['davinci'];

      //max tokens you want as an output
      //1 token is almost 0.75 word
      $maxTokens = 100;
        

       //Using Laravel HTTP
      $response = Http::withHeaders([
            'Content-Type' => 'application/json',
            'Authorization' => "Bearer $this->token"
        ])->post("https://api.openai.com/v1/engines/$engine/completions", [
            'prompt' => $prompt,
            "temperature" => 0.7,
            "max_tokens" => $maxTokens,
            "top_p" => 1,
            "frequency_penalty" => 0,
            "presence_penalty" => 0,
        ]);

     //Now check if the request was successful or not !
     //After checking print result !

      if($response->failed()){
        $result = null;
            // return "Request Failed !";
        return view('dashboard', compact('result'));

      }
      else{

          //OpenAI API result
          $result = $response['choices'][0]['text'];
        //   dd($result);  //-- Tutaj zmienna result zwraca prawidłowo odpowiedź z ChatGPT
        //   return $response['choices'][0]['text'];
        return view('dashboard', compact('result'));
      }
    
   }
}

?>