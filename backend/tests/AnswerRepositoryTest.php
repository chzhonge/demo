<?php

use App\Repositories\AnswerRepository;
use App\Models\Answer;

class AnswerRepositoryTest extends TestCase
{
    protected $repository = null;

    public function setUp()
    {
        parent::setUp();
        $this->repository = new AnswerRepository;
    }

    public function testCheckTheUsedAnswer()
    {
        $this->assertTrue($this->repository->checkTheUsedAnswer('2534'));
        $this->assertFalse($this->repository->checkTheUsedAnswer('1345'));
    }

    public function testSaveAnswer()
    {
        $this->repository->saveAnswer('2345', '0A2B');
        $this->assertEquals(5, Answer::count());
    }

    public function testGetAnswerHistory()
    {
        $this->assertInstanceOf('Illuminate\Database\Eloquent\Collection', $this->repository->getAnswerHistory());
    }
}