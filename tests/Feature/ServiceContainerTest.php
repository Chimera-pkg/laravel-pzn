<?php

namespace Tests\Feature;

use App\Data\Foo;
use App\Data\Person;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ServiceContainerTest extends TestCase
{
  public function testDepedencyInjection()
  {
    $foo1 = $this->app->make(Foo::class);
    $foo2 = $this->app->make(Foo::class);
    
    self::assertEquals('Foo', $foo1->foo());
    self::assertEquals('Foo', $foo2->foo());
    self::assertNotSame($foo1,$foo2);
  }

  public function testBind()
  {
    // $person = $this->app->make(Person::class);
    // self::assertNotNull($person);

    $this->app->bind(Person::class, function ($app){
        return new Person("Adryan", "Prawira");
    });

    $person1 = $this->app->make(Person::class);
    $person2 = $this->app->make(Person::class);

    self::assertEquals('Adryan', $person1->firstName);
    self::assertEquals('Adryan', $person2->firstName);
    self::assertNotSame($person1,$person2);
  }
}
