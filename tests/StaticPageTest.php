<?php

namespace MigrationsUITests;

class StaticPageTest extends TestCase
{
    public function testSpaRoot()
    {
        $this->get('/migrations')
            ->assertOk()
            ->assertSee('Loading...');
    }

    public function testSpaCatchAll()
    {
        $this->get('/migrations/blahblahblah')
            ->assertOk()
            ->assertSee('Loading...');
    }

    public function testApiRoot()
    {
        $this->get('/migrations/api')
            ->assertNotFound()
            ->assertSee('Not Found');
    }

    public function testApiCatchAll()
    {
        $this->get('/migrations/api/blahblahblah')
            ->assertNotFound()
            ->assertSee('Not Found');
    }
}
