<?php
namespace App\Http\Controllers;

use Illuminate\Validation\Validator;
use Illuminate\Http\Request;
use App\Repositories\QuestionRepository;
use App\Repositories\AnswerRepository;

class GameController extends Controller
{
    protected $questionRepository;
    protected $answerRepository;

    public function __construct(QuestionRepository $questionRepository, AnswerRepository $answerRepository)
    {
        $this->questionRepository = $questionRepository;
        $this->answerRepository = $answerRepository;
    }

    public function start()
    {
        return response()->json(['status' => 200, 'question' => $this->questionRepository->checkQuestionPlayed()]);
    }

    public function restart()
    {
        $this->questionRepository->restartQuestion();
        return response()->json(['status' => 200,'question' => $this->questionRepository->checkQuestionPlayed()]);
    }

    public function checkUsedAnswer(Request $request)
    {
        $msg = array('data' => array('answer' => '', 'state' => ''));

        if ($this->answerRepository->checkTheUsedAnswer($request->userAnswer)) {
            return response()->json(['status' => 200, 'error' => array('此答案已經輸入過了')]);
        }

        $this->answerRepository->saveAnswer($request->userAnswer, $this->checkAnswerAB($request->userAnswer));
        $msg['data']['answer'] = $request->userAnswer;
        $msg['data']['state'] = $this->checkAnswerAB($request->userAnswer);

        return response()->json(['status' => 200, $msg]);
    }

    public function checkAnswerAB($userAnswer)
    {
        $questionAnswer = $this->questionRepository->getQuestionAnswer();
        $userAnswerChecked = array(0, 0, 0, 0);
        $aIsCorrect = 0;
        $bIsCorrect = 0;
        for ($s = 0; $s < strlen($userAnswer); $s++) {
            if ($userAnswer[$s] == $questionAnswer[$s]) {
                $aIsCorrect++;
                $userAnswerChecked[$s] = 1;
                continue;
            }
            for ($e = 0; $e < strlen($userAnswer); $e++) {
                if ($userAnswerChecked[$e]) {
                    continue;
                }
                if ($userAnswer[$s] == $questionAnswer[$e]) {
                    $bIsCorrect++;
                    $userAnswerChecked[$e] = 1;
                }
            }
        }

        return sprintf('%dA%dB', $aIsCorrect, $bIsCorrect);
    }

    public function getAnswerHistory()
    {
        return response()->json(['status' => 200, 'history' => $this->answerRepository->getAnswerHistory()]);
    }

    public function downloadHistory()
    {
        $file = fopen("answerHistory.txt", "w+");
        $data = $this->answerRepository->getAnswerHistory();

        if ($data == '') {
            fwrite($file, '作答紀錄'.PHP_EOL);
            fclose($file);
        } else {
            fwrite($file, '作答紀錄'.PHP_EOL);
            foreach ($data as $d) {
                fwrite($file, $d->answer."：".$d->state.PHP_EOL);
            }
            fclose($file);
        }

        return response()->download(getcwd().'/answerHistory.txt', 'answerHistory.txt');
    }
}
