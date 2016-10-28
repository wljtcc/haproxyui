<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HAProxyUI extends Model
{
    //
    protected $table = 'haproxyui';
    protected $guarded = ['hp_id'];
    protected $fillable = array(
                                'hp_frontend',
                                'hp_frontend_id',
                                'hp_backend',
                                'hp_backend_id',
                                'hp_be_servers_id',
                                'hp_be_servers'
                            );
    public $timestamps = false;
}
