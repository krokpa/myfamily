<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $FAM_ID
 * @property string $FAM_NOM
 * @property string $FAM_PRENOM
 * @property string $FAM_CONTACT
 * @property integer $USR_ID
 * @property string $created_at
 * @property string $updated_at
 * @property string $FAM_LIEN
 * @property FamilyMembersCar[] $familyMembersCars
 * @property User $user
 */
class FamilyMember extends Model
{
    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'FAM_ID';

    /**
     * @var array
     */
    protected $fillable = ['FAM_NOM', 'FAM_PRENOM', 'FAM_CONTACT', 'USR_ID', 'created_at', 'updated_at', 'FAM_LIEN'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function familyMembersCars(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany('App\Models\FamilyMembersCar', 'FAM_ID', 'FAM_ID');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo('App\Models\User', 'USR_ID', 'USR_ID');
    }
}
