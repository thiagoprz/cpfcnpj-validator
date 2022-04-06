<?php

namespace Thiagoprz\CpfCnpjValidator\Test\Cnpj;

use Faker\Factory;
use Thiagoprz\CpfCnpjValidator\CpfCnpj;
use Thiagoprz\CpfCnpjValidator\Test\TestCase;

class CnpjTest extends TestCase
{
    /**
     * @var array
     */
    private $valid_cnpjs;

    /**
     * @var array
     */
    private $invalid_cnpjs;

    /**
     * Test setup
     */
    public function setUp(): void
    {
        parent::setUp();
        $this->rule = new CpfCnpj();
        $factory = Factory::create('pt_BR');
        $this->valid_cnpjs = [];
        for ($i = 0; $i < 100; $i++) {
            $this->valid_cnpjs[] = $factory->cnpj;
        }
        $this->invalid_cnpjs = [];
        for ($i = 0; $i < 50; $i++) {
            $this->invalid_cnpjs[] = $factory->randomNumber();
        }
        for ($i = 0; $i < 50; $i++) {
            $this->invalid_cnpjs[] = $factory->domainWord;
        }
    }

    /**
     * Valid identifier passing test
     *
     * @return void
     * @testdox test success for valid CNPJ
     */
    public function testCnpjPass()
    {
        foreach ($this->valid_cnpjs as $identifier) {
            $this->assertTrue($this->rule->passes('cnpj', $identifier));
        }
    }

    /**
     * Invalid identifiers test (fails)
     * @testdox tests failing CNPJ
     */
    public function testCnpjFail()
    {
        foreach ($this->invalid_cnpjs as $identifier) {
            $this->assertFalse($this->rule->passes('cnpj', $identifier));
        }
    }
}