<?php
declare(strict_types=1);

namespace App\Shrt\Domain;


class FormFilter
{

    public function getDefinition()
    {
        return [
            'url' => [
                'name' => 'url',
                'filter'    => FILTER_SANITIZE_STRING,
            ],//FILTER_REQUIRE_ARRAY,
        ];
    }

    public function filterPostData()
    {
        return filter_input_array(INPUT_POST,$this->getDefinition());
    }

}
