<?php

namespace tests;

use app\models;

/**
 * GithubRepoTest contains test cases for github repo model
 * 
 * IMPORTANT NOTE:
 * All test cases down below must be implemented
 * You can add new test cases on your own
 * If they could be helpful in any form
 */
class GithubRepoTest extends \Codeception\Test\Unit
{

    protected function _before()
    {
        $this->repo = new models\GithubRepo ("example", 1, 0, 1);
        $this->emptyRepo = new models\GithubRepo ("empty", 0, 0, 0);
    }

    /**
     * Test case for counting repo rating
     *
     * @return void
     */
    public function testRatingCount()
    {
        $this->assertEquals($this->repo->getRating(),1.0);
        $this->assertEquals($this->emptyRepo->getRating(),0);
    }

    /**
     * Test case for repo model data serialization
     *
     * @return void
     */
    public function testData()
    {
        $expected = [
            'name' => "empty",
            'fork-count' => 0,
            'watcher-count' => 0,
            'start-count' => 0,
            'rating' => 0,
        ];
        $this->assertEquals($this->emptyRepo->getData(), $expected);
    }

    /**
     * Test case for repo model __toString verification
     *
     * @return void
     */
    public function testStringify()
    {
        $expected = sprintf (
            "%-75s %4d ⇅ %4d ★ %4d 👁️",
            "empty",
            0,
            0,
            0
        );
        $this->assertEquals((string)$this->emptyRepo, $expected);
    }

    /**
    * Test case for repo constructor
    *
    * @return void
    */
    public function testConstructor() {
        $newRepo = new models\GithubRepo ("example", 1, 0, 1);
        $this->assertEquals($newRepo->getName(),"example");
        $this->assertEquals($newRepo->getForkCount(), 1);
        $this->assertEquals($newRepo->getWatcherCount(),1);
        $this->assertEquals($newRepo->getStarCount(),0); 
    }
}