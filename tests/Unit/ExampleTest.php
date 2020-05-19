<?php

namespace Tests\Unit;

use App\User;
use App\Article;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testBasicTest()
    {
        $this->assertFalse(User::first()->can('index', Article::class));
    }
}
