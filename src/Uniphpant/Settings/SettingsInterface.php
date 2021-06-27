<?php
declare(strict_types=1);

namespace App\Uniphpant\Settings;

interface SettingsInterface
{
    /**
     * @param string $key
     * @return mixed
     */
    public function get(string $key = '');
}