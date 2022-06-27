<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ClientsModel extends Model
{
    use HasFactory , SoftDeletes;

    protected $table = 'clients';
    
    /**
     * The primary key associated with the table.
     *
     * @var int
     */
    protected $primaryKey = 'id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<string, string>
     */
    protected $fillable = [
        'name',
        'phone',
        'company_name',
        'city',
        'neighborhood',
        'category',
        'latitude',
        'longitude',
        'send_to_engineer',
        'is_visited',
        'approved',
        'note'        
    ];


    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<string>
     */
    protected $hidden = [
                
    ];

}
