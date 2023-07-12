<?php

namespace App\Services;

use App\Models\Link;

interface ShortLinkService
{
    /**
     * @param  string  $link
     * @return Link
     */
    public function make(string $link): Link;

    /**
     * @param  string  $shortLink
     * @return string
     */
    public function get(string $shortLink): string;
}
