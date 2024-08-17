<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class InputControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testInput()
    {
        $this->get('/input/hello?name=Eko')
            ->assertSeeText('Hello Eko');
        
        $this->post('/input/hello', [
            'name' => 'Eko'
        ])->assertSeeText('Hello Eko');
    }
}
