<?php

namespace App\Http\Middleware;

use Closure;
use Zhong\GameConfig;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use App\Http\Controllers;

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
            'required'    => '請輸入答案。',
            'from_number_zero_int' => '請輸入數字。',
            'answer_length' => '請輸入長度為'.GameConfig::$ANSWER_LENGTH.'的數字。',
            'answer_not_repeat' => '輸入'.GameConfig::$ANSWER_LENGTH.'個不重複的數字'
        ];

        $rules = [
            'userAnswer' => 'required|from_number_zero_int|answer_length|answer_not_repeat'
        ];
        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return response()->json(['status' => 200, 'error' => $validator->errors()->all()]);

        }
//        $this->validate($request, [
//
//        ]);
//        $rules = [
//            'userAnswer' => 'required|integer'
//        ];
//
//        $messages = [
//            'required'    => '請輸入答案。',
//            'integer'    => '請輸入數字。',
//        ];
//
//        $validator = Validator::make($request->all(), $rules, $messages);
//        if ($validator->fails())
//        {
//            return response()->json(['status' => 200, 'error' => $validator->errors()->all()]);
//        }


//
//        if ($this->checkLengthCorrect($request->userAnswer)) {
//            if ($this->checkTypeIsInt($request->userAnswer)) {
//                if ($this->checkUserAnswerNotRepeatNumber($request->userAnswer)) {
//                    return $next($request);
//                }
//                return response()->json(['status' => 200, array('data'=>array('msg'=>'輸入4個不重複的數字'))]);
//            }
//            return response()->json(['status' => 200, array('data'=>array('msg'=>'請輸入數字'))]);
//        }
//        return response()->json(['status' => 200, array('data'=>array('msg'=>'請輸入一組長度為4的數字'))]);

    }

    public function checkLengthCorrect(string $userAnswer) {
        if (strlen($userAnswer) != GameConfig::$ANSWER_LENGTH) {
            return false;
        }
        return true;
    }

    public function checkTypeIsInt(string $userAnswer)
    {
        for ($s=0; $s < strlen($userAnswer); $s++) {
            if (!is_numeric($userAnswer[$s])) {
                return false;
            }
        }
        return true;
    }

    public function checkUserAnswerNotRepeatNumber(string $userAnswer)
    {
        for ($nowTarget = strlen($userAnswer)-1; 0 < $nowTarget; $nowTarget--) {
            for ($beforeTarget = $nowTarget-1; 0 <= $beforeTarget; $beforeTarget--) {
                if ($userAnswer[$nowTarget] == $userAnswer[$beforeTarget]) {
                    return false;
                }
            }
        }
        return true;
    }
}
