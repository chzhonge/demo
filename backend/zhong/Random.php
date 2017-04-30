<?php
namespace Zhong;

use Zhong\GameConfig;

class Random
{

    /**
     * @param int $length
     * @param int $min
     * @param int $max
     * @return string
     */
    public static function getNotRepeatRandom()
    {

        $question = array_rand(range(GameConfig::$ANSWER_LENGTH, GameConfig::$RANGE_MAX), GameConfig::$ANSWER_LENGTH);
        shuffle($question);
        $answer = '';
        foreach ($question as $questionString) {
            $answer .= $questionString;
        }
        return $answer;
    }
}


