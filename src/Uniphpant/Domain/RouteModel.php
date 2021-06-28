<?php
declare(strict_types=1);

namespace App\Authenticate\Domain;

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
class RouteModel extends CommonModel
{
    const ALIAS="route_model";

    public AreaEntity $profile;
    public BlockEntity $credentials;
    public TableGatewayService $gatewayService;

    public function __construct(TableGatewayService $gatewayService, UserProfileEntity $profile, UserCredentialsEntity $credentials)
    {
        $this->gatewayService = $gatewayService;
        $this->profile = $profile;
        $this->credentials = $credentials;
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
