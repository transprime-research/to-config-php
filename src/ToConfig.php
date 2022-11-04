<?php

declare(strict_types=1);

namespace Transprime\ToConfigPhp;

use Transprime\ToConfigPhp\Samples\ExampleConfig;

class ToConfig
{
    private ExampleConfig $config;

    public function __construct(ExampleConfig $config)
    {
        $this->config = $config;

        $this->config->methods = new ExampleConfig();
        $this->config->methods->appVersion('1');
        $this->config->methods->timeZone('Europe/Helsinki');
        $this->config->methods->methods = new ExampleConfig();
        $this->config->methods->methods->timeZone('Africa/Nigeria');
        $this->config->methods->methods->appVersion('2');
    }

    public function get(): array
    {
        return $this->config->toArray();
    }

    public function generate(string $path): void
    {
        $values = $this->getPHPArray($this->config);

        $content = "<?php \n\nreturn [\n" . $values . "\n];";

        file_put_contents($path, $content);
    }

    public function getPHPArray(ExampleConfig $values): string
    {
        return collect($values)
            ->map(function ($value, $key) {

                if ($value instanceof ExampleConfig) {
                    return $this->getPHPArray($value);
                }
                return "\t\t'$key' => '$value'";
            })
            ->implode(",\n");
    }
}