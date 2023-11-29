<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $USR_ID
 * @property string $USR_Nom
 * @property string $USR_Prenom
 * @property string $USR_Email
 * @property string $USR_Password
 * @property integer $ROLE_ID
 * @property string $created_at
 * @property string $updated_at
 * @property string $USR_Photo
 * @property Car[] $cars
 * @property Role $role
 * @property FamilyMember[] $familyMembers
 */
class User extends Model
{
    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'USR_ID';

    /**
     * @var array
     */
    protected $fillable = ['USR_Nom', 'USR_Prenom', 'USR_Email', 'USR_Password', 'ROLE_ID', 'created_at', 'updated_at', 'USR_Photo'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function cars(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany('App\Models\Car', 'USR_ID', 'USR_ID');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function role(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo('App\Models\Role', 'ROLE_ID', 'ROLE_ID');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function familyMembers(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany('App\Models\FamilyMember', 'USR_ID', 'USR_ID');
    }
}
