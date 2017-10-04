<?php

namespace godfredakpan\Moneywave\Tests\Service;

use godfredakpan\Moneywave\Enum\Endpoints;
use godfredakpan\Moneywave\Enum\Environment;
use godfredakpan\Moneywave\Moneywave;
use godfredakpan\Moneywave\Service\PreviousTransactionQuery;
use PHPUnit\Framework\TestCase;

class PreviousTransactionQueryTest extends TestCase
{
    /** @var PreviousTransactionQuery */
    private $serviceObject;

    public function setUp()
    {
        $moneywave = new Moneywave(ACCESS_TOKEN, API_KEY, SECRET_KEY, Environment::STAGING);
        $this->serviceObject = $moneywave->createPreviousTransactionQueryService();
    }

    public function testRequestMethod()
    {
        $this->assertEquals('post', strtolower($this->serviceObject->getRequestMethod()));
    }

    public function testPassValidation()
    {
        $this->assertTrue($this->serviceObject->validatePayload());
    }

    public function testEndpoint()
    {
        $transactionId = 100;
        $this->serviceObject->setTransactionId($transactionId);
        $expected = Endpoints::TRANSFER.'/'.$transactionId;
        $this->assertEquals($expected, $this->serviceObject->getRequestPath());
    }
}
