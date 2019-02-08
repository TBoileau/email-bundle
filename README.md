The Symfony EmailBundle
=======================

[![Build Status](https://travis-ci.org/TBoileau/email-bundle.svg?branch=master)](https://travis-ci.org/TBoileau/email-bundle)

[![SymfonyInsight](https://insight.symfony.com/projects/89c2f211-166d-45e2-846a-59871a2b65c9/big.svg)](https://insight.symfony.com/projects/89c2f211-166d-45e2-846a-59871a2b65c9)

The EmailBundle is a simplier way to manage your emails.

Installation
============

Applications that use Symfony Flex
----------------------------------

Open a command console, enter your project directory and execute:

```console
$ composer require tboileau/email-bundle
```

Applications that don't use Symfony Flex
----------------------------------------

### Step 1: Download the Bundle

Open a command console, enter your project directory and execute the
following command to download the latest stable version of this bundle:

```console
$ composer require tboileau/email-bundle
```

This command requires you to have Composer installed globally, as explained
in the [installation chapter](https://getcomposer.org/doc/00-intro.md)
of the Composer documentation.

### Step 2: Enable the Bundle

Then, enable the bundle by adding it to the list of registered bundles
in the `app/AppKernel.php` file of your project:

```php
<?php
// app/AppKernel.php

// ...
class AppKernel extends Kernel
{
    public function registerBundles()
    {
        $bundles = [
            // ...
            new TBoileau\Bundle\EmailBundle\TBoileauEmailBundle()
        ];

        // ...
    }

    // ...
}
```

Configuration
-------------

First, you need to define your email in `services.yaml` with this tag `t_boileau.email` :
```yaml
services:
    # ...
    App\Email\FooEmail:
        tags:
            - { name: t_boileau.email }
```

In case you have multiple emails, you can define in one time all your emails :
```yaml
services:
    # ...
    App\Email\:
        resource: '../src/Email'
        tags:
            - { name: t_boileau.email }
```

Create your first email
-------------------------

If you are used to using SwiftMailer, you will not be lost, otherwise you can check the [documentation](https://swiftmailer.symfony.com/docs/introduction.html).
```php
<?php
namespace App\Email;

use Symfony\Component\OptionsResolver\OptionsResolver;
use TBoileau\Bundle\EmailBundle\Builder\MessageBuilderInterface;
use TBoileau\Bundle\EmailBundle\Email\AbstractEmail;

/**
 * Class FooEmail
 *
 * @package TBoileau\Bundle\EmailBundle\Tests\Email
 * @author Thomas Boileau <t-boileau@email.com>
 */
class FooEmail extends AbstractEmail
{
    public function buildMessage(MessageBuilderInterface $builder, array $options): void
    {
        $builder
            ->setSubject("subject")
            ->setFrom("t-boileau@email.com")
            ->setTo("t-boileau@email.com")
            ->setBody("Hello ".$options["name"])
        ;
    }

    public function configure(OptionsResolver $resolver): void
    {
        $resolver->setRequired("name");
    }
}
```

As you can see, in the `configure` method you can specify some options. In this case, we need a **name** that we can use in in `buildMessage`.

Inject service in your email
----------------------------

You don't need to define your dependencies in `services.yaml`. Since 3.4, you can use autowiring and type-hint to inject automaticaly in your service :
```php
<?php
// ...

use TBoileau\Bundle\EmailBundle\Email\AbstractEmail;
use Twig\Environment;

class FooEmail extends AbstractEmail
{
    /**
     * @var Environment
     */
    private $twig;
    
    /**
     * FooEmail constructor.
     * @param Environment $twig
     */
    public function __construct(Environment $twig)
    {
        $this->twig = $twig;
    }
}
```

Send an email in a controller
-----------------------------

To send your email, you need to inject in your controller the `TBoileau\Bundle\EmailBundle\Factory\MailerFactoryInterface`, and just call `send` method :
```php
<?php
// src/Controller/DefaultController.php

namespace App\Controller;

use App\Email\FooEmail;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use TBoileau\Bundle\EmailBundle\Factory\MailerFactoryInterface;

class DefaultController extends AbstractController
{
    /**
     * @Route("/", name="default")
     */
    public function index(MailerFactoryInterface $mailerFactory)
    {
        $mailerFactory->create(FooEmail::class)->send([
            "name" => "your name"
        ]);
        
        // ...
    }
}
```
