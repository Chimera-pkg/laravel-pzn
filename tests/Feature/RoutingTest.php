<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RoutingTest extends TestCase
{
   public function testGet()
   {
     $this->get('/pzn')
            ->assertStatus(200)
            ->assertSeeText('P INFO GAN');
   }

   public function testRedirect()
   {
     $this->get('/youtube')
            ->assertRedirect('/pzn');
    }

    public function testFallback()
    {
      $this->get('/tidakditemukan')
            ->assertSeeText('Halaman tidak ditemukan');
      
      $this->get('/tidakadalagi')
            ->assertSeeText('Halaman tidak ditemukan');
      $this->get('/gakadasamsek')
            ->assertSeeText('Halaman tidak ditemukan');
    }


    
}
