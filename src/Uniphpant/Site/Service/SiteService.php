<?php
declare(strict_types=1);

namespace App\Uniphpant\Site\Service;

use App\Uniphpant\Settings\SettingsInterface;
use Laminas\Db\TableGateway\TableGateway;
use App\Uniphpant\Settings\Domain\SiteSettingsEntity;
use App\Uniphpant\TableGateway\Domain\TableGatewayCollection;
use App\Uniphpant\Settings\Settings;

class SiteService
{
    protected string $site_id;
    protected array $settings;

    public function __construct(SettingsInterface $settingsInterface)
    {
        $this->site_id = $_ENV['SITE_ID'];
        $this->settings = $settingsInterface->get(SiteSettingsEntity::TYPE);
    }

    public function get(string $key = '')
    {
        return (empty($key)) ? $this->settings : $this->settings[$key];
    }
}
