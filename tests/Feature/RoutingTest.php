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

    public function testRouteParameter()
    {
      $this->get('/products/1')
            ->assertSeeText('Product  1');

      $this->get('/products/2')
            ->assertSeeText('Product  2');
      
      $this->get('/products/1/items/XXX')
            ->assertSeeText('Product 1, Item XXX');      
      
      $this->get('/products/2/items/YYY')
            ->assertSeeText('Product 2, Item YYY');
    }

    public function testRouteParameterRegex()
    {
      $this->get('/categories/100')
      ->assertSeeText('Category 100');

      $this->get('/categories/yanto')
      ->assertSeeText('Halaman tidak ditemukan woi anjirlah');


    }

    public function testRouteParameterOptional()
    {
      $this->get('/users/adryan')
      ->assertSeeText('User adryan');

      $this->get('/users/')
      ->assertSeeText('User 404');
    }
    
}
