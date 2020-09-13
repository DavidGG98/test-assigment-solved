<?php

/**
 * Base contains test cases for testing api endpoint
 * 
 * @see https://codeception.com/docs/modules/Yii2
 * 
 * IMPORTANT NOTE:
 * All test cases down below must be implemented
 * You can add new test cases on your own
 * If they could be helpful in any form
 */
class BaseCest
{
    /**
     * Example test case
     *
     * @return void
     */
    public function cestExample(\FunctionalTester $I)
    {
        
        $I->amOnPage([
            'base/api',
            'users' => [
                'kfr',
            ],
            'platforms' => [
                'github',
            ]
        ]);
        $expected = json_decode('[
            {
                "name": "kfr",
                "platform": "github",
                "total-rating": 1.5,
                "repos": [],
                "repo": [
                    {
                        "name": "kf-cli",
                        "fork-count": 0,
                        "start-count": 2,
                        "watcher-count": 2,
                        "rating": 1
                    },
                    {
                        "name": "cards",
                        "fork-count": 0,
                        "start-count": 0,
                        "watcher-count": 0,
                        "rating": 0
                    },
                    {
                        "name": "UdaciCards",
                        "fork-count": 0,
                        "start-count": 0,
                        "watcher-count": 0,
                        "rating": 0
                    },
                    {
                        "name": "unikgen",
                        "fork-count": 0,
                        "start-count": 1,
                        "watcher-count": 1,
                        "rating": 0.5
                    }
                ]
            }
        ]');
        $I->assertEquals($expected, json_decode($I->grabPageSource()));
    }

    /**
     * Test case for api with bad request params
     *
     * @return void
     */
    public function cestBadParams(\FunctionalTester $I)
    {
        $I->amOnPage([
            'base/api',
        ]);
        $I->see("Bad Request");

    }

    /**
     * Test case for api with empty user list
     *
     * @return void
     */
    public function cestEmptyUsers(\FunctionalTester $I)
    {
        $I->amOnPage([
            'base/api',
            'users' => [
            ],
            'platforms' => [
                'github',
            ]
        ]);

        $I->assertEquals(null, json_decode($I->grabPageSource()));
        
    }

    /**
     * Test case for api with empty platform list
     *
     * @return void
     */
    public function cestEmptyPlatforms(\FunctionalTester $I)
    {
        $I->amOnPage([
            'base/api',
            'users' => [
                'DavidGG98',
            ],
            'platforms' => [

            ]
        ]);

        $I->assertEquals(null, json_decode($I->grabPageSource()));

    }

    /**
     * Test case for api with non empty platform list
     *
     * @return void
     */
    public function cestSeveralPlatforms(\FunctionalTester $I)
    {
        $I->amOnPage([
            'base/api',
            'users' => [
                'kfr',
            ],
            'platforms' => [
                'github',
            ]
        ]);
        $expected = json_decode('[
            {
                "name": "kfr",
                "platform": "github",
                "total-rating": 1.5,
                "repos": [],
                "repo": [
                    {
                        "name": "kf-cli",
                        "fork-count": 0,
                        "start-count": 2,
                        "watcher-count": 2,
                        "rating": 1
                    },
                    {
                        "name": "cards",
                        "fork-count": 0,
                        "start-count": 0,
                        "watcher-count": 0,
                        "rating": 0
                    },
                    {
                        "name": "UdaciCards",
                        "fork-count": 0,
                        "start-count": 0,
                        "watcher-count": 0,
                        "rating": 0
                    },
                    {
                        "name": "unikgen",
                        "fork-count": 0,
                        "start-count": 1,
                        "watcher-count": 1,
                        "rating": 0.5
                    }
                ]
            }
        ]');
        $I->assertEquals($expected, json_decode($I->grabPageSource()));
    }

    /**
     * Test case for api with non empty user list
     *
     * @return void
     */
    public function cestSeveralUsers(\FunctionalTester $I)
    {
        $I->amOnPage([
            'base/api',
            'users' => [
                'kfr',
            ],
            'platforms' => [
                'github',
            ]
        ]);
        $expected = json_decode('[
            {
                "name": "kfr",
                "platform": "github",
                "total-rating": 1.5,
                "repos": [],
                "repo": [
                    {
                        "name": "kf-cli",
                        "fork-count": 0,
                        "start-count": 2,
                        "watcher-count": 2,
                        "rating": 1
                    },
                    {
                        "name": "cards",
                        "fork-count": 0,
                        "start-count": 0,
                        "watcher-count": 0,
                        "rating": 0
                    },
                    {
                        "name": "UdaciCards",
                        "fork-count": 0,
                        "start-count": 0,
                        "watcher-count": 0,
                        "rating": 0
                    },
                    {
                        "name": "unikgen",
                        "fork-count": 0,
                        "start-count": 1,
                        "watcher-count": 1,
                        "rating": 0.5
                    }
                ]
            }
        ]');
        $I->assertEquals($expected, json_decode($I->grabPageSource()));
    }
    

    /**
     * Test case for api with unknown platform in list
     *
     * @return void
     */
    public function cestUnknownPlatforms(\FunctionalTester $I)
    {
        $I->expectException(\ErrorException::class, function() {
        $I->amOnPage([
            'base/api',
            'users' => [
                'DavidGG98',
            ],
            'platforms' => [
                'githug'
            ]
            ]);
        });
    }

    /**
     * Test case for api with unknown user in list
     *
     * @return void
     */
    public function cestUnknownUsers(\FunctionalTester $I)
    {
        $I->amOnPage([
            'base/api',
            'users' => [
                'asdasd234r243sdfsd',
            ],
            'platforms' => [
                'github',
            ]
        ]);

        $I->assertEquals([], json_decode($I->grabPageSource()));
    }
    
    /**
     * Test case for api with mixed (unknown, real) users and non empty platform list
     *
     * @return void
     */
    public function cestMixedUsers(\FunctionalTester $I)
    {
        $I->amOnPage([
            'base/api',
            'users' => [
                'kfr',
                'asdasd234r243sdfsd',
            ],
            'platforms' => [
                'github',
            ]
        ]);
        $expected = json_decode('[
            {
                "name": "kfr",
                "platform": "github",
                "total-rating": 1.5,
                "repos": [],
                "repo": [
                    {
                        "name": "kf-cli",
                        "fork-count": 0,
                        "start-count": 2,
                        "watcher-count": 2,
                        "rating": 1
                    },
                    {
                        "name": "cards",
                        "fork-count": 0,
                        "start-count": 0,
                        "watcher-count": 0,
                        "rating": 0
                    },
                    {
                        "name": "UdaciCards",
                        "fork-count": 0,
                        "start-count": 0,
                        "watcher-count": 0,
                        "rating": 0
                    },
                    {
                        "name": "unikgen",
                        "fork-count": 0,
                        "start-count": 1,
                        "watcher-count": 1,
                        "rating": 0.5
                    }
                ]
            }
        ]');
        $I->assertEquals($expected, json_decode($I->grabPageSource()));
    }

    /**
     * Test case for api with mixed (github, gitlab, bitbucket) platforms and non empty user list
     *
     * @return void
     */
    public function cestMixedPlatforms(\FunctionalTester $I)
    {
        $I->amOnPage([
            'base/api',
            'users' => [
                'kfr',
            ],
            'platforms' => [
                'github',
                'gitlab',
            ]
        ]);
        $expected = json_decode('[
            {
                "name": "kfr",
                "platform": "github",
                "total-rating": 1.5,
                "repos": [],
                "repo": [
                    {
                        "name": "kf-cli",
                        "fork-count": 0,
                        "start-count": 2,
                        "watcher-count": 2,
                        "rating": 1
                    },
                    {
                        "name": "cards",
                        "fork-count": 0,
                        "start-count": 0,
                        "watcher-count": 0,
                        "rating": 0
                    },
                    {
                        "name": "UdaciCards",
                        "fork-count": 0,
                        "start-count": 0,
                        "watcher-count": 0,
                        "rating": 0
                    },
                    {
                        "name": "unikgen",
                        "fork-count": 0,
                        "start-count": 1,
                        "watcher-count": 1,
                        "rating": 0.5
                    }
                ]
            }
        ]');
        $I->assertEquals($expected, json_decode($I->grabPageSource()));
    }
    
}