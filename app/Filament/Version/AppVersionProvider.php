<?php
namespace App\Filament\Version;

use Awcodes\FilamentVersions\Providers\Contracts\VersionProvider;
use Illuminate\Support\Facades\File;
use Mistralys\ChangelogParser\ChangelogParser;

class AppVersionProvider implements VersionProvider
{
    public function getName(): string
    {
        return \config('app.name');
    }

    public function getVersion(): string
    {
        $parser = ChangelogParser::parseMarkdownFile(base_path('CHANGELOG.md'));

        $latest = $parser->getLatestVersion();
        $version = $latest->getVersionInfo()->getOriginalString();
        $labels = \explode(' ', $latest->getLabel());
        $date = $labels[count($labels) - 1];
        return $version . $date;
    }

}
