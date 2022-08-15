<?php

namespace Backend\User\Tests;

use Tests\TestCase;

class DemoTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function exampleTest(): void
    {
        $response = $this->get('/demo2');

        $response->assertStatus(200);
    }
}
