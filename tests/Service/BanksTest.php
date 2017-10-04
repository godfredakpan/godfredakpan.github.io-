<?php

namespace godfredakpan\Moneywave\Tests\Service;

use godfredakpan\Moneywave\Enum\Environment;
use godfredakpan\Moneywave\Moneywave;
use godfredakpan\Moneywave\Service\Banks;
use PHPUnit\Framework\TestCase;

class BanksTest extends TestCase
{
    /** @var Banks */
    private $serviceObject;

    public function setUp()
    {
        $moneywave = new Moneywave(ACCESS_TOKEN, API_KEY, SECRET_KEY, Environment::STAGING);
        $this->serviceObject = $moneywave->createBanksService();
    }

    public function testRequestMethod()
    {
        $this->assertEquals('post', strtolower($this->serviceObject->getRequestMethod()));
    }

    public function testPassValidation()
    {
        $this->assertTrue($this->serviceObject->validatePayload());
    }
}
