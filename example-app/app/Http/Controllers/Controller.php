<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * Check that an array contains a list of keys.
     *
     * @param Request $request      http request
     * @param array   $hasValueKeys list of keys that must be defined and have a value
     * @param array   $existsKeys   list of keys that must be defined
     * 
     * @return void
     *
     * @throws BadInputController if a "required value" input is empty
     * @throws BadInputController if a "required key" input is missing
     */
    protected function hasKeys(Request $request, array $hasValueKeys = [], array $existsKeys = []): void
    {
        $post = $request->request->all();

        foreach ($hasValueKeys as $key) {
            if (!array_key_exists($key, $post)) {
                throw new BadInputController('Empty/Missing key: ' . $key);
            }
        }

        foreach ($existsKeys as $key) {
            if (!array_key_exists($key, $post)) {
                throw new BadInputController('Missing key: ' . $key);
            }
        }
    }

    /**
     * Get values from POST based off part of a key.
     * 
     * @param Request $request    http request
     * @param string  $partialKey partial POST key
     * 
     * @return array values linked to that partial key
     */
    protected function getValuesByPartialKey(Request $request, string $partialKey): array
    {
        return array_filter($request->request->all(), function ($value, $key) use ($partialKey) {
            return strpos($key, $partialKey) === 0;
        }, ARRAY_FILTER_USE_BOTH);
    }
}
