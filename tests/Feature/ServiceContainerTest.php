<?php

namespace Tests\Feature;

use App\Data\Foo;
use App\Data\Person;
use App\Data\Bar;
use App\Services\HelloService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ServiceContainerTest extends TestCase
{
  public function testDepedency()
  {
    $foo1 = $this->app->make(Foo::class);
    $foo2 = $this->app->make(Foo::class);
    
    self::assertEquals('Foo', $foo1->foo());
    self::assertEquals('Foo', $foo2->foo());
    self::assertNotSame($foo1,$foo2);
  }

  public function testSingleton()
  {
    // $person = $this->app->make(Person::class);
    // self::assertNotNull($person);

    $this->app->singleton(Person::class, function ($app){
        return new Person("Adryan", "Prawira");
    });

    $person1 = $this->app->make(Person::class);
    $person2 = $this->app->make(Person::class);

    self::assertEquals('Adryan', $person1->firstName);
    self::assertEquals('Adryan', $person2->firstName);
    self::assertSame($person1,$person2);
  }
  public function testInstance()
  {
    // $person = $this->app->make(Person::class);
    // self::assertNotNull($person);

    $person = new Person("Adryan", "Prawira");
    $this->app->instance(Person::class, $person);

    $person1 = $this->app->make(Person::class);
    $person2 = $this->app->make(Person::class);
    $person3 = $this->app->make(Person::class);
    $person4 = $this->app->make(Person::class);

    self::assertEquals('Adryan', $person1->firstName);
    self::assertEquals('Adryan', $person2->firstName);
    self::assertSame($person1,$person2);
  }

  public function testDepedencyInjection()
  {
    $this->app->singleton(Foo::class, function($app){
        return new Foo();
    });
    $this->app->singleton(Bar::class, function ($app){
        $foo = $app->make(Foo::class);
        return new Bar($foo);
    });

    $foo = $this->app->make(Foo::class);
    $bar1 = $this->app->make(Bar::class);
    $bar2 = $this->app->make(Bar::class);

    // self::assertSame($foo, $bar->foo);
    self::assertSame($bar1,$bar2);

  }

  public function testInterfaceToClass()
  {
    $this->app->singleton(HelloService::class, function ($app){
        return new \App\Services\HelloServiceIndonesia();
    });
    
    $helloService = $this->app->make(HelloService::class);

    self::assertEquals('Halo, Adryan', $helloService->hello('Adryan'));
  }
}
