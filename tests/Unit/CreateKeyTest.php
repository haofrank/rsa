<?php

namespace HaoFrank\Test\Unit;

use HaoFrank\Rsa\RSA;

class CreateKeyTest extends \PHPUnit\Framework\TestCase
{

    /**
     * @test
     */
    public function createKey()
    {
        $rea = new RSA();

        $keys = $rea->createKey();
        extract($keys);

        $this->assertNotEmpty($privatekey);
        $this->assertNotEmpty($publickey);
    }

    /**
     * @test
     */
    public function loadKey()
    {

    }
}
