# CoinhiveBundle

[![Build Status](https://api.travis-ci.org/medzoner/CoinhiveBundle.svg)](https://travis-ci.org/medzoner/CoinhiveBundle)

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

``` yaml
# app/config/config.yml

coinhive_captcha:
    site_key:  your_site_key
```

**NOTE**: This Bundle lets the client browser choose the secure https or unsecure http API.
