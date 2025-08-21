<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;

class IdseCloudController extends Controller
{
    // URL base para el API de IDSE Cloud.
    private $baseUrl = 'https://idsemex.com/service/api';

    /**
     * Función genérica para interactuar con el API de IDSE Cloud.
     * Centraliza la lógica de validación, construcción del payload y manejo de respuestas.
     */
    private function callIdseApi(string $endpoint, Request $request, array $validationRules)
    {
        try {
            // 1. Validar los datos de entrada.
            $validatedData = $request->validate($validationRules);

            // 2. Construir el payload base.
            $payload = [
                'buzon' => $validatedData['buzon'],
                'token' => $validatedData['token'],
            ];

            // 3. Agregar los datos específicos del endpoint al payload.
            // Se omiten 'buzon' y 'token' que ya fueron agregados.
            foreach ($validatedData as $key => $value) {
                if ($key !== 'buzon' && $key !== 'token') {
                    // Solo agregar al payload si el valor no es nulo (para campos opcionales).
                    if ($value !== null) {
                        $payload[$key] = $value;
                    }
                }
            }

            // Registrar la solicitud para depuración.
            Log::info("Enviando solicitud a IDSE Cloud: {$endpoint}", ['payload' => $payload]);

            // 4. Realizar la llamada POST al API externa.
            $response = Http::post("{$this->baseUrl}/{$endpoint}", $payload);

            // 5. Manejar la respuesta.
            if ($response->successful()) {
                Log::info("Respuesta exitosa de IDSE Cloud: {$endpoint}", ['response' => $response->json()]);
                return $response->json();
            } else {
                Log::error("Error de IDSE Cloud: {$endpoint}", [
                    'status' => $response->status(),
                    'body' => $response->body()
                ]);
                return response()->json([
                    'estado' => 0,
                    'mensaje' => "Error en la comunicación con IDSE Cloud. Código: " . $response->status()
                ], $response->status());
            }
        } catch (ValidationException $e) {
            return response()->json(['estado' => 0, 'mensaje' => 'Datos inválidos.', 'errores' => $e->errors()], 422);
        } catch (\Exception $e) {
            Log::critical("Excepción crítica en {$endpoint}:", ['mensaje' => $e->getMessage()]);
            return response()->json(['estado' => 0, 'mensaje' => 'Error interno del servidor.'], 500);
        }
    }

    // a. Carga de Certificados
    public function cargaCertificado(Request $request)
    {
        return $this->callIdseApi('cargaCertificado', $request, [
            'buzon'       => 'required|string',
            'token'       => 'required|string',
            'registro'    => 'required|string|size:11',
            'certificado' => 'required|string', // Base64
            'key'         => 'nullable|string', // Base64
            'usuario'     => 'required|string',
            'password'    => 'required|string',
        ]);
    }

    // b. Consulta Historial
    public function consultaHistorial(Request $request)
    {
        return $this->callIdseApi('historial', $request, [
            'buzon'    => 'required|string',
            'token'    => 'required|string',
            'registro' => 'required|string|size:11',
        ]);
    }

    // c. Consulta Acuse
    public function consultaAcuse(Request $request)
    {
        return $this->callIdseApi('acuse', $request, [
            'buzon' => 'required|string',
            'token' => 'required|string',
            'nlote' => 'required|string',
        ]);
    }

    // f. Consulta Emisiones
    public function consultaEmisiones(Request $request)
    {
        return $this->callIdseApi('emisiones', $request, [
            'buzon'    => 'required|string',
            'token'    => 'required|string',
            'registro' => 'required|string|size:11',
            'periodo'  => 'nullable|string', // Ej: 2023_1
        ]);
    }

    // g/h. Envío de Movimientos
    public function envioMovimientos(Request $request)
    {
        $validated = $request->validate([
            'type' => 'required|in:prueba,real' // Campo extra para saber a dónde apuntar
        ]);
        
        $endpoint = $validated['type'] === 'prueba' ? 'pruebasenvios' : 'envios';
        
        return $this->callIdseApi($endpoint, $request, [
            'buzon'   => 'required|string',
            'token'   => 'required|string',
            'dispmag' => 'required|string',
        ]);
    }

    // i. Consulta Programados
    public function consultaProgramados(Request $request)
    {
        return $this->callIdseApi('programados', $request, [
            'buzon'    => 'required|string',
            'token'    => 'required|string',
            'registro' => 'nullable|string|size:11',
            'batchId'  => 'nullable|string',
        ]);
    }

    // j. Eliminar Programado (batch)
    public function eliminarProgramado(Request $request)
    {
        return $this->callIdseApi('eliminarBatch', $request, [
            'buzon'   => 'required|string',
            'token'   => 'required|string',
            'batchid' => 'required|string',
        ]);
    }

    // k. Check Health
    public function checkHealth(Request $request)
    {
        return $this->callIdseApi('checkHealth', $request, [
            'buzon' => 'required|string',
            'token' => 'required|string',
        ]);
    }

    // l. Trabajadores Activos
    public function trabajadoresActivos(Request $request)
    {
        return $this->callIdseApi('trabajadoresActivos', $request, [
            'buzon'    => 'required|string',
            'token'    => 'required|string',
            'registro' => 'required|string|size:11',
        ]);
    }
}
