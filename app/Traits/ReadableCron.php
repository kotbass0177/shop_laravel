<?php

namespace App\Traits;

use Illuminate\Support\Facades\App;
use Lorisleiva\CronTranslator\CronParsingException;
use Lorisleiva\CronTranslator\CronTranslator;

trait ReadableCron
{
    public function cronExpressionField(): string {
        return \env('CRON_EXPRESSION_FIELD', 'cron_expression');
    }
    public function readableCron(): string
    {
        try {
            return CronTranslator::translate($this->{$this->cronExpressionField()}, 'en', true);
        } catch (CronParsingException $exception) {
            return $this->{$this->cronExpressionField()};
        }
    }
}
