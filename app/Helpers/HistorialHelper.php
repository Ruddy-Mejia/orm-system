<?php

namespace App\Helpers;

use App\Models\HistorialMovimiento;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;

class HistorialHelper
{
    /**
     * Registrar un movimiento en el historial
     */
    public static function registrar($data)
    {
        return HistorialMovimiento::create([
            'user_id' => Auth::id() ?? null,
            'accion' => $data['accion'] ?? 'unknown',
            'tabla' => $data['tabla'] ?? 'unknown',
            'registro_id' => $data['registro_id'] ?? null,
            'descripcion' => $data['descripcion'] ?? null,
            'datos_anteriores' => $data['datos_anteriores'] ?? null,
            'datos_nuevos' => $data['datos_nuevos'] ?? null,
            'ip' => Request::ip(),
            'user_agent' => Request::userAgent(),
            'url' => Request::fullUrl(),
            'estado' => $data['estado'] ?? 'success',
            'mensaje_error' => $data['mensaje_error'] ?? null,
        ]);
    }

    /**
     * Registrar creación
     */
    public static function created($tabla, $registroId, $datos, $descripcion = null)
    {
        return self::registrar([
            'accion' => 'create',
            'tabla' => $tabla,
            'registro_id' => $registroId,
            'descripcion' => $descripcion ?? "Se creó un registro en {$tabla}",
            'datos_nuevos' => $datos,
        ]);
    }

    /**
     * Registrar actualización
     */
    public static function updated($tabla, $registroId, $datosAnteriores, $datosNuevos, $descripcion = null)
    {
        return self::registrar([
            'accion' => 'update',
            'tabla' => $tabla,
            'registro_id' => $registroId,
            'descripcion' => $descripcion ?? "Se actualizó un registro en {$tabla}",
            'datos_anteriores' => $datosAnteriores,
            'datos_nuevos' => $datosNuevos,
        ]);
    }

    /**
     * Registrar eliminación
     */
    public static function deleted($tabla, $registroId, $datos, $descripcion = null)
    {
        return self::registrar([
            'accion' => 'delete',
            'tabla' => $tabla,
            'registro_id' => $registroId,
            'descripcion' => $descripcion ?? "Se eliminó un registro en {$tabla}",
            'datos_anteriores' => $datos,
        ]);
    }

    /**
     * Registrar restauración
     */
    public static function restored($tabla, $registroId, $datos, $descripcion = null)
    {
        return self::registrar([
            'accion' => 'restore',
            'tabla' => $tabla,
            'registro_id' => $registroId,
            'descripcion' => $descripcion ?? "Se restauró un registro en {$tabla}",
            'datos_nuevos' => $datos,
        ]);
    }

    /**
     * Registrar error
     */
    public static function error($mensaje, $tabla = null, $registroId = null, $datos = null)
    {
        return self::registrar([
            'accion' => 'error',
            'tabla' => $tabla ?? 'system',
            'registro_id' => $registroId,
            'descripcion' => $mensaje,
            'datos_anteriores' => $datos,
            'estado' => 'error',
            'mensaje_error' => $mensaje,
        ]);
    }

    /**
     * Registrar inicio de sesión
     */
    public static function login($userId)
    {
        return self::registrar([
            'user_id' => $userId,
            'accion' => 'login',
            'tabla' => 'users',
            'registro_id' => $userId,
            'descripcion' => 'Inicio de sesión',
            'estado' => 'success',
        ]);
    }

    /**
     * Registrar cierre de sesión
     */
    public static function logout($userId)
    {
        return self::registrar([
            'user_id' => $userId,
            'accion' => 'logout',
            'tabla' => 'users',
            'registro_id' => $userId,
            'descripcion' => 'Cierre de sesión',
            'estado' => 'success',
        ]);
    }
}