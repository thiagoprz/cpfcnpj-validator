<?php

namespace Thiagoprz\CpfCnpjValidator\Test\Cpf;

use Faker\Factory;
use Thiagoprz\CpfCnpjValidator\CpfCnpj;
use Thiagoprz\CpfCnpjValidator\Test\TestCase;

class CpfTest extends TestCase
{
    /**
     * @var CpfCnpj
     */
    protected $rule;

    /**
     * @var array Valid CPFs
     */
    protected $valid_cpfs = [];

    /**
     * @var array Invalid CPFs
     */
    protected $invalid_cpfs = [];

    /**
     * Test setup
     */
    public function setUp(): void
    {
        parent::setUp();
        $this->rule = new CpfCnpj();
        $factory = Factory::create('pt_BR');
        $this->valid_cpfs = [];
        for ($i = 0; $i < 100; $i++) {
            $this->valid_cpfs[] = $factory->cpf;
        }
        $this->invalid_cpfs = [];
        for ($i = 0; $i < 50; $i++) {
            $this->invalid_cpfs[] = $factory->randomNumber();
        }
        for ($i = 0; $i < 50; $i++) {
            $this->invalid_cpfs[] = $factory->domainWord;
        }
    }

    /**
     * Valid identifier passing test
     *
     * @return void
     * @testdox test success for valid CPF
     */
    public function testCpfPass()
    {
        foreach ($this->valid_cpfs as $identifier) {
            $this->assertTrue($this->rule->passes('cpf', $identifier));
        }
    }

    /**
     * Invalid identifiers test (fails)
     * @testdox tests failing cpf
     */
    public function testCpfFail()
    {
        foreach ($this->invalid_cpfs as $identifier) {
            $this->assertFalse($this->rule->passes('cpf', $identifier));
        }
    }
}