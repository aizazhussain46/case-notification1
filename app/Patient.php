<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    protected $fillable = ['user_id', 'p_name', 'p_cnic', 'p_mobile_no', 'p_address', 'status_id'];
}
