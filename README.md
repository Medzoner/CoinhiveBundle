# CoinhiveBundle

[![Build Status](https://api.travis-ci.org/Medzoner/CoinhiveBundle.svg)](https://travis-ci.org/medzoner/CoinhiveBundle)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/Medzoner/CoinhiveBundle/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/Youshido/GraphQL/?branch=master)
[![Code Coverage](https://scrutinizer-ci.com/g/Medzoner/CoinhiveBundle/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/Youshido/GraphQL/?branch=master)
[![SensioLabsInsight](https://insight.sensiolabs.com/projects/69023c14-bb3b-4ae8-bf1a-31a7aa7bd228/mini.png)](https://insight.sensiolabs.com/projects/8b8ab2a2-32fb-4298-a986-b75ca523c7c9)

This bundle provides Coinhive services. It does'nt depend of coinhive.com

## Installation

### Step 1: Use composer and enable Bundle

To install CoinhiveBundle with Composer just type in your terminal:

```bash
php composer.phar require medzoner/coinhive-bundle
```

Now, Composer will automatically download all required files, and install them
for you. All that is left to do is to update your ``AppKernel.php`` file, and
register the new bundle:

```php
<?php

// in AppKernel::registerBundles()
$bundles = array(
    // ...
    new Medzoner\Bundle\CoinhiveBundle(),
    // ...
);
```

### Step2: Configure the bundle's

Add the following to your config file:

```yaml
# app/config/config.yml

coinhive:
    config:
        site_key: '%coinhive.site_key%'
```

### Step3a: Use captcha in form

Add the following to your formType file:

```php
<?php

use CoinhiveBundle\Validator\IsTrue;

    //....

    /**
     * @param FormBuilderInterface $builder
     * @param array                $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('coinhive-captcha-token', CoinHiveCaptchaType::class, [
                'mapped'      => false,
                'constraints' => [
                    new IsTrue()
                ]
            ])
        ;
    }
    
    //...
```

### Step3b: Use miner on your site

Add the following to your twig files:

```html
{{ coinhive_miner() }}
```

### Demo

https://medzoner.com/contact
