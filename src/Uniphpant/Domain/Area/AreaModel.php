<?php
declare(strict_types=1);

namespace App\Uniphpant\Domain\Area;

use App\Common\Domain\CommonModel;
use App\User\Domain\UserCredentialsEntity;
use App\User\Domain\UserProfileEntity;
use App\Authenticate\Repository\AuthenticateRepository;
use App\Domain\User\UserRepository;
use App\Common\TableGateway\Service\TableGatewayService;

/**
 * Class AuthenticateUserModel
 * @package App\Authenticate\Domain
 */
class AreaModel extends CommonModel
{
    const ALIAS="area_model";

    public AreaEntity $area;
    public TableGatewayService $gatewayService;

    public function __construct(TableGatewayService $gatewayService, AreaEntity $area)
    {
        $this->gatewayService = $gatewayService;
        $this->area = $area;
    }

    /**
     * @return UserProfileEntity
     */
    public function getProfile(): UserProfileEntity
    {
        return $this->profile;
    }

    /**
     * @param UserProfileEntity $profile
     * @return AuthenticateUserModel
     */
    public function setProfile(UserProfileEntity $profile): AuthenticateUserModel
    {
        $this->profile = $profile;
        return $this;
    }

    /**
     * @return UserCredentialsEntity
     */
    public function getCredentials(): UserCredentialsEntity
    {
        return $this->credentials;
    }

    /**
     * @param UserCredentialsEntity $credentials
     * @return AuthenticateUserModel
     */
    public function setCredentials(UserCredentialsEntity $credentials): AuthenticateUserModel
    {
        $this->credentials = $credentials;
        return $this;
    }

}
