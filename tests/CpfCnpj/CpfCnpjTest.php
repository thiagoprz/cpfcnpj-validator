<?php

namespace Thiagoprz\CpfCnpjValidator\Test\CpfCnpj;

use Faker\Factory;
use Thiagoprz\CpfCnpjValidator\CpfCnpj;
use Thiagoprz\CpfCnpjValidator\Test\TestCase;

class CpfCnpjTest extends TestCase
{
    /**
     * @var CpfCnpj
     */
    protected $rule;

    /**
     * @var array Valid CPFs/CNPJs
     */
    protected $valid = [];

    /**
     * @var array Invalid CPFs/CNPJs
     */
    protected $invalid = [];

    /**
     * Test setup
     */
    public function setUp(): void
    {
        parent::setUp();
        $this->rule = new CpfCnpj();
        $factory = Factory::create('pt_BR');
        $this->valid = [];
        for ($i = 0; $i < 100; $i++) {
            $this->valid[] = $factory->cpf;
            $this->valid[] = $factory->cnpj;
        }
        $this->invalid = [];
        for ($i = 0; $i < 50; $i++) {
            $this->invalid[] = $factory->randomNumber();
        }
        for ($i = 0; $i < 50; $i++) {
            $this->invalid[] = $factory->domainWord;
        }
    }

    /**
     * Valid identifier passing test
     *
     * @return void
     * @testdox test success for valid CPF/CNPJ
     */
    public function testCpfCnpjPass()
    {
        foreach ($this->valid as $identifier) {
            $this->assertTrue($this->rule->passes('cpf_cnpj', $identifier));
        }
    }

    /**
     * Invalid identifiers test (fails)
     * @testdox tests failing CPF/CNPJ
     */
    public function testCpfCnpjFail()
    {
        foreach ($this->invalid as $identifier) {
            $this->assertFalse($this->rule->passes('cpf_cnpj', $identifier));
        }
    }

}