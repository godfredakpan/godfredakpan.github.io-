<?php

namespace godfredakpan\Moneywave\Tests\Service;

use godfredakpan\Moneywave\Enum\Banks;
use godfredakpan\Moneywave\Enum\Environment;
use godfredakpan\Moneywave\Exception\ValidationException;
use godfredakpan\Moneywave\Moneywave;
use godfredakpan\Moneywave\Service\DisburseBulk;
use PHPUnit\Framework\TestCase;

class DisburseBulkTest extends TestCase
{
    /** @var DisburseBulk */
    private $serviceObject;

    public function setUp()
    {
        $moneywave = new Moneywave(ACCESS_TOKEN, API_KEY, SECRET_KEY, Environment::STAGING);
        $this->serviceObject = $moneywave->createDisburseBulkService();
    }

    public function testRequestMethod()
    {
        $this->assertEquals('post', strtolower($this->serviceObject->getRequestMethod()));
    }

    public function testFailsValidation()
    {
        $this->expectException(ValidationException::class);
        $this->serviceObject->validatePayload();
    }

    public function testPassValidation()
    {
        $this->serviceObject->lock = 'wallet password';
        $this->serviceObject->name = 'move';
        $this->serviceObject->ref = 'reference#10';
        $this->serviceObject->senderName = 'Moneywave Sender';
        $this->serviceObject->recipients = [
            'bankcode'      => Banks::DIAMOND_BANK,
            'accountNumber' => '0123456789',
            'amount'        => 10,
            'ref'           => '01',
        ];
        $this->assertTrue($this->serviceObject->validatePayload());
    }
}
