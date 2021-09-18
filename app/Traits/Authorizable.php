<?php

namespace App\Traits;

use Illuminate\Support\Arr;

trait Authorizable
{
    private $abilities = [
        'index' => 'view-all',
        'show' => 'view-any',
        'update' => 'update',
        'store' => 'store',
        'destroy' => 'delete',
        'attachRole' => 'attach-role-to',
        'detachRole' => 'detach-role-from',
        'attachPermission' => 'attach-permission-to',
        'detachPermission' => 'detach-permission-from',
        'getSendingCorrespondence' => 'view-sent',
        'getReceivingCorrespondence' => 'view-received',
        'getApprovedCorrespondence' => 'view-approved',
        'getDisapprovedCorrespondence' => 'view-disapproved',
        'sendCorrespondence' => 'send',
        'getPendingCorrespondences' => 'view-pending',
        'approveCorrespondence' => 'approve',
        'disapproveCorrespondence' => 'disapprove',
        'getSendingCirculars' => 'view-sent',
        'getReceivingCirculars' => 'view-received',
        'sendCircular' => 'send',
        'deleteCircular' => 'delete'
    ];

    public function callAction($method, $parameters)
    {
        if ($ability = $this->getAbility($method)) {
            $this->authorize($ability);
        }

        return parent::callAction($method, $parameters);
    }

    public function getAbility($method)
    {
        $routeName = explode('.', \Request::route()->getName());
        $action = Arr::get($this->getAbilities(), $method);

        return $action ? $action . '-' . $routeName[0] : null;
    }

    private function getAbilities()
    {
        return $this->abilities;
    }

    public function setAbilities($abilities)
    {
        $this->abilities = $abilities;
    }
}
