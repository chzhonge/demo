<?php

use Zhong\GameConfig;
use App\Models\Question;

class WebTest extends TestCase
{
    public function setUp()
    {
        parent::setUp();
    }

    public function testStart()
    {
        $this->json('GET', '/start')
            ->seeJsonEquals([
                'status' => 200,
                'question' => '0123'
            ]);
    }

    public function testHistory()
    {
        $this->json('GET', '/history')
            ->seeJsonEquals([
                "status" => 200,
                "history" => array(
                    ["id" => 1,"answer" => "2534","state" => "0A2B","questionID" => "1"],
                    ["id" => 2,"answer" => "9831","state" => "0A2B","questionID" => "1"],
                    ["id" => 3,"answer" => "0143","state" => "3A0B","questionID" => "1"],
                    ["id" => 4,"answer" => "0473","state" => "2A0B","questionID" => "1"])
            ]);
    }

    public function testCheck()
    {
        $this->json('POST', '/check', ['userAnswer' => ''])
            ->seeJsonEquals([
                'error' => ['請輸入答案'],
                'status' => 200
            ]);
        $this->json('POST', '/check', ['userAnswer' => 'A123'])
            ->seeJsonEquals([
                'error' => ['請輸入數字'],
                'status' => 200
            ]);
        $this->json('POST', '/check', ['userAnswer' => '12'])
            ->seeJsonEquals([
                'error' => ['請輸入長度為'.GameConfig::$ANSWER_LENGTH.'的數字'],
                'status' => 200
            ]);
        $this->json('POST', '/check', ['userAnswer' => '1122'])
            ->seeJsonEquals([
                'error' => array('請輸入4個不重複的數字'),
                'status' => 200
            ]);

    }

    public function testRestart()
    {
        $this->json('GET', '/restart')
            ->seeJson([
                "status" => 200
            ]);
    }
}