<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    protected $connectionsToReset = ['mysql','mysql2'];

    protected $connectionsToTransact = ['mysql','mysql2'];
}
