<?php

namespace App\Models\Migration\Nc3;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class Nc3BlockRolePermission extends Model
{
    /**
     * 使用するDB Connection
     */
    protected $connection = 'nc3';

    /**
     * テーブル名の指定
     */
    protected $table = 'block_role_permissions';

    /**
     * block_keyでブロックの権限 取得
     */
    public static function getBlockRolePermissionsByBlockKeys($block_keys): Collection
    {
        return Nc3BlockRolePermission::select('block_role_permissions.*', 'roles_rooms.role_key')
            ->join('roles_rooms', function ($join) {
                $join->on('roles_rooms.id', '=', 'block_role_permissions.roles_room_id');
            })
            ->whereIn('block_role_permissions.block_key', $block_keys)
            ->get();
    }

    /**
     * block_role_permissionsのvalueをblock_key,permission,role_keyで取得
     */
    public static function getNc3BlockRolePermissionValue(Collection $block_role_permissions, string $block_key, string $permission, string $role_key, ?string $default = '0'): string
    {
        $block_role_permission = $block_role_permissions->where('block_key', $block_key)
            ->where('permission', $permission)
            ->firstWhere('role_key', $role_key);
        $block_role_permission = $block_role_permission ?? new Nc3BlockRolePermission();
        return $block_role_permission->value ?? $default;
    }
}
