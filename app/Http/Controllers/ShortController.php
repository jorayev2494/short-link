<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreShortRequest;
use App\Http\Requests\VisitShortRequest;
use App\Http\Resources\UrlResource;
use App\Models\Url;
use App\Services\ShortService;
use Illuminate\Http\RedirectResponse;
use Symfony\Component\HttpFoundation\JsonResponse;

class ShortController extends Controller
{

    public function __construct(
        private ShortService $service
    )
    {

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(): JsonResponse
    {
        $result = $this->service->get();

        return response()->json(UrlResource::collection($result));
    }

    /**
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreShortRequest $request): JsonResponse
    {
        $result = $this->service->store($request->validated());

        return response()->json($result);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function visit(VisitShortRequest $request, string $shortUrl): RedirectResponse
    {
        /** @var Url $url */
        $url = $this->service->visit($shortUrl);

        return response()->redirectTo($url->client_url);
    }
}
