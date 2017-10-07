<?php

namespace CoinhiveBundle\Validator;

use GuzzleHttp\Client;
use Symfony\Component\Validator\Context\ExecutionContext;
use Symfony\Component\Validator\Test\ConstraintValidatorTestCase;

/**
 * Class IsTrueValidatorTest
 */
class IsTrueValidatorTest extends ConstraintValidatorTestCase
{
    /**
     * @var Client
     */
    public $clientHttpMock;

    protected function setUp()
    {
        $this->clientHttpMock = $this->prophesize(Client::class);
        parent::setUp();

    }

    /**
     *
     */
    public function testValidate()
    {
        $validator = $this->createValidator();

        $token = ['coinhive-captcha-token' => 'token'];

        $this->clientHttpMock->request(
            'POST',
            'https://api.coinhive.com/token/verify',
            [
                'headers' => [
                    'hashes'     => 256,
                    'secret'     => '',
                    'token'     => 'token'
                ]
            ]
        )->willReturn(new clientReturn());

        $validator->initialize($this->context);

        $validator->validate($token, new IsTrue());
        $this->assertNoViolation();
    }

    /**
     *
     */
    public function testNotValidate()
    {
        $validator = $this->createValidator();

        $this->clientHttpMock->request(
            'POST',
            'https://api.coinhive.com/token/verify',
            [
                'headers' => [
                    'hashes'     => 256,
                    'secret'     => '',
                    'token'     => 'token'
                ]
            ]
        )->willReturn(new clientReturn());

        $validator->initialize($this->context);

        $validator->validate('rrr', new IsTrue());

        $this->assertCount(1, $this->context->getViolations());
    }

    /**
     * @return IsTrueValidator
     */
    protected function createValidator()
    {
        return new IsTrueValidator(
            $this->clientHttpMock->reveal(),
            ''
        );
    }
}

/**
 * Class clientReturn
 * @package CoinhiveBundle\Validator
 */
class clientReturn
{
    public function getBody()
    {
        return $this;
    }

    public function getContents()
    {
        return '{"success": true, "created": 1504205981, "hashes": 1024}';
    }
}