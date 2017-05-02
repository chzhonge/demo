<?php

namespace App\Http\Middleware;

use Closure;
use Zhong\GameConfig;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use App\Http\Controllers;
use App\Models\Question;
use Validator;

class GameMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $messages = [
            'required'    => '請輸入答案',
            'from_number_zero_int' => '請輸入數字',
            'answer_length' => '請輸入長度為'.GameConfig::$ANSWER_LENGTH.'的數字',
            'answer_not_repeat' => '請輸入'.GameConfig::$ANSWER_LENGTH.'個不重複的數字'
        ];

        $rules = [
            'userAnswer' => 'required|from_number_zero_int|answer_length|answer_not_repeat'
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            $error = $validator->errors()->all();
            return response()->json(['status' => 200, 'error' => $error]);
        }

        return $next($request);
    }
}
