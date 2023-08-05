<?php namespace App\Models;         // v1.0 by Ferry, Change to App\Models from App

use Zizaco\Entrust\EntrustRole;

class Role extends EntrustRole
{
     /** v1.0 by Ferry, Alhamdulillah knowledge baru extend trait EntrustRole utk cek permissionnya
     * Checks if the role has a permission by its name.
     *
     * @param string|array $name       Permission name or array of permission names.
     * @param bool            $requireAll  All permissions in the array are required.
     *
     * @return bool
     */
    public function hasPermission($name, $requireAll = false)
    {
        if (is_array($name)) {
            foreach ($name as $permissionName) {
                $hasPermission = $this->hasPermission($permissionName);

                if ($hasPermission && !$requireAll) {
                    return true;
                } elseif (!$hasPermission && $requireAll) {
                    return false;
                }
            }

            return $requireAll;

        } else {
            foreach ($this->perms as $permission) {
                if ($permission->name == $name) {
                    return true;
                }
            }
        }

        return false;
    }
}