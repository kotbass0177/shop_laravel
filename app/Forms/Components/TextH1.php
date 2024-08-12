<?php

namespace App\Forms\Components;

use Filament\Forms\Components\Field;

class TextH1 extends Field
{
    protected string $view = 'forms.components.text-h1';

    protected string | \Closure | null $backgroundColor = "";

    public function backgroundColor(string | \Closure | null $backgroundColor): static
    {
        $this->backgroundColor = $backgroundColor;
        return $this;
    }
    public function getBackgroundColor(): ?string
    {
        return $this->evaluate($this->backgroundColor);
    }
}
