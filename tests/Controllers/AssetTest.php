<?php

namespace MigrationsUITests\Controllers;

use MigrationsUITests\TestCase;

class AssetTest extends TestCase
{
    public function listOfAssets()
    {
        return [
            ['app.css', 'text/css'],
            ['app.js', 'application/javascript'],
            ['favicon.png', 'image/png'],
        ];
    }

    /** @dataProvider listOfAssets */
    public function testAsset($name, $type)
    {
        $response = $this->get("/migrations/assets/$name");

        $response->assertOk();
        $response->assertHeader('Content-Type', $type);

        $this->expectOutputString(file_get_contents(__DIR__ . "/../../build/$name"));
        $response->sendContent();
    }

    public function testMissingFile()
    {
        $this
            ->withExceptionHandling()
            ->get('/migrations/assets/invalid.css')
            ->assertNotFound();
    }

    public function testUnsafeFilename()
    {
        $this
            ->withExceptionHandling()
            ->get('/migrations/assets/../composer.json')
            ->assertNotFound();
    }
}
