<?php

declare(strict_types = 1);

namespace Example\View;

use Example\Model\ExampleModel;
use Mini\Controller\Exception\BadInputException;

/**
 * Example view builder.
 */
class ExampleView
{
    /**
     * Example data.
     *
     * @var Example\Model\ExampleModel|null
     */
    protected $model = null;

    /**
     * Get the example view to display its data.
     *
     * @param ExampleModel $model
     * @return string view template
     *
     * @throws BadInputException if no example data is returned
     */
    public function get(ExampleModel $model): string
    {
        echo($model->getId());
        if (!$model->getId()) {
            throw new BadInputException('Unknown example ID');
        }

        return view('app/example/detail', $model->getExample());
    }

    public function getSum(int $sum): string
    {
        $sumArray = [
            'sum' => $sum
        ];
        return view('app/example/sum', $sumArray);
    }
}
