<?php
namespace App\Repositories;

use App\Models\Question;
use App\Models\Answer;

class AnswerRepository
{
    public function checkTheUsedAnswer($userAnswer)
    {
        $questionID = Question::where('played', false)->orderBy('id', 'desc')->first()->id;
        if (Answer::where('answer', $userAnswer)->where('questionID', $questionID)->count() == 0) {
            return false;
        }
        return true;
    }

    public function saveAnswer($userAnswer, $userAnswerState)
    {
        $questionID = Question::where('played', false)->orderBy('id', 'desc')->first()->id;
        $answer = new Answer;
        $answer->answer = $userAnswer;
        $answer->state = $userAnswerState;
        $answer->questionID = $questionID;
        $answer->save();
    }

    public function getAnswerHistory()
    {
        $questionID = Question::where('played', false)->orderBy('id', 'desc')->first()->question;
        if (Answer::where('questionID', $questionID)->count() == 0) {
            return '';
        }
        return Answer::where('questionID', $questionID)->get();
    }

}