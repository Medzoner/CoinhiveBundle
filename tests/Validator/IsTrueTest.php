<?php

namespace Tests\Validator;

use CoinhiveBundle\Validator\IsTrue;

/**
 * Class IsTrueTest
 */
class IsTrueTest extends \PHPUnit_Framework_TestCase
{
    /**
     *
     */
    public function testMessage()
    {
        $v =new IsTrue();
        $this->assertContains('captcha', $v->message);
    }
}