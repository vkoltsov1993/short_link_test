<?php

namespace App\Http\Controllers;

use App\Exceptions\CannotFindLongLinkException;
use App\Http\Requests\LinkStoreRequest;
use App\Http\Resources\LinkResource;
use App\Services\ShortLinkService;

class ShortLinkController extends Controller
{
    public function __construct(
        public readonly ShortLinkService $shortLinkService
    ) {
    }

    public function index()
    {
        return view('index');
    }

    public function makeShort(LinkStoreRequest $request)
    {
        $longLink = $request->link;
        $link = $this->shortLinkService->make($longLink);
        return new LinkResource($link);
    }

    public function redirectTo(string $link)
    {
        try {
            $longLink = $this->shortLinkService->get($link);
            return redirect($longLink);
        } catch (CannotFindLongLinkException $exception) {
            return response()->json($exception->getMessage(), $exception->getCode());
        }
    }
}
