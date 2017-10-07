<?php
namespace CoinhiveBundle\Validator;

use GuzzleHttp\ClientInterface;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

/**
 * Class IsTrueValidator
 */
class IsTrueValidator extends ConstraintValidator
{
    /**
     * @var
     */
    private $siteKey;

    /**
     * @var ClientInterface
     */
    private $client;

    /**
     * @param ClientInterface $client
     * @param $siteKey
     */
    public function __construct(
        ClientInterface $client,
        $siteKey
    )
    {

        $this->siteKey = $siteKey;
        $this->client = $client;
    }

    /**
     * {@inheritdoc}
     */
    public function validate($token, Constraint $constraint)
    {
        if (!isset($token['coinhive-captcha-token']) || !$token['coinhive-captcha-token']) {
            $this->context->addViolation($constraint->message);
        }

        if (isset($token['coinhive-captcha-token']) && $token['coinhive-captcha-token']) {
            $res = $this->client
                ->request(
                    'POST',
                    'https://api.coinhive.com/token/verify',
                    [
                        'headers' => [
                            'hashes'     => 256,
                            'secret'     => $this->siteKey,
                            'token'     => $token['coinhive-captcha-token']
                        ]
                    ]
                )
                ->getBody()
                ->getContents()
            ;

            $res = json_decode($res, true);

            if (!$res || !isset($res['success']) || !$res['success']) {
                $this->context->addViolation($constraint->message);
            }
        }
    }
}
