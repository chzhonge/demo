<?php

use App\Repositories\QuestionRepository;
use App\Models\Question;

class QuestionRepositoryTest extends TestCase
{
    protected $repository = null;

    public function setUp()
    {
        parent::setUp();
        $this->repository = new QuestionRepository;
    }

    public function testRestartQuestion()
    {
        $this->repository->restartQuestion();
        $this->assertEquals(true, Question::where('played', true)->orderBy('id', 'desc')->first()->played);
    }

    public function testGetFirstQuestion()
    {
        $this->assertInternalType('string', $this->repository->getFirstQuestion());
    }

    public function testGetQuestionAnswer()
    {
        $this->assertInternalType('string', $this->repository->getQuestionAnswer());
    }

    public function testCheckQuestionPlayed()
    {
        $this->assertInternalType('string', $this->repository->checkQuestionPlayed());
    }
}