<?php
namespace App\Repositories;

use App\Models\Question;
use Zhong\Random;

class QuestionRepository
{
    public function getFirstQuestion()
    {
        $question = new Question;
        $question->question = Random::getNotRepeatRandom();
        $question->played = false;
        $question->save();

        return $question->question;
    }

    public function getQuestionAnswer()
    {
        return Question::where('played', false)->orderBy('id', 'desc')->first()->question;
    }

    public function checkQuestionPlayed()
    {
        if (Question::where('played', false)->count() == 0) {
            return $this->getFirstQuestion();
        } else {
            return Question::where('played', false)->orderBy('id', 'desc')->first()->question;
        }
    }

    public function restartQuestion()
    {
        Question::where('played', false)->update(['played' => true]);
    }
}
