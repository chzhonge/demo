<?php
/**
 * Created by PhpStorm.
 * User: zhong
 * Date: 4/28/17
 * Time: 7:22 PM
 */

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\QuestionRepository;
use Zhong\Random;
use App\Models\Question;
use Illuminate\Validation\Validator;

class GameController extends Controller
{
    protected $questionRepository;

    public function __construct(QuestionRepository $questionRepository)
    {
        $this->questionRepository = $questionRepository;
    }

    public function start()
    {
        return response()->json(['status' => 200, 'question' => $this->questionRepository->checkQuestionIsPlayed()]);

//        $flight = new Question ;
//        $flight->question = '213';
//        $flight->played = false;
//        $flight->save();
//        return response()->json(['status' => 200, 'question' => '' ]);
//        if (isset($_COOKIE["question"])) {
//            return response()->json(['status' => 200, 'question' => $_COOKIE["question"]]);
//        } else {
//            $question = Random::getNotRepeatRandom();
//            setcookie("question", $question);
//            ]);
//        }

    }

    public function checkAnswer(Request $request)
    {
//        $this->validate($request, [
//            'question' => 'required|unique:answers|size:'.GameConfig::$ANSWER_LENGTH
//        ]);
//        $rules = [
//            'question' => 'required|integer'
//        ];
//
//        $messages = [
//            'required'    => '請輸入一組長度為'.GameConfig::$ANSWER_LENGTH.'的數字。',
//            'integer'    => '請輸入數字。'
//        ];
//
//        $validator = Validator::make($request, $rules, $messages);
        return $request->userAnswer;
    }

    public function downloadRecord()
    {

    }
}