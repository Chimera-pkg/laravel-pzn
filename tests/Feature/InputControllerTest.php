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

    public function testInputNested()
    {
        $this->post('/input/hello/first', [
            "name" => [
                "first" => "Eko",
                "last" => "Khannedy",
            ]
            ]);
    }

    public function testInputAll()
    {
        $this->post('/input/hello/input', [
            "name" => [
                "first" => "Eko",
                "last" => "Khannedy",
                ]
            ])->assertSeeText("name")->assertSeeText("Eko")
                 ->assertSeeText("last")->assertSeeText("Eko")
                 ->assertSeeText("Khannedy");
    }

    public function helloArray()
    {
        
    }
}

