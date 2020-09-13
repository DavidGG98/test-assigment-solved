<?php

namespace tests;

use app\components;

/**
 * FactoryTest contains test cases for factory component
 * 
 * IMPORTANT NOTE:
 * All test cases down below must be implemented
 * You can add new test cases on your own
 * If they could be helpful in any form
 */
class FactoryTest extends \Codeception\Test\Unit
{
    /**
     * Test case for creating platform component
     * 
     * IMPORTANT NOTE:
     * Should cover succeeded and failed suites
     *
     * @return void
     */
    public function testCreate()
    {
        /**
         * @todo IMPLEMENT THIS
         */
        $factory =  new components\Factory();
        //Success
        $this->assertEquals($factory->create("github"), new components\platforms\Github([]));
        $this->assertEquals($factory->create("github"), new components\platforms\Github([]));
        $this->assertEquals($factory->create("gitlab"), new components\platforms\Gitlab([]));
        $this->assertEquals($factory->create("bitbucket"), new components\platforms\Bitbucket([]));
        //Exception Case
        $this->expectException(\LogicException::class);
        $platform = $factory->create("Fake");

    }
}