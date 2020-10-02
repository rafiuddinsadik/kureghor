<?php

namespace Tests\Feature;

use Illuminate\Support\Facades\Event;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AdminRouteTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_admin_auth_routes(){
        Event::fake();
        $this->get('admin/dashboard')->assertStatus(403);
    }
}
