<?php

namespace Tests\Feature;

use Database\Seeders\UserSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class UserTest extends TestCase
{
    public function testAuth()
    {
        $this->seed([UserSeeder::class]);

        $success = Auth::attempt([
            "email" => "tian@localhost",
            "password" => "rahasia"
        ], true);
        self::assertTrue($success);

        $user = Auth::user();
        self::assertNotNull($user);
        self::assertEquals("tian@localhost", $user->email);
    }

    public function testGuest()
    {
        $user = Auth::user();
        self::assertNull($user);
    }
}
