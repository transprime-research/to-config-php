<?php

use Transprime\ToConfigPhp\Samples\ExampleConfig;

class ExampleConfigTest extends \PHPUnit\Framework\TestCase
{
    public function testItWorks(): void
    {
//        $exampleConfig = new \Transprime\ToConfigPhp\ExampleConfig();


        $this->assertTrue(true);
    }

    public function testItWorks2(): void
    {
        $toConfig = new Transprime\ToConfigPhp\ToConfig(new ExampleConfig());

        var_dump($toConfig->get());
        $toConfig->generate(__DIR__. '/../example_configs/app.php');

        $this->assertTrue(true);
    }
}