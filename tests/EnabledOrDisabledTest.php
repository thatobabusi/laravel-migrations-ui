<?php

namespace MigrationsUITests;

class EnabledOrDisabledTest extends TestCase
{
    protected $enableDebugging = false;

    /** @noinspection ReturnTypeCanBeDeclaredInspection Changed between Laravel 6 and 7 */
    private function getRouteList()
    {
        return $this->withExceptionHandling()->get('/migrations');
    }

    private function assertDisabled(): void
    {
        $this->getRouteList()->assertForbidden();
    }

    private function assertEnabled(): void
    {
        $this->getRouteList()->assertOk();
    }

    public function testDisabledByDefault(): void
    {
        $this->assertDisabled();
    }

    public function testExplicitlyEnabled(): void
    {
        config(['migrations-ui.enabled' => true]);

        $this->assertEnabled();
    }

    public function testExplicitlyDisabled(): void
    {
        config(['migrations-ui.enabled' => false]);

        $this->assertDisabled();
    }

    public function testEnabledWhenDebuggingEnabledLocally(): void
    {
        config(['app.debug' => true, 'app.env' => 'local']);

        $this->assertEnabled();
    }

    public function testDisabledWhenDebuggingIsOff(): void
    {
        config(['app.env' => 'local']);

        $this->assertDisabled();
    }

    public function testDisabledWhenNotLocal(): void
    {
        config(['app.debug' => true]);

        $this->assertDisabled();
    }
}
