<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdvertisementRequest;
use App\Http\Requests\AdvertisementShowRequest;
use App\Http\Resources\AdvertisementCollection;
use App\Http\Resources\AdvertisementResource;
use App\Repositories\AdvertisementRepository;
use Illuminate\Http\JsonResponse;

class AdvertisementController extends Controller
{
    public function __construct(private readonly AdvertisementRepository $advertisementRepository)
    {}

    public function store(AdvertisementRequest $request): JsonResponse
    {
        $validated = $request->validated();
        $advertisementId = $this->advertisementRepository->store($validated);

        return response()->json($advertisementId);
    }

    public function index(AdvertisementRequest $request): JsonResponse
    {
        $validated = $request->validated();
        $advertisements = $this->advertisementRepository->index($validated);

        if ($advertisements->items()) {
            return response()->json(new AdvertisementCollection($advertisements));
        }else{
            return $this->sendError(['resource'=>'Не найден']);
        }
    }

    public function show(AdvertisementShowRequest $request, $id): JsonResponse
    {
        $advertisement = $this->advertisementRepository->getById($id);

        if ($advertisement) {
            return response()->json(new AdvertisementResource($advertisement));
        }else{
            return $this->sendError(['resource'=>'Не найден']);
        }

    }

}
