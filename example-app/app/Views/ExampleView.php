<?php

namespace App\Views;

use App\Models\ExampleModel;
use App\Http\Controllers\BadInputController;
use Illuminate\View\View;

class ExampleView
{
    protected $model = null;

    public function __construct(ExampleModel $model)
    {
        $this->model = $model;
    }


    public function get(int $id): View
    {
        $data = $this->model->get($id);

        if (!$data) {
            throw new BadInputController('Unknown example ID');
        }

        dd($data);

        return view('example/detail', ['data'=>$data]);
    }
}