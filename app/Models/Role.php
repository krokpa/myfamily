<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $ROLE_ID
 * @property integer $ROLE_Libelle
 * @property string $created_at
 * @property string $updated_at
 * @property User[] $users
 */
class Role extends Model
{
    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'ROLE_ID';

    /**
     * @var array
     */
    protected $fillable = ['ROLE_Libelle', 'created_at', 'updated_at'];

    public static $adminRoleId = 1;
    public static $userRoleId = 2;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function users(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany('App\Models\User', 'ROLE_ID', 'ROLE_ID');
    }
}
