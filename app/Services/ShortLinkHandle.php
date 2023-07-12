<?php

namespace App\Services;

use App\Exceptions\CannotFindLongLinkException;
use App\Models\Link;
use Illuminate\Support\Str;

class ShortLinkHandle implements ShortLinkService
{
    /**
     * @param  string  $link
     * @return Link
     */
    public function make(string $link): Link
    {
        $shortLink = Str::random(6);
        return Link::firstOrCreate([
            'long_link' => $link,
        ], [
            'short_link' => $shortLink,
        ]);
    }

    /**
     * @param  string  $shortLink
     * @return string
     * @throws CannotFindLongLinkException
     */
    public function get(string $shortLink): string
    {
        $link = Link::where('short_link', $shortLink)->first();
        if ($link) {
            return $link->long_link;
        }
        throw new CannotFindLongLinkException($shortLink);
    }
}
