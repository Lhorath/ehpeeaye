<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ehpeeaye API Request Tool | Test REST APIs Online</title>
    <meta name="description" content="Ehpeeaye is a fast online API request tool to build, test, and debug REST API calls with headers, auth, query params, and response history.">
    <meta name="keywords" content="API request tool, REST API tester, API client, HTTP request builder, API debugging, online Postman alternative">
    <meta name="author" content="Ehpeeaye">
    <meta name="robots" content="index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1">
    <meta name="theme-color" content="#111827">
    <link rel="canonical" href="http://ehpeeaye.dackdns.ddns.net/">

    <!-- Open Graph -->
    <meta property="og:type" content="website">
    <meta property="og:site_name" content="Ehpeeaye">
    <meta property="og:title" content="Ehpeeaye API Request Tool | Test REST APIs Online">
    <meta property="og:description" content="Build and test API requests quickly with headers, auth, query params, and structured response output.">
    <meta property="og:url" content="http://ehpeeaye.dackdns.ddns.net/">
    <meta property="og:image" content="http://ehpeeaye.dackdns.ddns.net/og-image.png">
    <meta property="og:locale" content="en_US">

    <!-- Twitter -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="Ehpeeaye API Request Tool | Test REST APIs Online">
    <meta name="twitter:description" content="A lightweight API client to send HTTP requests and inspect responses from your browser.">
    <meta name="twitter:image" content="http://ehpeeaye.dackdns.ddns.net/og-image.png">

    <!-- Structured data -->
    <script type="application/ld+json">
        {
            "@context": "https://schema.org",
            "@type": "WebApplication",
            "name": "Ehpeeaye API Request Tool",
            "applicationCategory": "DeveloperApplication",
            "operatingSystem": "Web",
            "url": "http://ehpeeaye.dackdns.ddns.net/",
            "description": "Online API request and response testing tool for REST APIs.",
            "offers": {
                "@type": "Offer",
                "price": "0",
                "priceCurrency": "USD"
            }
        }
    </script>
    <!-- Tailwind CSS for styling -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Google Fonts: Inter -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        /* Custom styles */
        body {
            font-family: 'Inter', sans-serif;
            background-color: #111827; /* Dark background */
            color: #d1d5db; /* Light text */
        }
        .request-input {
            background-color: #1f2937;
            border-color: #4b5563;
        }
        .request-input:focus {
            background-color: #374151;
            border-color: #6366f1;
            outline: none;
            box-shadow: none;
        }
        .tab-active {
            border-bottom-color: #6366f1;
            color: #e5e7eb;
        }
        .tab-inactive {
            border-bottom-color: transparent;
            color: #9ca3af;
        }
        .side-panel-item:hover {
            background-color: #374151;
        }
        .loader {
            border-top-color: #6366f1;
            animation: spin 1s linear infinite;
        }
        @keyframes spin {
            to { transform: rotate(360deg); }
        }
        /* Custom scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
        }
        ::-webkit-scrollbar-track {
            background: #1f2937;
        }
        ::-webkit-scrollbar-thumb {
            background: #4b5563;
            border-radius: 4px;
        }
        ::-webkit-scrollbar-thumb:hover {
            background: #6b7280;
        }
    </style>
</head>
<body class="min-h-screen p-4">
    <header class="mb-4 bg-[#1f2937] rounded-lg shadow-lg p-4 border border-gray-700 text-center">
        <h1 class="text-2xl md:text-3xl font-bold text-gray-100 tracking-tight">EhPeeAye</h1>
        <p class="text-sm md:text-base text-gray-400 mt-1">API Request Tool</p>
    </header>

    <main class="h-[calc(100vh-9.5rem)] flex flex-col md:flex-row gap-4">

    <!-- Left Panel: History & Responses -->
    <div class="w-full md:w-1/4 flex flex-col bg-[#1f2937] rounded-lg shadow-lg overflow-hidden">
        <div class="p-4 border-b border-gray-700">
            <div class="flex border-b border-gray-700 -mx-4 px-2">
                <button class="side-tab tab-active py-2 px-4 text-sm font-semibold" data-tab="history">History</button>
                <button class="side-tab tab-inactive py-2 px-4 text-sm font-semibold" data-tab="responses">Responses</button>
            </div>
            <div class="flex justify-end items-center h-8 mt-2">
                 <button id="clear-history" class="text-sm text-gray-400 hover:text-white transition-colors" title="Clear History">
                     <i class="fas fa-trash"></i> Clear History
                 </button>
                 <button id="clear-responses" class="hidden text-sm text-gray-400 hover:text-white transition-colors" title="Clear Responses">
                     <i class="fas fa-trash"></i> Clear Responses
                 </button>
            </div>
        </div>
        <!-- History Panel -->
        <div id="history-panel" class="flex-grow overflow-y-auto p-2">
            <div id="history-list">
                <p class="text-center text-gray-500 mt-4">No requests yet.</p>
            </div>
        </div>
        <!-- Responses Panel -->
        <div id="responses-panel" class="hidden flex-grow overflow-y-auto p-2">
            <div id="responses-list">
                <p class="text-center text-gray-500 mt-4">No responses yet.</p>
            </div>
        </div>
    </div>

    <!-- Main Content (Right Side) -->
    <div class="w-full md:w-3/4 flex flex-col gap-4">
        <!-- Request Panel -->
        <div class="bg-[#1f2937] rounded-lg shadow-lg p-4">
            <h1 class="text-xl font-bold mb-4 text-gray-100">API Request Builder</h1>
            <!-- URL Input and Send Button -->
            <div class="flex gap-2 mb-4">
                <select id="request-method" class="request-input rounded-l-md px-4 py-2 text-white font-semibold">
                    <option>GET</option>
                    <option>POST</option>
                    <option>PUT</option>
                    <option>PATCH</option>
                    <option>DELETE</option>
                </select>
                <input type="text" id="request-url" placeholder="https://api.example.com/data" class="w-full request-input px-4 py-2 text-white">
                <button id="send-request" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-6 rounded-r-md transition-colors flex items-center gap-2">
                    <i class="fas fa-paper-plane"></i> Send
                </button>
            </div>
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-2 mb-4">
                <div class="flex gap-2">
                    <select id="collection-select" class="w-full request-input rounded-md px-3 py-2 text-sm text-white"></select>
                    <button id="new-collection" class="bg-gray-600 hover:bg-gray-700 text-white font-semibold py-2 px-3 rounded-md text-sm transition-colors" title="New Collection">
                        <i class="fas fa-folder-plus"></i>
                    </button>
                    <button id="save-request" class="bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-2 px-3 rounded-md text-sm transition-colors">
                        Save
                    </button>
                </div>
                <div class="flex gap-2">
                    <select id="environment-select" class="w-full request-input rounded-md px-3 py-2 text-sm text-white"></select>
                    <button id="new-environment" class="bg-gray-600 hover:bg-gray-700 text-white font-semibold py-2 px-3 rounded-md text-sm transition-colors" title="New Environment">
                        <i class="fas fa-plus"></i>
                    </button>
                    <button id="edit-environment" class="bg-gray-600 hover:bg-gray-700 text-white font-semibold py-2 px-3 rounded-md text-sm transition-colors">
                        Vars
                    </button>
                </div>
            </div>
            <!-- Request Body/Headers Tabs -->
            <div class="flex border-b border-gray-700 mb-4">
                <button class="request-tab tab-active py-2 px-4" data-tab="body">Body</button>
                <button class="request-tab tab-inactive py-2 px-4" data-tab="headers">Headers</button>
                <button class="request-tab tab-inactive py-2 px-4" data-tab="query">Query</button>
                <button class="request-tab tab-inactive py-2 px-4" data-tab="auth">Auth</button>
            </div>
            <!-- Request Body Panel -->
            <div id="request-body-panel">
                <textarea id="request-body" class="w-full h-40 request-input rounded-md p-3 text-sm font-mono" placeholder='{ "key": "value" }'></textarea>
            </div>
            <!-- Request Headers Panel -->
            <div id="request-headers-panel" class="hidden">
                <div id="headers-list" class="space-y-2">
                    <!-- Header items will be populated here -->
                </div>
                <button id="add-header" class="mt-4 bg-gray-600 hover:bg-gray-700 text-white font-semibold py-2 px-4 rounded-md text-sm transition-colors">
                    <i class="fas fa-plus"></i> Add Header
                </button>
            </div>
            <!-- Request Query Params Panel -->
            <div id="request-query-panel" class="hidden">
                <div id="query-list" class="space-y-2">
                    <!-- Query rows will be populated here -->
                </div>
                <button id="add-query" class="mt-4 bg-gray-600 hover:bg-gray-700 text-white font-semibold py-2 px-4 rounded-md text-sm transition-colors">
                    <i class="fas fa-plus"></i> Add Query Param
                </button>
            </div>
            <!-- Request Auth Panel -->
            <div id="request-auth-panel" class="hidden space-y-3">
                <select id="auth-type" class="w-full request-input rounded-md p-2 text-sm text-white">
                    <option value="none">No Auth</option>
                    <option value="bearer">Bearer Token</option>
                    <option value="basic">Basic Auth</option>
                    <option value="apikey">API Key</option>
                </select>
                <div id="auth-bearer-panel" class="hidden">
                    <input id="auth-bearer" type="text" class="w-full request-input rounded-md p-2 text-sm" placeholder="Token or {{token}}">
                </div>
                <div id="auth-basic-panel" class="hidden grid grid-cols-1 md:grid-cols-2 gap-2">
                    <input id="auth-basic-user" type="text" class="request-input rounded-md p-2 text-sm" placeholder="Username">
                    <input id="auth-basic-pass" type="password" class="request-input rounded-md p-2 text-sm" placeholder="Password">
                </div>
                <div id="auth-apikey-panel" class="hidden grid grid-cols-1 md:grid-cols-3 gap-2">
                    <input id="auth-api-key" type="text" class="request-input rounded-md p-2 text-sm" placeholder="Key (e.g. x-api-key)">
                    <input id="auth-api-value" type="text" class="request-input rounded-md p-2 text-sm" placeholder="Value or {{apiKey}}">
                    <select id="auth-api-add-to" class="request-input rounded-md p-2 text-sm text-white">
                        <option value="header">Add to Header</option>
                        <option value="query">Add to Query</option>
                    </select>
                </div>
            </div>
        </div>

        <!-- Response Panel -->
        <div class="flex-grow bg-[#1f2937] rounded-lg shadow-lg flex flex-col overflow-hidden">
            <div class="p-4 border-b border-gray-700 flex justify-between items-center">
                <h2 class="text-lg font-bold text-gray-200">Response</h2>
                <div id="response-status" class="flex items-center gap-4 text-sm">
                    <!-- Status, Time, Size will be populated here -->
                </div>
            </div>
            <div id="response-container" class="flex-grow p-4 overflow-auto">
                <div id="loader" class="hidden justify-center items-center h-full">
                    <div class="loader ease-linear rounded-full border-4 border-t-4 border-gray-500 h-12 w-12"></div>
                </div>
                <div id="response-content" class="h-full">
                     <p class="text-center text-gray-500">Make a request to see the response.</p>
                </div>
            </div>
        </div>
    </div>
    </main>

    <script>
        // DOM Elements
        const methodSelect = document.getElementById('request-method');
        const urlInput = document.getElementById('request-url');
        const sendButton = document.getElementById('send-request');
        const requestBody = document.getElementById('request-body');
        const requestTabs = document.querySelectorAll('.request-tab');
        const requestBodyPanel = document.getElementById('request-body-panel');
        const requestHeadersPanel = document.getElementById('request-headers-panel');
        const requestQueryPanel = document.getElementById('request-query-panel');
        const requestAuthPanel = document.getElementById('request-auth-panel');
        const headersList = document.getElementById('headers-list');
        const addHeaderBtn = document.getElementById('add-header');
        const queryList = document.getElementById('query-list');
        const addQueryBtn = document.getElementById('add-query');
        const authTypeSelect = document.getElementById('auth-type');
        const authBearerPanel = document.getElementById('auth-bearer-panel');
        const authBasicPanel = document.getElementById('auth-basic-panel');
        const authApiKeyPanel = document.getElementById('auth-apikey-panel');
        const collectionSelect = document.getElementById('collection-select');
        const newCollectionBtn = document.getElementById('new-collection');
        const saveRequestBtn = document.getElementById('save-request');
        const environmentSelect = document.getElementById('environment-select');
        const newEnvironmentBtn = document.getElementById('new-environment');
        const editEnvironmentBtn = document.getElementById('edit-environment');
        const responseContainer = document.getElementById('response-container');
        const loader = document.getElementById('loader');
        const responseContent = document.getElementById('response-content');
        const responseStatus = document.getElementById('response-status');
        const sideTabs = document.querySelectorAll('.side-tab');

        const historyPanel = document.getElementById('history-panel');
        const historyList = document.getElementById('history-list');
        const clearHistoryBtn = document.getElementById('clear-history');

        const responsesPanel = document.getElementById('responses-panel');
        const responsesList = document.getElementById('responses-list');
        const clearResponsesBtn = document.getElementById('clear-responses');


        const STORAGE_KEY = 'api-request-tool-state-v1';
        let requestHistory = [];
        let responseLog = [];
        let collections = [];
        let environments = [];
        let activeCollectionId = '';
        let activeEnvironmentId = '';

        // --- Event Listeners ---
        sendButton.addEventListener('click', handleSendRequest);
        addHeaderBtn.addEventListener('click', () => createHeaderInputRow());
        addQueryBtn.addEventListener('click', () => createQueryInputRow());
        authTypeSelect.addEventListener('change', renderAuthFields);
        newCollectionBtn.addEventListener('click', handleCreateCollection);
        saveRequestBtn.addEventListener('click', handleSaveRequest);
        collectionSelect.addEventListener('change', (e) => setActiveCollection(e.target.value));
        newEnvironmentBtn.addEventListener('click', handleCreateEnvironment);
        editEnvironmentBtn.addEventListener('click', handleEditEnvironmentVars);
        environmentSelect.addEventListener('change', (e) => setActiveEnvironment(e.target.value));
        clearHistoryBtn.addEventListener('click', () => {
            const collection = getActiveCollection();
            if (!collection) return;
            collection.requests = [];
            requestHistory = collection.requests;
            persistState();
            renderHistory();
        });
        clearResponsesBtn.addEventListener('click', () => {
            responseLog = [];
            persistState();
            renderResponses();
        });

        requestTabs.forEach(tab => {
            tab.addEventListener('click', () => {
                requestTabs.forEach(t => t.classList.replace('tab-active', 'tab-inactive'));
                tab.classList.replace('tab-inactive', 'tab-active');
                const activeTab = tab.dataset.tab;
                requestBodyPanel.classList.toggle('hidden', activeTab !== 'body');
                requestHeadersPanel.classList.toggle('hidden', activeTab !== 'headers');
                requestQueryPanel.classList.toggle('hidden', activeTab !== 'query');
                requestAuthPanel.classList.toggle('hidden', activeTab !== 'auth');
            });
        });

        sideTabs.forEach(tab => {
            tab.addEventListener('click', () => {
                sideTabs.forEach(t => t.classList.replace('tab-active', 'tab-inactive'));
                tab.classList.replace('tab-inactive', 'tab-active');

                const activeTab = tab.dataset.tab;

                historyPanel.classList.toggle('hidden', activeTab !== 'history');
                responsesPanel.classList.toggle('hidden', activeTab !== 'responses');

                clearHistoryBtn.classList.toggle('hidden', activeTab !== 'history');
                clearResponsesBtn.classList.toggle('hidden', activeTab !== 'responses');
            });
        });

        // --- Functions ---
        async function handleSendRequest() {
            const rawUrl = urlInput.value.trim();
            if (!rawUrl) {
                // In a real app, use a modal instead of alert.
                alert("Please enter a URL.");
                return;
            }

            const envVars = getEnvironmentVarsMap();
            const url = interpolateTemplate(rawUrl, envVars);
            const method = methodSelect.value;
            const headers = getHeadersFromInputs(envVars);
            const queryParams = getQueryParamsFromInputs(envVars);
            const auth = getAuthFromInputs();
            const body = interpolateTemplate(requestBody.value, envVars);
            const finalUrl = buildUrlWithQueryParams(url, queryParams);

            loader.style.display = 'flex';
            responseContent.innerHTML = '';
            responseStatus.innerHTML = '';

            const startTime = Date.now();

            try {
                const options = {
                    method,
                    headers: new Headers(headers),
                };
                applyAuthToRequest(options, auth, envVars);
                const authUrl = appendAuthQueryParam(finalUrl, auth, envVars);

                if (['POST', 'PUT', 'PATCH'].includes(method) && body) {
                    if (!headers['Content-Type']) {
                        options.headers.set('Content-Type', 'application/json');
                    }
                    options.body = body;
                }

                const response = await fetch(authUrl, options);
                const endTime = Date.now();
                const responseData = await response.text();
                const responseSize = new Blob([responseData]).size;

                displayResponse(response, responseData, endTime - startTime, responseSize, method);
            } catch (error) {
                const endTime = Date.now();
                displayError(error, endTime - startTime, url, method);
            } finally {
                loader.style.display = 'none';
            }
        }

        function displayResponse(response, data, time, size, method) {
            const statusClass = response.ok ? 'text-green-400' : 'text-red-400';
            responseStatus.innerHTML = `
                <span class="font-semibold ${statusClass}">Status: ${response.status} ${response.statusText}</span>
                <span class="text-gray-400">Time: ${time} ms</span>
                <span class="text-gray-400">Size: ${(size / 1024).toFixed(2)} KB</span>
            `;

            let formattedBody = `<pre class="text-sm whitespace-pre-wrap word-wrap: break-word;">${data.replace(/</g, "&lt;").replace(/>/g, "&gt;")}</pre>`;
            const contentType = response.headers.get('content-type');
            if (contentType && contentType.includes('application/json')) {
                try {
                    const jsonData = JSON.parse(data);
                    formattedBody = `<pre class="text-sm whitespace-pre-wrap word-wrap: break-word;">${JSON.stringify(jsonData, null, 2)}</pre>`;
                } catch(e) { /* Fallback to plain text if JSON parsing fails */ }
            }
            responseContent.innerHTML = formattedBody;

            // Log the response
            addToResponses({ url: response.url, method, ok: response.ok, status: response.status, statusText: response.statusText, time, size });
        }

        function displayError(error, time, url, method) {
            responseStatus.innerHTML = `
                <span class="font-semibold text-red-400">Error</span>
                <span class="text-gray-400">Time: ${time} ms</span>
            `;
            responseContent.innerHTML = `<pre class="text-red-400 text-sm">${error.message}</pre>`;

            // Log the error response
            addToResponses({ url, method, ok: false, status: 'Error', statusText: error.message, time, size: 0 });
        }

        function createHeaderInputRow(key = '', value = '') {
            const div = document.createElement('div');
            div.className = 'flex gap-2 items-center';
            div.innerHTML = `
                <input type="text" placeholder="Key" value="${key}" class="w-1/2 request-input rounded-md p-2 text-sm header-key">
                <input type="text" placeholder="Value" value="${value}" class="w-1/2 request-input rounded-md p-2 text-sm header-value">
                <button class="text-red-500 hover:text-red-400 remove-header" title="Remove Header">
                    <i class="fas fa-trash-alt"></i>
                </button>
            `;
            headersList.appendChild(div);
            div.querySelector('.remove-header').addEventListener('click', () => div.remove());
        }

        function getHeadersFromInputs(envVars = {}) {
            const headers = {};
            document.querySelectorAll('#headers-list .flex').forEach(row => {
                const key = interpolateTemplate(row.querySelector('.header-key').value.trim(), envVars);
                const value = interpolateTemplate(row.querySelector('.header-value').value.trim(), envVars);
                if (key) headers[key] = value;
            });
            return headers;
        }

        function createQueryInputRow(key = '', value = '', enabled = true) {
            const div = document.createElement('div');
            div.className = 'flex gap-2 items-center';
            div.innerHTML = `
                <input type="checkbox" class="query-enabled" ${enabled ? 'checked' : ''} title="Enabled">
                <input type="text" placeholder="Key" value="${key}" class="w-1/2 request-input rounded-md p-2 text-sm query-key">
                <input type="text" placeholder="Value" value="${value}" class="w-1/2 request-input rounded-md p-2 text-sm query-value">
                <button class="text-red-500 hover:text-red-400 remove-query" title="Remove Param">
                    <i class="fas fa-trash-alt"></i>
                </button>
            `;
            queryList.appendChild(div);
            div.querySelector('.remove-query').addEventListener('click', () => div.remove());
        }

        function getQueryParamsFromInputs(envVars = {}) {
            const params = [];
            document.querySelectorAll('#query-list .flex').forEach(row => {
                const enabled = row.querySelector('.query-enabled').checked;
                const key = interpolateTemplate(row.querySelector('.query-key').value.trim(), envVars);
                const value = interpolateTemplate(row.querySelector('.query-value').value.trim(), envVars);
                if (enabled && key) {
                    params.push({ key, value });
                }
            });
            return params;
        }

        function getAuthFromInputs() {
            return {
                type: authTypeSelect.value,
                bearer: document.getElementById('auth-bearer').value.trim(),
                basicUser: document.getElementById('auth-basic-user').value.trim(),
                basicPass: document.getElementById('auth-basic-pass').value,
                apiKey: document.getElementById('auth-api-key').value.trim(),
                apiValue: document.getElementById('auth-api-value').value.trim(),
                apiAddTo: document.getElementById('auth-api-add-to').value
            };
        }

        function renderAuthFields() {
            const type = authTypeSelect.value;
            authBearerPanel.classList.toggle('hidden', type !== 'bearer');
            authBasicPanel.classList.toggle('hidden', type !== 'basic');
            authApiKeyPanel.classList.toggle('hidden', type !== 'apikey');
        }

        function buildUrlWithQueryParams(baseUrl, queryParams) {
            try {
                const parsedUrl = new URL(baseUrl);
                queryParams.forEach(param => parsedUrl.searchParams.append(param.key, param.value));
                return parsedUrl.toString();
            } catch {
                const query = queryParams
                    .map(param => `${encodeURIComponent(param.key)}=${encodeURIComponent(param.value)}`)
                    .join('&');
                if (!query) return baseUrl;
                return `${baseUrl}${baseUrl.includes('?') ? '&' : '?'}${query}`;
            }
        }

        function applyAuthToRequest(options, auth, envVars = {}) {
            if (auth.type === 'bearer') {
                const token = interpolateTemplate(auth.bearer, envVars);
                if (token) options.headers.set('Authorization', `Bearer ${token}`);
            }
            if (auth.type === 'basic') {
                const username = interpolateTemplate(auth.basicUser, envVars);
                const password = interpolateTemplate(auth.basicPass, envVars);
                if (username || password) options.headers.set('Authorization', `Basic ${btoa(`${username}:${password}`)}`);
            }
            if (auth.type === 'apikey' && auth.apiAddTo === 'header') {
                const key = interpolateTemplate(auth.apiKey, envVars);
                const value = interpolateTemplate(auth.apiValue, envVars);
                if (key && value) options.headers.set(key, value);
            }
        }

        function appendAuthQueryParam(url, auth, envVars = {}) {
            if (auth.type !== 'apikey' || auth.apiAddTo !== 'query') return url;
            const key = interpolateTemplate(auth.apiKey, envVars);
            const value = interpolateTemplate(auth.apiValue, envVars);
            if (!key || !value) return url;
            return buildUrlWithQueryParams(url, [{ key, value }]);
        }

        function interpolateTemplate(value, vars = {}) {
            return (value || '').replace(/\{\{\s*([a-zA-Z0-9_.-]+)\s*\}\}/g, (_, key) => vars[key] ?? '');
        }

        function getEnvironmentVarsMap() {
            const env = getActiveEnvironment();
            const vars = {};
            if (!env || !Array.isArray(env.vars)) return vars;
            env.vars.forEach(entry => {
                if (entry.key) vars[entry.key] = entry.value ?? '';
            });
            return vars;
        }

        function getDefaultState() {
            return {
                collections: [{ id: 'default', name: 'Default', requests: [] }],
                environments: [{ id: 'default', name: 'Default', vars: [] }],
                activeCollectionId: 'default',
                activeEnvironmentId: 'default',
                responseLog: []
            };
        }

        function loadState() {
            const fallback = getDefaultState();
            try {
                const parsed = JSON.parse(localStorage.getItem(STORAGE_KEY) || 'null');
                if (!parsed) return fallback;
                return {
                    collections: Array.isArray(parsed.collections) && parsed.collections.length ? parsed.collections : fallback.collections,
                    environments: Array.isArray(parsed.environments) && parsed.environments.length ? parsed.environments : fallback.environments,
                    activeCollectionId: parsed.activeCollectionId || fallback.activeCollectionId,
                    activeEnvironmentId: parsed.activeEnvironmentId || fallback.activeEnvironmentId,
                    responseLog: Array.isArray(parsed.responseLog) ? parsed.responseLog : []
                };
            } catch {
                return fallback;
            }
        }

        function persistState() {
            const data = {
                collections,
                environments,
                activeCollectionId,
                activeEnvironmentId,
                responseLog
            };
            localStorage.setItem(STORAGE_KEY, JSON.stringify(data));
        }

        function getActiveCollection() {
            return collections.find(collection => collection.id === activeCollectionId) || null;
        }

        function getActiveEnvironment() {
            return environments.find(environment => environment.id === activeEnvironmentId) || null;
        }

        function setActiveCollection(id) {
            activeCollectionId = id;
            const collection = getActiveCollection();
            requestHistory = collection ? collection.requests : [];
            renderCollections();
            renderHistory();
            persistState();
        }

        function setActiveEnvironment(id) {
            activeEnvironmentId = id;
            renderEnvironments();
            persistState();
        }

        function renderCollections() {
            collectionSelect.innerHTML = '';
            collections.forEach(collection => {
                const option = document.createElement('option');
                option.value = collection.id;
                option.textContent = collection.name;
                if (collection.id === activeCollectionId) option.selected = true;
                collectionSelect.appendChild(option);
            });
        }

        function renderEnvironments() {
            environmentSelect.innerHTML = '';
            environments.forEach(environment => {
                const option = document.createElement('option');
                option.value = environment.id;
                option.textContent = environment.name;
                if (environment.id === activeEnvironmentId) option.selected = true;
                environmentSelect.appendChild(option);
            });
        }

        function handleCreateCollection() {
            const name = prompt('Collection name:');
            if (!name || !name.trim()) return;
            const id = `col-${Date.now()}`;
            collections.push({ id, name: name.trim(), requests: [] });
            setActiveCollection(id);
        }

        function handleSaveRequest() {
            const collection = getActiveCollection();
            if (!collection) return;
            const url = urlInput.value.trim();
            if (!url) {
                alert('Enter a URL before saving.');
                return;
            }
            const fallbackName = `${methodSelect.value} ${url}`;
            const name = prompt('Request name:', fallbackName);
            if (!name || !name.trim()) return;
            const request = {
                name: name.trim(),
                method: methodSelect.value,
                url,
                body: requestBody.value,
                headers: getHeadersFromInputs(),
                queryParams: getQueryParamsFromInputs(),
                auth: getAuthFromInputs()
            };
            const existingIndex = collection.requests.findIndex(item => item.name === request.name);
            if (existingIndex >= 0) collection.requests[existingIndex] = request;
            else collection.requests.unshift(request);
            if (collection.requests.length > 100) collection.requests.pop();
            requestHistory = collection.requests;
            renderHistory();
            persistState();
        }

        function handleCreateEnvironment() {
            const name = prompt('Environment name:');
            if (!name || !name.trim()) return;
            const id = `env-${Date.now()}`;
            environments.push({ id, name: name.trim(), vars: [] });
            setActiveEnvironment(id);
        }

        function handleEditEnvironmentVars() {
            const environment = getActiveEnvironment();
            if (!environment) return;
            const current = {};
            (environment.vars || []).forEach(entry => {
                if (entry.key) current[entry.key] = entry.value ?? '';
            });
            const raw = prompt('Edit environment variables as JSON object', JSON.stringify(current, null, 2));
            if (raw === null) return;
            try {
                const parsed = JSON.parse(raw);
                environment.vars = Object.entries(parsed).map(([key, value]) => ({ key, value: String(value ?? '') }));
                persistState();
            } catch {
                alert('Invalid JSON. Use an object like {"baseUrl":"https://api.example.com"}');
            }
        }

        function renderHistory() {
            if (requestHistory.length === 0) {
                historyList.innerHTML = '<p class="text-center text-gray-500 mt-4">No saved requests in this collection.</p>';
                return;
            }
            historyList.innerHTML = '';
            requestHistory.forEach((req, index) => {
                const div = document.createElement('div');
                div.className = 'side-panel-item p-3 rounded-md cursor-pointer transition-colors';
                div.dataset.index = index;
                const methodClass = {
                    GET: 'text-green-400', POST: 'text-yellow-400', PUT: 'text-blue-400',
                    PATCH: 'text-purple-400', DELETE: 'text-red-400',
                }[req.method] || 'text-gray-400';

                div.innerHTML = `
                    <div class="flex items-center justify-between">
                        <span class="font-bold text-sm ${methodClass}">${req.method}</span>
                    </div>
                    <p class="text-xs text-gray-200 truncate mt-1" title="${req.name || req.url}">${req.name || req.url}</p>
                    <p class="text-xs text-gray-400 truncate mt-1" title="${req.url}">${req.url}</p>
                `;
                div.addEventListener('click', () => loadFromHistory(index));
                historyList.appendChild(div);
            });
        }

        function loadFromHistory(index) {
            const req = requestHistory[index];
            methodSelect.value = req.method;
            urlInput.value = req.url;
            requestBody.value = req.body || '';
            headersList.innerHTML = '';
            queryList.innerHTML = '';
            if (req.headers) {
                Object.entries(req.headers).forEach(([key, value]) => createHeaderInputRow(key, value));
            }
            if (Object.keys(req.headers || {}).length === 0) {
                createHeaderInputRow(); // Ensure one empty row if no headers
            }
            if (Array.isArray(req.queryParams) && req.queryParams.length) {
                req.queryParams.forEach(param => createQueryInputRow(param.key, param.value, true));
            } else {
                createQueryInputRow();
            }
            const auth = req.auth || { type: 'none' };
            authTypeSelect.value = auth.type || 'none';
            document.getElementById('auth-bearer').value = auth.bearer || '';
            document.getElementById('auth-basic-user').value = auth.basicUser || '';
            document.getElementById('auth-basic-pass').value = auth.basicPass || '';
            document.getElementById('auth-api-key').value = auth.apiKey || '';
            document.getElementById('auth-api-value').value = auth.apiValue || '';
            document.getElementById('auth-api-add-to').value = auth.apiAddTo || 'header';
            renderAuthFields();
        }

        function addToResponses(responseInfo) {
            responseLog.unshift(responseInfo);
            if (responseLog.length > 50) responseLog.pop();
            persistState();
            renderResponses();
        }

        function renderResponses() {
            if (responseLog.length === 0) {
                responsesList.innerHTML = '<p class="text-center text-gray-500 mt-4">No responses yet.</p>';
                return;
            }
            responsesList.innerHTML = '';
            responseLog.forEach((res) => {
                const div = document.createElement('div');
                div.className = 'side-panel-item p-3 rounded-md';
                const statusClass = res.ok ? 'text-green-400' : 'text-red-400';
                const methodClass = {
                    GET: 'text-green-400', POST: 'text-yellow-400', PUT: 'text-blue-400',
                    PATCH: 'text-purple-400', DELETE: 'text-red-400',
                }[res.method] || 'text-gray-400';

                div.innerHTML = `
                    <div class="flex items-center justify-between">
                        <span class="font-bold text-sm ${methodClass}">${res.method}</span>
                        <span class="font-semibold text-xs ${statusClass}">${res.status} ${res.statusText}</span>
                    </div>
                    <p class="text-xs text-gray-300 truncate mt-1" title="${res.url}">${res.url}</p>
                    <div class="text-xs text-gray-500 mt-1 flex justify-between">
                        <span>${res.time} ms</span>
                        <span>${(res.size / 1024).toFixed(2)} KB</span>
                    </div>
                `;
                responsesList.appendChild(div);
            });
        }

        // --- Initial Setup ---
        const state = loadState();
        collections = state.collections;
        environments = state.environments;
        activeCollectionId = state.activeCollectionId;
        activeEnvironmentId = state.activeEnvironmentId;
        responseLog = state.responseLog || [];
        if (!collections.some(collection => collection.id === activeCollectionId)) {
            activeCollectionId = collections[0]?.id || 'default';
        }
        if (!environments.some(environment => environment.id === activeEnvironmentId)) {
            activeEnvironmentId = environments[0]?.id || 'default';
        }
        requestHistory = getActiveCollection()?.requests || [];
        renderCollections();
        renderEnvironments();
        createHeaderInputRow();
        createQueryInputRow();
        renderAuthFields();
        renderHistory();
        renderResponses();
    </script>
</body>
</html>
