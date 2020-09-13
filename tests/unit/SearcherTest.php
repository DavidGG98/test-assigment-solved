<?php

namespace tests;

use app\components;

/**
 * SearcherTest contains test cases for searcher component
 * 
 * IMPORTANT NOTE:
 * All test cases down below must be implemented
 * You can add new test cases on your own
 * If they could be helpful in any form
 */
class SearcherTest extends \Codeception\Test\Unit
{
    protected function _before()
    {
        $factory =  new components\Factory();
        $platforms = [
            $factory->create("github"),
            $factory->create("gitlab"),
            $factory->create("bitbucket")
        ];
        $this->platforms = $platforms;

    }

    /**
     * Test case for searching via several platforms
     * 
     * IMPORTANT NOTE:
     * Should cover succeeded and failed suites
     *
     * @return void
     */
    
    public function testSearcher()
    {
        
        $searcher = new components\Searcher ();
        $user = $this->platforms[0]->findUserInfo("DavidGG98");
        $user->addRepos($this->platforms[0]->findUserRepos("DavidGG98"));
        //No users
        $this->assertEquals($searcher->search($this->platforms, []), []);
        //No platform
        $this->assertEquals($searcher->search([], ["DavidGG98"]), []);
        //Correct user
        $this->assertEquals($searcher->search($this->platforms, ["DavidGG98"]), [$user]);
        //Inexistent User
        $this->assertEquals($searcher->search($this->platforms, ["asdqyuhiquw"]), []);
        

    }
    

}