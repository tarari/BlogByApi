<?php

namespace Tests\Feature;

use App\Models\Pio;
use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserPioTest extends TestCase
{

    public function test_user_creates_a_pio()
    {
        $user=User::factory()->create();
        $this->actingAs($user);
        $this->assertAuthenticated();

        $response=$this->post(route('pios.store'),[
            'message'=>'false message'
        ]);
        $response->assertStatus(200);

    }
}
