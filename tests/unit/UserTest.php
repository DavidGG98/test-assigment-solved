<?php

namespace tests;

use app\models;

/**
 * UserTest contains test cases for user model
 * 
 * IMPORTANT NOTE:
 * All test cases down below must be implemented
 * You can add new test cases on your own
 * If they could be helpful in any form
 */
class UserTest extends \Codeception\Test\Unit
{

    protected function _before()
    {
        $this->user= new models\User (1,"David", "github");
        $this->githubRepo = new models\GithubRepo ("exampleRepo",1,0,1);
        $this->githubEmptyRepo = new models\GithubRepo ("empty",0,0,0);
        /*
        fwrite(STDERR, print_r($this->user->getName(), TRUE));
        fwrite(STDERR, print_r("\n", TRUE));
        */
    }

    /**
     * Test case for adding repo models to user model
     * 
     * IMPORTANT NOTE:
     * Should cover succeeded and failed suites
     * @return void
     */
    public function testAddingRepos()
    {
        $array = [
            $this->githubRepo,
            $this->githubEmptyRepo
        ];
        $user = new models\User (2,"David", "gitlab");
        //EXCEPTION CASE
        $this->expectException(\LogicException::class);
        $this->user->addRepos([1]);
        //NO EXCEPTION CASE
        $this->assertNull($this->user->addRepos($array));
    }

    /**
     * Test case for counting total user rating
     *
     * @return void
     */
    public function testTotalRatingCount()
    {
        //With no repos-
        $this->assertEquals($this->user->getTotalRating(),0);
        //After adding repos
        $this->user->addrepos([$this->githubRepo, $this->githubEmptyRepo]);
        $this->assertEquals($this->user->getTotalRating(),1);
    }

    /**
     * Test case for user model data serialization
     *
     * @return void
     */
    public function testData()
    {
        $this->user->addrepos([$this->githubRepo]);
        $expected = [
            'name' => "David",
            'platform' => "github",
            'total-rating' => 1.0,
            'repos' => [],
            'repo' => [ 
                    0 => [
                        'name' => "exampleRepo",
                        'fork-count' => 1,
                        'start-count' => 0,
                        'watcher-count' => 1,
                        'rating' => 1.0,
                    ],
                ],
            ];     
        $this->assertEquals($this->user->getData(),$expected);
    }

    /**
     * Test case for user model __toString verification
     *
     * @return void
     */
    public function testStringify()
    {
        $this->user->addrepos([$this->githubEmptyRepo]);
        $expected = sprintf(
            "%-75s %19d 🏆\n%'=98s\n",
            "David (github)",
            0,
            ""
        );
        $expected .= sprintf(
            "%-75s %4d ⇅ %4d ★ %4d 👁️",
            "empty",
            0,
            0,
            0
        )."\n";
        $this->assertEquals((string)$this->user,$expected);

    }

    /**
     * Test case for user model constructor
     * 
     * @return void
     */
    public function testConstructor () {
        $newUser = new models\User (15,"David", "github");
        $this->assertEquals($newUser->getName(), "David");
        $this->assertEquals($newUser->getIdentifier(), 15);
        $this->assertEquals($newUser->getPlatform(), "github");
    }
}