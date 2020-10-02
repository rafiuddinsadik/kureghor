<?php

namespace Tests\Feature;

use Illuminate\Support\Facades\Event;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AdminCheckTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testAdminExist()
    {
        $this->withExceptionHandling();
        Event::fake();
        $this->assertDatabaseHas('users', [
            'email' => 'rafiuddinsadik@gmail.com',
        ]);
    }
}
