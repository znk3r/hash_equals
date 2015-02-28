# hash_equals

PHP implementation of hash_equals() for versions previous to 5.6

This function has been created to compare hash strings, in a way that prevents timing attacks. Some libraries have
similar implementations, but as part of bigger packages.

## Installation ##

Via [composer.json](http://getcomposer.org/doc/01-basic-usage.md#composer-json-project-setup)

    "require": {
        "znk3r/hash_equals": "dev-master"
    }

## Basic Usage ##

The function should be available automatically after being added to composer (remember to run "composer update")

    <?php
    
    if (!hash_equals($storedHash, $userGeneratedHash)) {
        echo "The strings are different"; 
    }

## Timing attacks

As described by Pádraic Brady in [an article from 2010]
(http://blog.astrumfutura.com/2010/10/nanosecond-scale-remote-timing-attacks-on-php-applications-time-to-take-them-seriously/):

> A Timing Attack is a form of Side Channel Attack which allows an attacker to discover some secret input to 
> an operation by measuring the operation’s execution time often based on a set of attacker derived inputs.

> At first look, this seems like an impossible task but in reality it doesn’t take much thinking to realise how
> many web applications likely treat existing and non-existing usernames differently during a login attempt. 
> Differing treatment may lead to clues about the validity of any username in a few ways

These attacks are complex to implement, but have already been used a couple of times.

On PHP-5.6, hash_equals() was added to help with this type of attack, but the function is not available for previous
versions, leaving them vulnerable.

This function should be used to mitigate timing attacks, specially when comparing hashes, but not as general
alternative for all string comparisons.
