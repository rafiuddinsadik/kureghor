<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Event;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RegistrationTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testRegistration()
    {
        $response = $this->post('registeruser', [
            'name' => 'Rafi Uddin',
            'email' => 'rafiuddinsadik@gmail.com',
            'password' => '12345',
        ]);

        $count = DB::table('users')->count();
        $this->assertEquals(1, $count);
    }
}
