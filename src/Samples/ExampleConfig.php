<?php

declare(strict_types=1);

namespace Transprime\ToConfigPhp\Samples;

use JsonSerializable;
use Transprime\ToConfigPhp\Util\Str;

class ExampleConfig implements JsonSerializable
{
    private string $root = '.';
    private string $case = 'snake';

    public string $appVersion = '';

    public string $timeZone = 'Europe/Tallinn';

    public ExampleConfig $methods;

    public function timeZone(string $timeZone): self
    {
        $this->timeZone = $timeZone;

        return $this;
    }

    public function appVersion(string $appVersion): self
    {
        $this->timeZone = $appVersion;

        return $this;
    }

    public function toArray(): array
    {
        return collect(get_object_vars($this))
            ->except(['root', 'case'])
            ->flatMap(fn($value, $key) => [Str::snake($key) => $value])
            ->all();
    }

    public function jsonSerialize(): array
    {
        return $this->toArray();
    }
}