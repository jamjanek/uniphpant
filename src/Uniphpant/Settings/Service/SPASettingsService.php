<?php
declare(strict_types=1);

namespace App\Uniphpant\Settings\Service;

use App\Uniphpant\Settings\SettingsInterface;
use Laminas\Db\TableGateway\TableGateway;
use App\Uniphpant\Settings\Domain\SPASettingsEntity;
use App\Uniphpant\TableGateway\Domain\TableGatewayCollection;
use App\Uniphpant\Settings\Settings;

class SPASettingsService
{
    protected array $settings;

    public function __construct(SettingsInterface $settingsInterface)
    {
        $this->settings = $settingsInterface->get(SPASettingsEntity::TYPE);
    }

    public function get(string $key = '')
    {
        return (empty($key)) ? $this->settings : $this->settings[$key];
    }
}
