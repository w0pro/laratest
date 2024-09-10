<?php

namespace App\Repositories;

use App\Interfaces\RepositoryInterface;
use App\Models\Advertisement;
use App\Models\AdvertisementPhoto;

class AdvertisementRepository implements RepositoryInterface
{

    public function __construct()
    {}

    public function index(array $data)
    {
        $advertisementBuilder = Advertisement::query();
        if (isset($data['order']) && isset($data['orderBy'])) {
            $advertisementBuilder->orderBy($data['order'], $data['orderBy']);
        }

        return $advertisementBuilder->paginate(10);
    }

    public function getById($id)
    {
        return Advertisement::find($id);
    }

    public function store(array $data)
    {
        $advertisement =  Advertisement::create($data);
        $links = isset($data['links'])?array_map(fn($link) => array('link'=> $link, 'advertisement_id' => $advertisement->id), $data['links']):[];

        if ($links) {
            AdvertisementPhoto::insert($links);
        }
        return $advertisement->id;
    }

    public function update(array $data, $id)
    {
        // TODO: Implement update() method.
    }

    public function delete($id)
    {
        // TODO: Implement delete() method.
    }
}
