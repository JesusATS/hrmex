<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Control - HRMEX</title>
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Google Fonts: Inter -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
        .tab-button { transition: all 0.3s; }
        .tab-button.active, .tab-button:focus { background: #e0e7ff; color: #1e40af; font-weight: 600; }
        .tab-content { display: none; }
        .tab-content.active { display: block; }
        input[type="file"]::file-selector-button {
            background-color: #3b82f6; color: white; border: 0; padding: 0.5rem 1rem;
            border-radius: 0.375rem; cursor: pointer; transition: background-color 0.2s;
        }
        input[type="file"]::file-selector-button:hover { background-color: #2563eb; }
        .loader {
            border: 4px solid #f3f3f3; border-radius: 50%; border-top: 4px solid #3498db;
            width: 24px; height: 24px; animation: spin 1s linear infinite;
        }
        @keyframes spin { 0% { transform: rotate(0deg); } 100% { transform: rotate(360deg); } }
        #sidebar {
            transition: width 0.3s ease;
        }
        #sidebar.collapsed {
            width: 5rem; /* 80px */
        }
        #sidebar.collapsed .sidebar-text {
            display: none;
        }
        #sidebar.collapsed .tab-button {
            justify-content: center;
        }
        #sidebar.collapsed .mt-auto {
            display: none;
        }
    </style>
</head>
<body class="bg-gray-100 min-h-screen">

<div class="flex min-h-screen">
    <!-- Sidebar -->
    <aside id="sidebar" class="w-64 bg-white shadow-lg flex flex-col py-8 px-6">
        <div class="mb-10 text-center">
            <h1 class="text-2xl font-bold text-blue-700 sidebar-text">HRMEX</h1>
            <p class="text-xs text-gray-400 mt-1 sidebar-text">Panel de Control</p>
        </div>
        <nav class="flex flex-col gap-2">
            <button class="tab-button flex items-center gap-3 px-4 py-2 rounded-md active" data-tab="cargaCertificados">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12" /></svg>
                <span class="sidebar-text">Carga Certificados</span>
            </button>
            <button class="tab-button flex items-center gap-3 px-4 py-2 rounded-md" data-tab="consultas">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M8 16l2.879-2.879a3 3 0 014.242 0L18 16m-7-3.5l-1.5-1.5a3 3 0 00-4.242 0L3 12.5" /></svg>
                <span class="sidebar-text">Consultas</span>
            </button>
            <button class="tab-button flex items-center gap-3 px-4 py-2 rounded-md" data-tab="envios">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8" /></svg>
                <span class="sidebar-text">Envío Movimientos</span>
            </button>
            <button class="tab-button flex items-center gap-3 px-4 py-2 rounded-md" data-tab="programados">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>
                <span class="sidebar-text">Programados</span>
            </button>
            <button class="tab-button flex items-center gap-3 px-4 py-2 rounded-md" data-tab="utilidades">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" /><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /></svg>
                <span class="sidebar-text">Utilidades</span>
            </button>
            <button class="tab-button flex items-center gap-3 px-4 py-2 rounded-md" data-tab="gemini">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z" /></svg>
                <span class="sidebar-text">Asistente Gemini</span>
            </button>
        </nav>
        <div class="mt-auto pt-10 text-center">
            <div class="text-xs text-gray-400 sidebar-text">© <?= date('Y') ?> HRMEX</div>
        </div>
    </aside>

    <!-- Main Content -->
    <div class="flex-1 flex flex-col">
        <!-- Topbar -->
        <header class="flex flex-col md:flex-row md:items-center md:justify-between px-8 py-4 bg-white shadow gap-4">
            <div class="flex flex-col md:flex-row md:items-center gap-4 w-full">
                <button id="sidebar-toggle" class="p-2 rounded-md hover:bg-gray-200">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>
                <span class="text-lg font-semibold text-gray-700 mr-6">Panel de Control</span>
                <!-- Credenciales Comunes moved here -->
                <div class="flex flex-col md:flex-row gap-4 w-full">
                    <div>
                        <label for="buzon" class="block text-xs font-medium text-gray-700">Buzón Asignado</label>
                        <input type="text" id="buzon" value="009876" class="mt-1 w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" style="min-width:180px;">
                    </div>
                    <div>
                        <label for="token" class="block text-xs font-medium text-gray-700">Token Asignado</label>
                        <input type="text" id="token" value="95194dcaab9714b9e3ac0ea1b3be8bf00d480c978988634dafce61872359cdde" class="mt-1 w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" style="min-width:320px;">
                    </div>
                </div>
            </div>
            <form id="formCheckHealth" class="flex items-center gap-2 mt-4 md:mt-0">
                <button type="submit" class="btn-primary">Verificar Estado</button>
            </form>
        </header>

        <!-- Content Area -->
        <main class="flex-1 overflow-y-auto p-8">
            <div class="max-w-4xl mx-auto bg-white p-8 rounded-xl shadow-lg">
                <!-- Credenciales Comunes -->
<!--                 <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-8 border-b pb-6">
                    <div>
                        <label for="buzon" class="block text-sm font-medium text-gray-700">Buzón Asignado</label>
                        <input type="text" id="buzon" value="009876" class="mt-1 w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                    </div>
                    <div>
                        <label for="token" class="block text-sm font-medium text-gray-700">Token Asignado</label>
                        <input type="text" id="token" value="95194dcaab9714b9e3ac0ea1b3be8bf00d480c978988634dafce61872359cdde" class="mt-1 w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                    </div>
                </div> -->

                <!-- Tab Contents -->
                <div id="tab-container">
                    <!-- Carga Certificados -->
                    <div id="cargaCertificados" class="tab-content active">
                        <h2 class="text-xl font-semibold mb-4 text-gray-700">Carga de Certificados</h2>
                        <form id="formCargaCertificado" class="space-y-4">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label for="cc_registro" class="block text-sm font-medium text-gray-700">Registro Patronal</label>
                                    <input type="text" id="cc_registro" class="mt-1 w-full input-style" placeholder="11 dígitos" required>
                                </div>
                                <div>
                                    <label for="cc_tipoCertificado" class="block text-sm font-medium text-gray-700">Tipo</label>
                                    <select id="cc_tipoCertificado" class="mt-1 w-full input-style">
                                        <option value="pfx_p12">Certificado IMSS (.pfx/.p12)</option>
                                        <option value="fiel">FIEL (.cer + .key)</option>
                                    </select>
                                </div>
                            </div>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label for="cc_archivoCertificado" class="block text-sm font-medium text-gray-700">Archivo Certificado</label>
                                    <input type="file" id="cc_archivoCertificado" class="mt-1 w-full" required>
                                </div>
                                <div id="cc_keyFileContainer" class="hidden">
                                    <label for="cc_archivoKey" class="block text-sm font-medium text-gray-700">Archivo Llave (.key)</label>
                                    <input type="file" id="cc_archivoKey" class="mt-1 w-full">
                                </div>
                            </div>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label for="cc_usuarioIMSS" class="block text-sm font-medium text-gray-700">Usuario IMSS</label>
                                    <input type="text" id="cc_usuarioIMSS" class="mt-1 w-full input-style" required>
                                </div>
                                <div>
                                    <label for="cc_password" class="block text-sm font-medium text-gray-700">Contraseña Certificado</label>
                                    <input type="password" id="cc_password" class="mt-1 w-full input-style" required>
                                </div>
                            </div>
                            <button type="submit" class="btn-primary">Enviar Carga</button>
                        </form>
                    </div>
                    
                    <!-- Consultas -->
                    <div id="consultas" class="tab-content">
                        <div class="space-y-6">
                            <div>
                                <h2 class="text-xl font-semibold mb-4 text-gray-700">Consulta Historial</h2>
                                <form id="formConsultaHistorial" class="flex items-end gap-4">
                                    <div class="flex-grow">
                                        <label for="ch_registro" class="block text-sm font-medium text-gray-700">Registro Patronal</label>
                                        <input type="text" id="ch_registro" class="mt-1 w-full input-style" placeholder="11 dígitos" required>
                                    </div>
                                    <button type="submit" class="btn-primary">Consultar Historial</button>
                                </form>
                            </div>
                            <hr/>
                            <div>
                                <h2 class="text-xl font-semibold mb-4 text-gray-700">Consulta Acuse</h2>
                                <form id="formConsultaAcuse" class="flex items-end gap-4">
                                    <div class="flex-grow">
                                        <label for="ca_nlote" class="block text-sm font-medium text-gray-700">Número de Lote</label>
                                        <input type="text" id="ca_nlote" class="mt-1 w-full input-style" required>
                                    </div>
                                    <button type="submit" class="btn-primary">Consultar Acuse</button>
                                </form>
                            </div>
                            <hr/>
                            <div>
                                <h2 class="text-xl font-semibold mb-4 text-gray-700">Consulta Emisiones</h2>
                                <form id="formConsultaEmisiones" class="flex items-end gap-4 flex-wrap">
                                    <div class="flex-grow">
                                        <label for="ce_registro" class="block text-sm font-medium text-gray-700">Registro Patronal</label>
                                        <input type="text" id="ce_registro" class="mt-1 w-full input-style" placeholder="11 dígitos" required>
                                    </div>
                                    <div class="flex-grow">
                                        <label for="ce_periodo" class="block text-sm font-medium text-gray-700">Periodo (Opcional)</label>
                                        <input type="text" id="ce_periodo" class="mt-1 w-full input-style" placeholder="Ej: 2023_1">
                                    </div>
                                    <button type="submit" class="btn-primary">Consultar Emisiones</button>
                                </form>
                            </div>
                        </div>
                    </div>

                    <!-- Envío de Movimientos -->
                    <div id="envios" class="tab-content">
                        <h2 class="text-xl font-semibold mb-4 text-gray-700">Envío de Movimientos</h2>
                        <form id="formEnvioMovimientos" class="space-y-4">
                            <div>
                                <label for="em_dispmag" class="block text-sm font-medium text-gray-700">Contenido DISPMAG (texto plano)</label>
                                <textarea id="em_dispmag" rows="8" class="mt-1 w-full input-style" placeholder="Pega aquí el contenido del archivo DISPMAG..."></textarea>
                            </div>
                            <div class="flex items-center gap-4">
                                <button type="submit" data-type="prueba" class="btn-secondary">Enviar como Prueba</button>
                                <button type="submit" data-type="real" class="btn-primary">Enviar Real</button>
                            </div>
                        </form>
                    </div>
                    
                    <!-- Programados -->
                    <div id="programados" class="tab-content">
                        <div class="space-y-6">
                            <div>
                                <h2 class="text-xl font-semibold mb-4 text-gray-700">Consulta Programados</h2>
                                <form id="formConsultaProgramados" class="flex items-end gap-4 flex-wrap">
                                    <div class="flex-grow">
                                        <label for="cp_registro" class="block text-sm font-medium text-gray-700">Registro Patronal</label>
                                        <input type="text" id="cp_registro" class="mt-1 w-full input-style" placeholder="11 dígitos">
                                    </div>
                                    <div class="flex-grow">
                                        <label for="cp_batchId" class="block text-sm font-medium text-gray-700">Batch ID (Opcional)</label>
                                        <input type="text" id="cp_batchId" class="mt-1 w-full input-style">
                                    </div>
                                    <button type="submit" class="btn-primary">Consultar Programados</button>
                                </form>
                            </div>
                            <hr/>
                            <div>
                                <h2 class="text-xl font-semibold mb-4 text-gray-700">Eliminar Programados</h2>
                                <form id="formEliminarProgramados" class="flex items-end gap-4">
                                    <div class="flex-grow">
                                        <label for="ep_batchid" class="block text-sm font-medium text-gray-700">Batch ID a Eliminar</label>
                                        <input type="text" id="ep_batchid" class="mt-1 w-full input-style" required>
                                    </div>
                                    <button type="submit" class="btn-danger">Eliminar Batch</button>
                                </form>
                            </div>
                        </div>
                    </div>

                    <!-- Utilidades -->
                    <div id="utilidades" class="tab-content">
                        <div class="space-y-6">
                            <div>
                                <h2 class="text-xl font-semibold mb-4 text-gray-700">Reporte de Trabajadores Activos</h2>
                                <form id="formTrabajadoresActivos" class="flex items-end gap-4">
                                    <div class="flex-grow">
                                        <label for="ta_registro" class="block text-sm font-medium text-gray-700">Registro Patronal</label>
                                        <input type="text" id="ta_registro" class="mt-1 w-full input-style" placeholder="11 dígitos" required>
                                    </div>
                                    <button type="submit" class="btn-primary">Consultar Activos</button>
                                </form>
                            </div>
                        </div>
                    </div>

                    <!-- Asistente Gemini -->
                    <div id="gemini" class="tab-content">
                        <h2 class="text-xl font-semibold mb-4 text-gray-700">Asistente Gemini</h2>
                        <div id="chat-container" class="border rounded-md p-4 overflow-y-auto mb-4 bg-gray-50" style="height: 50vh;">
                            <div class="text-left mb-2">
                                <p class="bg-gray-200 text-gray-800 rounded-lg py-2 px-4 inline-block">Hola, soy tu asistente Gemini. ¿En qué puedo ayudarte hoy?</p>
                            </div>
                        </div>
                        <form id="formGeminiChat" class="flex items-center gap-4">
                            <textarea id="gemini_prompt" rows="2" class="flex-grow mt-1 w-full input-style" placeholder="Escribe tu consulta aquí..."></textarea>
                            <button type="submit" class="btn-primary">Enviar</button>
                        </form>
                    </div>
                </div>
                <!-- End Tab Container -->
                <div id="responseContainer" class="mt-8 p-4 bg-gray-800 text-white rounded-md hidden">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <h3 class="text-lg font-semibold mb-2 text-yellow-400">Request Enviado al Backend</h3>
                            <pre id="requestOutput" class="text-sm whitespace-pre-wrap break-all"></pre>
                        </div>
                        <div>
                            <h3 class="text-lg font-semibold mb-2 text-green-400">Response Recibido del Backend</h3>
                            <pre id="responseOutput" class="text-sm whitespace-pre-wrap break-all"></pre>
                            <div id="downloadContainer" class="mt-4"></div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', () => {
    // --- Sidebar Toggle ---
    const sidebar = document.getElementById('sidebar');
    const sidebarToggle = document.getElementById('sidebar-toggle');
    sidebarToggle.addEventListener('click', () => {
        sidebar.classList.toggle('collapsed');
    });

    // --- Lógica de Pestañas ---
    const tabs = document.querySelectorAll('.tab-button');
    const tabContents = document.querySelectorAll('.tab-content');
    tabs.forEach(tab => {
        tab.addEventListener('click', () => {
            tabs.forEach(item => item.classList.remove('active'));
            tab.classList.add('active');
            const target = document.getElementById(tab.dataset.tab);
            tabContents.forEach(content => content.classList.remove('active'));
            target.classList.add('active');
        });
    });

    // --- API Response ---
    const buzonInput = document.getElementById('buzon');
    const tokenInput = document.getElementById('token');
    const responseContainer = document.getElementById('responseContainer');
    const requestOutput = document.getElementById('requestOutput');
    const responseOutput = document.getElementById('responseOutput');
    const downloadContainer = document.getElementById('downloadContainer');

    const backendUrl = 'http://127.0.0.1:8000/api/idse';

    const readFileAsBase64 = (file) => {
        return new Promise((resolve, reject) => {
            if (!file) {
                resolve(null);
                return;
            }
            const reader = new FileReader();
            reader.onload = () => resolve(reader.result.split(',')[1]);
            reader.onerror = error => reject(error);
            reader.readAsDataURL(file);
        });
    };

    async function callBackend(endpoint, payload, button, showAlert = false) {
        const originalButtonText = button.innerHTML;
        button.innerHTML = '<div class="loader mx-auto"></div>';
        button.disabled = true;

        if (!showAlert) {
            responseContainer.classList.remove('hidden');
            requestOutput.textContent = JSON.stringify(payload, null, 2);
            responseOutput.textContent = 'Enviando...';
            responseOutput.style.color = 'white';
            downloadContainer.innerHTML = '';
        }

        try {
            const response = await fetch(`${backendUrl}/${endpoint}`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json'
                },
                body: JSON.stringify(payload)
            });

            const result = await response.json();

            if (showAlert) {
                // Show alert with message or full response
                alert(result.message ? result.message : JSON.stringify(result, null, 2));
            } else {
                responseOutput.textContent = JSON.stringify(result, null, 2);

                if (!response.ok) {
                    responseOutput.style.color = '#f87171'; // Red
                } else {
                    responseOutput.style.color = '#30a65bff'; // Green
                    handleDownload(result);
                }
            }

        } catch (error) {
            if (showAlert) {
                alert(`Error de conexión: ${error.message}\n\nAsegúrate de que el servidor de Laravel esté corriendo en ${backendUrl} y que no haya problemas de CORS.`);
            } else {
                responseOutput.textContent = `Error de conexión: ${error.message}\n\nAsegúrate de que el servidor de Laravel esté corriendo en ${backendUrl} y que no haya problemas de CORS.`;
                responseOutput.style.color = '#f87171';
            }
        } finally {
            button.innerHTML = originalButtonText;
            button.disabled = false;
        }
    }

    function handleDownload(result) {
        const data = result.data || {};
        const fileName = data.nombreAcuse || data.nombrePdf;
        const base64String = data.acuse || data.pdf;

        if (fileName && base64String) {
            const btn = document.createElement('a');
            btn.textContent = `Descargar ${fileName}`;
            btn.className = 'btn-secondary mt-2 inline-block';
            const mimeType = fileName.endsWith('.zip') ? 'application/zip' : 'application/pdf';
            btn.href = `data:${mimeType};base64,${base64String}`;
            btn.download = fileName;
            downloadContainer.appendChild(btn);
        }
    }

    // --- Lógica para cada formulario ---

    // a. Carga de Certificados
    const ccTipoCertificado = document.getElementById('cc_tipoCertificado');
    const ccKeyFileContainer = document.getElementById('cc_keyFileContainer');
    ccTipoCertificado.addEventListener('change', (e) => {
        ccKeyFileContainer.classList.toggle('hidden', e.target.value !== 'fiel');
    });

    document.getElementById('formCargaCertificado').addEventListener('submit', async (e) => {
        e.preventDefault();
        const certFile = document.getElementById('cc_archivoCertificado').files[0];
        const keyFile = document.getElementById('cc_archivoKey').files[0];
        
        let payload = {
            buzon: buzonInput.value,
            token: tokenInput.value,
            registro: document.getElementById('cc_registro').value,
            certificado: await readFileAsBase64(certFile),
            usuario: document.getElementById('cc_usuarioIMSS').value,
            password: document.getElementById('cc_password').value,
            tipoCertificado: ccTipoCertificado.value,
            key: null
        };
        if (ccTipoCertificado.value === 'fiel') {
            payload.key = await readFileAsBase64(keyFile);
        }
        
        callBackend('carga-certificado', payload, e.submitter);
    });

    // b. Consulta Historial
    document.getElementById('formConsultaHistorial').addEventListener('submit', (e) => {
        e.preventDefault();
        const payload = {
            buzon: buzonInput.value,
            token: tokenInput.value,
            registro: document.getElementById('ch_registro').value,
        };
        callBackend('consulta-historial', payload, e.submitter);
    });

    // c. Consulta Acuse
    document.getElementById('formConsultaAcuse').addEventListener('submit', (e) => {
        e.preventDefault();
        const payload = {
            buzon: buzonInput.value,
            token: tokenInput.value,
            nlote: document.getElementById('ca_nlote').value,
        };
        callBackend('consulta-acuse', payload, e.submitter);
    });

    // f. Consulta Emisiones
    document.getElementById('formConsultaEmisiones').addEventListener('submit', (e) => {
        e.preventDefault();
        let payload = {
            buzon: buzonInput.value,
            token: tokenInput.value,
            registro: document.getElementById('ce_registro').value,
        };
        const periodo = document.getElementById('ce_periodo').value;
        if (periodo) payload.periodo = periodo;
        callBackend('consulta-emisiones', payload, e.submitter);
    });

    // g/h. Envío de Movimientos
    document.getElementById('formEnvioMovimientos').addEventListener('submit', (e) => {
        e.preventDefault();
        const payload = {
            buzon: buzonInput.value,
            token: tokenInput.value,
            dispmag: document.getElementById('em_dispmag').value,
            type: e.submitter.dataset.type // 'prueba' o 'real'
        };
        callBackend('envio-movimientos', payload, e.submitter);
    });

    // i. Consulta Programados
    document.getElementById('formConsultaProgramados').addEventListener('submit', (e) => {
        e.preventDefault();
        let payload = {
            buzon: buzonInput.value,
            token: tokenInput.value,
        };
        const registro = document.getElementById('cp_registro').value;
        const batchId = document.getElementById('cp_batchId').value;
        if (registro) payload.registro = registro;
        if (batchId) payload.batchId = batchId;
        callBackend('consulta-programados', payload, e.submitter);
    });

    // j. Eliminar Programados
    document.getElementById('formEliminarProgramados').addEventListener('submit', (e) => {
        e.preventDefault();
        const payload = {
            buzon: buzonInput.value,
            token: tokenInput.value,
            batchid: document.getElementById('ep_batchid').value,
        };
        callBackend('eliminar-programado', payload, e.submitter);
    });

    // k. Check Health (top right, always visible)
    document.getElementById('formCheckHealth').addEventListener('submit', async (e) => {
        e.preventDefault();
        const button = e.submitter;
        const originalClass = button.className;
        const originalText = button.textContent;
        button.disabled = true;
        button.textContent = 'Verificando...';

        const payload = {
            buzon: buzonInput.value,
            token: tokenInput.value,
        };

        try {
            const response = await fetch(`${backendUrl}/check-health`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json'
                },
                body: JSON.stringify(payload)
            });
            const result = await response.json();

            if (response.ok) {
                button.className = originalClass + ' bg-green-600 hover:bg-green-700 focus:ring-green-500';
                button.textContent = '¡Servicio OK!';
                setTimeout(() => {
                    button.className = originalClass;
                    button.textContent = originalText;
                    button.disabled = false;
                }, 2000);
            } else {
                button.className = originalClass + ' bg-red-600 hover:bg-red-700 focus:ring-red-500';
                button.textContent = 'Error en Servicio';
                setTimeout(() => {
                    button.className = originalClass;
                    button.textContent = originalText;
                    button.disabled = false;
                }, 2500);
            }
        } catch (error) {
            button.className = originalClass + ' bg-red-600 hover:bg-red-700 focus:ring-red-500';
            button.textContent = 'Error de conexión';
            setTimeout(() => {
                button.className = originalClass;
                button.textContent = originalText;
                button.disabled = false;
            }, 2500);
        }
    });

    // l. Trabajadores Activos
    document.getElementById('formTrabajadoresActivos').addEventListener('submit', (e) => {
        e.preventDefault();
        const payload = {
            buzon: buzonInput.value,
            token: tokenInput.value,
            registro: document.getElementById('ta_registro').value,
        };
        callBackend('trabajadores-activos', payload, e.submitter);
    });

    // m. Asistente Gemini
    const chatContainer = document.getElementById('chat-container');
    const geminiPromptInput = document.getElementById('gemini_prompt');
    const formGeminiChat = document.getElementById('formGeminiChat');

    formGeminiChat.addEventListener('submit', async (e) => {
        e.preventDefault();
        const prompt = geminiPromptInput.value.trim();
        if (!prompt) return;

        const submitButton = e.submitter;
        const originalButtonText = submitButton.innerHTML;
        submitButton.innerHTML = '<div class="loader mx-auto"></div>';
        submitButton.disabled = true;

        // Display user message
        const userMessageDiv = document.createElement('div');
        userMessageDiv.className = 'text-right mb-2';
        userMessageDiv.innerHTML = `<p class="bg-blue-500 text-white rounded-lg py-2 px-4 inline-block">${prompt}</p>`;
        chatContainer.appendChild(userMessageDiv);
        geminiPromptInput.value = '';
        chatContainer.scrollTop = chatContainer.scrollHeight;

        // Display thinking indicator
        const thinkingMessageDiv = document.createElement('div');
        thinkingMessageDiv.className = 'text-left mb-2';
        thinkingMessageDiv.innerHTML = `<p class="bg-gray-200 text-gray-800 rounded-lg py-2 px-4 inline-block">Pensando...</p>`;
        chatContainer.appendChild(thinkingMessageDiv);
        chatContainer.scrollTop = chatContainer.scrollHeight;

        try {
            const response = await fetch('/api/gemini-chat', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json'
                },
                body: JSON.stringify({ prompt: prompt })
            });

            const result = await response.json();
            
            chatContainer.removeChild(thinkingMessageDiv);

            const geminiMessageDiv = document.createElement('div');
            geminiMessageDiv.className = 'text-left mb-2';
            let responseText = 'No se pudo obtener una respuesta.';
            if (response.ok && result.response) {
                responseText = result.response;
            } else if (result.error) {
                responseText = `Error: ${result.error}`;
            }
            geminiMessageDiv.innerHTML = `<p class="bg-gray-200 text-gray-800 rounded-lg py-2 px-4 inline-block">${responseText.replace(/\n/g, '<br>')}</p>`;
            chatContainer.appendChild(geminiMessageDiv);
            chatContainer.scrollTop = chatContainer.scrollHeight;

        } catch (error) {
            chatContainer.removeChild(thinkingMessageDiv);
            const errorMessageDiv = document.createElement('div');
            errorMessageDiv.className = 'text-left mb-2';
            errorMessageDiv.innerHTML = `<p class="bg-red-200 text-red-800 rounded-lg py-2 px-4 inline-block">Error de conexión: ${error.message}</p>`;
            chatContainer.appendChild(errorMessageDiv);
            chatContainer.scrollTop = chatContainer.scrollHeight;
        } finally {
            submitButton.innerHTML = originalButtonText;
            submitButton.disabled = false;
        }
    });

    // --- Estilos ---
    document.querySelectorAll('.input-style').forEach(el => {
        el.className += ' px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500';
    });
    document.querySelectorAll('.btn-primary').forEach(el => {
        el.className += ' bg-blue-600 text-white font-bold py-2 px-4 rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors disabled:opacity-50';
    });
    document.querySelectorAll('.btn-secondary').forEach(el => {
        el.className += ' bg-gray-600 text-white font-bold py-2 px-4 rounded-md hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 transition-colors disabled:opacity-50';
    });
    document.querySelectorAll('.btn-danger').forEach(el => {
        el.className += ' bg-red-600 text-white font-bold py-2 px-4 rounded-md hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition-colors disabled:opacity-50';
    });
});
</script>
</body>
</html>
