<?php
namespace CoinhiveBundle\Validator;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class IsTrueValidator extends ConstraintValidator
{
    /**
     *
     */
    public function __construct()
    {

    }

    /**
     * {@inheritdoc}
     */
    public function validate($value, Constraint $constraint)
    {
        //curl -X POST \
    //-d "token=<coinhive-captcha-token>" \
    //-d "hashes=1024" \
    //-d "secret=<secret-key>" \
    //"https://api.coinhive.com/token/verify"
        if (!isset($value['captcha']) || !$value['captcha']) {
            $this->context->addViolation($constraint->message);
        }
    }
}