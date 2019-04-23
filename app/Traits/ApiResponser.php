<?php

namespace App\Traits;

use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Model;

trait ApiResponser
{
    private function successResponse($data, $code)
    {
        return response()->json($data, $code);
    }

    protected function errorResponse($message, $code)
    {
        return response()->json(['error' => $message, 'code' => $code], $code);
    }

    protected function showAll(Collection $collection, $code = 200)
    {
        // Transformer Data
        if ($collection->isEmpty()) {
            return $this->successResponse(['data' => $collection], $code);
        }

        $transformer = $collection->first()->transformer;
        $collection = $this->transformData($collection, $transformer);

        // Before Transformer
        // return $this->successResponse(['data' => $collection], $code);
        return $this->successResponse($collection, $code);
    } 

    protected function showOne(Model $instance, $code = 200)
    {
        // Transformer Data
        $transformer = $instance->transformer;
        $instance = $this->transformData($instance, $transformer);

        // Before Transformer
        // return $this->successResponse(['data' => $instance], $code);
        return $this->successResponse($instance, $code);
    }

    // Untuk email
    protected function showMessage($message, $code = 200)
    {
        return $this->successResponse(['data' => $message], $code);
    }

    // Sorting Data
    protected function sortData(Collection $collection)
    {
        if (request()->has('sort_by')) {
            $attribute = request()->sort_by;
            $collection = $collection->sortBy($attribute);
        }

        return $collection;
    }

    // Transformer Data
    protected function transformData($data, $transformer)
    {
        $transformation = fractal($data, new $transformer);
        return $transformation->toArray();
    }
}