<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ExampleModel;
use App\Views\ExampleView;
use Illuminate\View\View;

class ExampleController extends Controller
{
    protected $model = null;

    protected $view = null;

    public function __construct(ExampleModel $model, ExampleView $view)
    {
        $this->model = $model;
        $this->view  = $view;
    }


    public function createExample(Request $request): View
    {
        if (!$code = $request->request->get('code')) {
            throw new BadInputController('Example code missing');
        }

        if (!$description = $request->request->get('description')) {
            throw new BadInputController('Example description missing');
        }

        return $this->view->get(
            $this->model->create(now(), $code, $description)
        );
    }
}
