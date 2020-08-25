# ReloadAnnotationBundle
A Symfony bundle providing a PHPUnit extension reloading the database if an annotation is present on test methods.
It only works with a PHPUnit which version is >= 7.5 .
# Configuration

~~~~
composer require --dev ruano_a/reload-annotation-bundle
~~~~

Add the bundle in bundles.php:

```php
if (in_array($env, ['dev', 'test'])) {
    ...
    if ($env === 'test') {
        $bundles[] = new ruano_a\ReloadAnnotationBundle\ReloadAnnotationBundle();
    }
}
```

Add the extension in your xml config (phpunit.xml)

```xml
    <phpunit>
        ...
        <extensions>
            <extension class="ruano_a\ReloadAnnotationBundle\PHPUnit\PHPUnitExtension" />
        </extensions>
    </phpunit>
```
And that's it.

# Available annotations 
- ReloadDatabaseBefore
- ReloadDatabaseAfter


# Notes
This bundle can't work with a PHPUnit version prior to 7.5 because the listener system doesn't seem to let you get
the test method informations.
It is currently not configurable, I might make it one day, if you don't want to wait, contact me.
It has been made for my personal use, but for most common cases, I advise you to use this bundle:
https://github.com/dmaicher/doctrine-test-bundle that is much more optimized, but doesn't let you choose when to perform the rollbacks.
