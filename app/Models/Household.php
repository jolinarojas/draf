<?php
 
namespace App\Models;
 
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
 
class Household extends Model
{
    use HasFactory;
 
    protected $fillable = [ 'fhname', 
                            'serial_no', 
                            'address',
                            'NOFHH',
                            'NOLHH',
                            'insurance',
                            'TFI',
                            'wall_materials',
                            'roof_materials',
                            'house_and_lot',
                            'disaster_prone',
                            'date_interviewed'

                        ];

    public function familyMembers()
    {
        return $this->hasMany(FamilyMember::class);
    }

}