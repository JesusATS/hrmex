<?php

// app/Models/Buzon.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Buzon extends Model
{
    use HasFactory;
    protected $fillable = ['buzon_id', 'token'];

    public function registrosPatronales()
    {
        return $this->hasMany(RegistroPatronal::class);
    }

    public function solicitudes()
    {
        return $this->hasMany(Solicitud::class);
    }
}

// app/Models/RegistroPatronal.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RegistroPatronal extends Model
{
    use HasFactory;
    protected $fillable = ['buzon_id', 'registro_patronal', 'usuario_imss'];

    public function buzon()
    {
        return $this->belongsTo(Buzon::class);
    }

    public function certificados()
    {
        return $this->hasMany(Certificado::class);
    }
}

// app/Models/Certificado.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Certificado extends Model
{
    use HasFactory;
    protected $fillable = [
        'registro_patronal_id',
        'tipo_certificado',
        'certificado_base64',
        'key_base64',
        'password',
        'fecha_expiracion',
    ];

    public function registroPatronal()
    {
        return $this->belongsTo(RegistroPatronal::class);
    }
}

// app/Models/Solicitud.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Solicitud extends Model
{
    use HasFactory;
    protected $fillable = [
        'buzon_id',
        'endpoint',
        'payload',
        'respuesta',
        'estado',
        'nlote',
        'batch_id',
        'analisis_ia',
    ];

    protected $casts = [
        'payload' => 'array',
        'respuesta' => 'array',
    ];

    public function buzon()
    {
        return $this->belongsTo(Buzon::class);
    }
}

