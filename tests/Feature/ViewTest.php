<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ViewTest extends TestCase
{
    public function testView()
    {
        $this->get('/hello')
             ->assertStatus(200)
             ->assertSeeText('Hello, YANTO');
        {
        $this->get('/hello-again')
            ->assertStatus(200)
            ->assertSeeText('Hello, YANTO awokwkpk');
        }
    }

    public function testNested()
    {
      $this->get('/hello-world')
        ->assertSeeText('World, YANTO awokwkpk');
        
    }

    public function testTemplate()
    {
      $this->view('hello', ['name' => 'Adryan'])
        ->assertSeeText('Hello, Adryan');

        $this->view('hello.world', ['name' => 'Adryan'])
        ->assertSeeText('World, Adryan');
        
    }


}
