<?php

namespace ruano_a\ReloadAnnotationBundle\PHPUnit;

use ruano_a\ReloadAnnotationBundle\Annotations\ReloadDatabaseAfter;
use ruano_a\ReloadAnnotationBundle\Annotations\ReloadDatabaseBefore;
use ruano_a\ReloadAnnotationBundle\Database\DatabaseRefresher;
use ruano_a\ReloadAnnotationBundle\PHPUnit\TestAnnotationReader;
use PHPUnit\Runner\AfterTestHook;
use PHPUnit\Runner\BeforeTestHook;

class PHPUnitExtension implements BeforeTestHook, AfterTestHook
{
    protected $databaseRefresher;
    protected $testAnnotationReader;

    public function __construct()
    {
        $this->databaseRefresher    = new DatabaseRefresher();
        $this->testAnnotationReader = new TestAnnotationReader();
    }

    /*
     * Note : $test contains the dataset too, giving something like:
     * App\Tests\Service\ThingServiceTest::testStuff with data set #0 (0, null, 'missing.parameter')
     */
    public function executeBeforeTest(string $test): void
    {
        $reloadAnnotation = $this->testAnnotationReader->getTestAnnotation($test, ReloadDatabaseBefore::class);
        if ($reloadAnnotation !== null)
        {
            $this->databaseRefresher->refresh();
        }
    }

    public function executeAfterTest(string $test, float $time): void
    {
        $reloadAnnotation = $this->testAnnotationReader->getTestAnnotation($test, ReloadDatabaseAfter::class);
        if ($reloadAnnotation !== null)
        {
            $this->databaseRefresher->refresh();
        }
    }
}
