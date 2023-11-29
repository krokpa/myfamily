<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $FAM_ID
 * @property integer $CAR_ID
 * @property string $created_at
 * @property string $updated_at
 * @property Car $car
 * @property FamilyMember $familyMember
 */
class FamilyMemberCars extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'family_members_cars';

    /**
     * @var array
     */
    protected $fillable = ['FAM_ID', 'CAR_ID', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function car(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo('App\Models\Car', 'CAR_ID', 'CAR_ID');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function familyMember(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo('App\Models\FamilyMember', 'FAM_ID', 'FAM_ID');
    }
}
