<?php namespace App;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;

class XtraAnggota extends Model
{
    protected $table = 'xtra_userinfo';

    protected $primaryKey = 'anggota_id';

    protected $fillable = ['anggota_id', 'basedept_id', 'email', 'nama', 'nokp', 'jawatan', 'dept_id', 'nohp'];

    public function __construct()
    {
        $this->setDateFormat(config('pcrs.modelDateFormat'));
    }

    //----Relationship-----
    public function user()
    {
        return $this->hasOne(User::class, 'anggota_id');
    }

    public function anggota()
    {
        return $this->belongsTo(Anggota::class, 'anggota_id');
    }

    public function baseDepartment()
    {
        return $this->belongsTo(Department::class, 'basedept_id');
    }

    public function department()
    {
        return $this->belongsTo(Department::class, 'dept_id');
    }

    public function flowBaseDepartment()
    {
        return $this->hasOne(FlowBahagian::class, 'dept_id', 'basedept_id');
    }
    //----End Relationship-----
}
