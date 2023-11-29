<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $CAR_ID
 * @property string $CAR_Color
 * @property string $CAR_Immat
 * @property string $CAR_Marque
 * @property string $CAR_Modele
 * @property integer $CAR_Year
 * @property string $CAR_TypeMoteur
 * @property integer $USR_ID
 * @property string $created_at
 * @property string $updated_at
 * @property User $user
 * @property FamilyMembersCar[] $familyMembersCars
 */
class Car extends Model
{
    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'CAR_ID';

    /**
     * @var array
     */
    protected $fillable = ['CAR_Color', 'CAR_Immat', 'CAR_Marque', 'CAR_Modele', 'CAR_Year', 'CAR_TypeMoteur', 'USR_ID', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo('App\Models\User', 'USR_ID', 'USR_ID');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function familyMembersCars(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany('App\Models\FamilyMembersCar', 'CAR_ID', 'CAR_ID');
    }
}
