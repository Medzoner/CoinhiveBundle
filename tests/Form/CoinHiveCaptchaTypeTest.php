<?php

namespace Tests\Form;

use CoinhiveBundle\Form\CoinHiveCaptchaType;
use Symfony\Component\Form\Test\TypeTestCase;

/**
 * Class CoinHiveCaptchaTypeTest
 */
class CoinHiveCaptchaTypeTest extends TypeTestCase
{
    /**
     *
     */
    public function testSubmitValidData()
    {
        $formData = [
            'email' => 'test',
            'coinhive-captcha-token' => null
        ];

        $form = $this->factory->create(CoinHiveCaptchaType::class);

        $form->submit($formData);

        $this->assertTrue($form->isSynchronized());
    }
}