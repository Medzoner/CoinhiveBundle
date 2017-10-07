<?php
namespace CoinhiveBundle\Validator;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 * @Target("PROPERTY")
 */
class IsTrue extends Constraint
{
    public $message = 'This value is not a valid captcha.';

    /**
     * {@inheritdoc}
     */
    public function getTargets()
    {
        return Constraint::PROPERTY_CONSTRAINT;
    }
    /**
     * {@inheritdoc}
     */
    public function validatedBy()
    {
        return 'coinhive_captcha_validator';
    }
}