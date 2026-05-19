<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $document->title ?? 'Dokumen' }} - Editor Kolaboratif</title>
    
    <!-- CDN: TailwindCSS, Quill Editor, Pusher/Laravel Reverb -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/quill@2.0.0/dist/quill.snow.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/@fontsource/inter@5.0.18/index.min.css" rel="stylesheet">
    
    <style>
        body { font-family: 'Inter', sans-serif; background-color: #f3f4f6; }
        #editor-wrapper { max-width: 850px; margin: 0 auto; background: #fff; border-radius: 12px; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1); overflow: hidden; }
        #editor-container { height: 75vh; font-size: 16px; line-height: 1.6; }
        .ql-toolbar { border-top-left-radius: 12px; border-top-right-radius: 12px; border-color: #e5e7eb; background: #f9fafb; }
        .ql-container { border-bottom-left-radius: 12px; border-bottom-right-radius: 12px; border-color: #e5e7eb; }
        
        /* Live Cursor Overlay */
        #cursors-layer { position: fixed; inset: 0; pointer-events: none; z-index: 50; }
        .remote-cursor { position: absolute; border-left-width: 2px; border-left-style: solid; height: 20px; transition: left 0.1s ease, top 0.1s ease; }
        .remote-cursor-label { position: absolute; top: -18px; left: -2px; font-size: 11px; font-weight: 600; padding: 1px 4px; border-radius: 3px; color: #fff; white-space: nowrap; }
        
        /* Version History Panel */
        #version-sidebar { position: fixed; right: 0; top: 0; bottom: 0; width: 360px; background: #fff; border-left: 1px solid #e5e7eb; transform: translateX(100%); transition: transform 0.3s cubic-bezier(0.4,0,0.2,1); z-index: 100; display: flex; flex-direction: column; }
        #version-sidebar.open { transform: translateX(0); }
         .version-item { transition: all 0.2s; cursor: pointer; }
        .version-item:hover { background-color: #f0f9ff; border-left-color: #3b82f6; }
        
        /* Active Users Badges */
        .user-badge { display: inline-flex; align-items: center; gap: 4px; padding: 4px 8px; border-radius: 999px; font-size: 12px; font-weight: 500; color: #fff; margin-right: -6px; border: 2px solid #fff; }
    </style>
</head>
<body class="h-screen flex flex-col">

    <!-- Header Bar -->
    <header class="bg-white border-b px-6 py-3 flex items-center justify-between shadow-sm z-20">
        <div class="flex items-center gap-4">
            <div class="w-8 h-8 bg-blue-600 rounded-lg flex items-center justify-center text-white font-bold">📝</div>
            <div>
                <h1 class="text-lg font-bold text-gray-800 leading-tight">{{ $document->title ?? 'Dokumen Baru' }}</h1>
                <span id="sync-status" class="text-xs text-green-600 font-medium">● Tersimpan</span>
            </div>
        </div>
        <div class="flex items-center gap-3">
            <div id="active-users-list" class="flex items-center"></div>
            <button onclick="toggleVersionPanel()" class="px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 rounded-lg text-sm font-medium transition flex items-center gap-2">
                🕒 Riwayat Versi
            </button>
        </div>
    </header>

    <!-- Main Content -->
    <main class="flex-1 overflow-y-auto p-6 relative">
        <!-- Editor Container -->
        <div id="editor-wrapper">
            <div id="editor-container"></div>
        </div>
     .version-item { transition: all 0.2s; cursor: pointer; }
        .version-item:hover { background-color: #f0f9ff; border-left-color: #3b82f6; }
        
        /* Active Users Badges */
        .user-badge { display: inline-flex; align-items: center; gap: 4px; padding: 4px 8px; border-radius: 999px; font-size: 12px; font-weight: 500; color: #fff; margin-right: -6px; border: 2px solid #fff; }
    </style>
</head>
<body class="h-screen flex flex-col">

    <!-- Header Bar -->
    <header class="bg-white border-b px-6 py-3 flex items-center justify-between shadow-sm z-20">
        <div class="flex items-center gap-4">
            <div class="w-8 h-8 bg-blue-600 rounded-lg flex items-center justify-center text-white font-bold">📝</div>
            <div>
                <h1 class="text-lg font-bold text-gray-800 leading-tight">{{ $document->title ?? 'Dokumen Baru' }}</h1>
                <span id="sync-status" class="text-xs text-green-600 font-medium">● Tersimpan</span>
            </div>
        </div>
        <div class="flex items-center gap-3">
            <div id="active-users-list" class="flex items-center"></div>
            <button onclick="toggleVersionPanel()" class="px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 rounded-lg text-sm font-medium transition flex items-center gap-2">
                🕒 Riwayat Versi
            </button>
        </div>
    </header>

    <!-- Main Content -->
    <main class="flex-1 overflow-y-auto p-6 relative">
        <!-- Editor Container -->
        <div id="editor-wrapper">
            <div id="editor-container"></div>
        </div>
     .version-item { transition: all 0.2s; cursor: pointer; }
        .version-item:hover { background-color: #f0f9ff; border-left-color: #3b82f6; }
        
        /* Active Users Badges */
        .user-badge { display: inline-flex; align-items: center; gap: 4px; padding: 4px 8px; border-radius: 999px; font-size: 12px; font-weight: 500; color: #fff; margin-right: -6px; border: 2px solid #fff; }
    </style>
</head>
<body class="h-screen flex flex-col">

    <!-- Header Bar -->
    <header class="bg-white border-b px-6 py-3 flex items-center justify-between shadow-sm z-20">
        <div class="flex items-center gap-4">
            <div class="w-8 h-8 bg-blue-600 rounded-lg flex items-center justify-center text-white font-bold">📝</div>
            <div>
                <h1 class="text-lg font-bold text-gray-800 leading-tight">{{ $document->title ?? 'Dokumen Baru' }}</h1>
                <span id="sync-status" class="text-xs text-green-600 font-medium">● Tersimpan</span>
            </div>
        </div>
        <div class="flex items-center gap-3">
            <div id="active-users-list" class="flex items-center"></div>
            <button onclick="toggleVersionPanel()" class="px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 rounded-lg text-sm font-medium transition flex items-center gap-2">
                🕒 Riwayat Versi
            </button>
        </div>
    </header>

    <!-- Main Content -->
    <main class="flex-1 overflow-y-auto p-6 relative">
        <!-- Editor Container -->
        <div id="editor-wrapper">
            <div id="editor-container"></div>
        </div> .version-item { transition: all 0.2s; cursor: pointer; }
        .version-item:hover { background-color: #f0f9ff; border-left-color: #3b82f6; }
        
        /* Active Users Badges */
        .user-badge { display: inline-flex; align-items: center; gap: 4px; padding: 4px 8px; border-radius: 999px; font-size: 12px; font-weight: 500; color: #fff; margin-right: -6px; border: 2px solid #fff; }
    </style>
</head>
<body class="h-screen flex flex-col">

    <!-- Header Bar -->
    <header class="bg-white border-b px-6 py-3 flex items-center justify-between shadow-sm z-20">
        <div class="flex items-center gap-4">
            <div class="w-8 h-8 bg-blue-600 rounded-lg flex items-center justify-center text-white font-bold">📝</div>
            <div>
                <h1 class="text-lg font-bold text-gray-800 leading-tight">{{ $document->title ?? 'Dokumen Baru' }}</h1>
                <span id="sync-status" class="text-xs text-green-600 font-medium">● Tersimpan</span>
            </div>
        </div>
        <div class="flex items-center gap-3">
            <div id="active-users-list" class="flex items-center"></div>
            <button onclick="toggleVersionPanel()" class="px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 rounded-lg text-sm font-medium transition flex items-center gap-2">
                🕒 Riwayat Versi
            </button>
        </div>
    </header>

    <!-- Main Content -->
    <main class="flex-1 overflow-y-auto p-6 relative">
        <!-- Editor Container -->
        <div id="editor-wrapper">
            <div id="editor-container"></div>
        </div> .version-item { transition: all 0.2s; cursor: pointer; }
        .version-item:hover { background-color: #f0f9ff; border-left-color: #3b82f6; }
        
        /* Active Users Badges */
        .user-badge { display: inline-flex; align-items: center; gap: 4px; padding: 4px 8px; border-radius: 999px; font-size: 12px; font-weight: 500; color: #fff; margin-right: -6px; border: 2px solid #fff; }
    </style>
</head>
<body class="h-screen flex flex-col">

    <!-- Header Bar -->
    <header class="bg-white border-b px-6 py-3 flex items-center justify-between shadow-sm z-20">
        <div class="flex items-center gap-4">
            <div class="w-8 h-8 bg-blue-600 rounded-lg flex items-center justify-center text-white font-bold">📝</div>
            <div>
                <h1 class="text-lg font-bold text-gray-800 leading-tight">{{ $document->title ?? 'Dokumen Baru' }}</h1>
                <span id="sync-status" class="text-xs text-green-600 font-medium">● Tersimpan</span>
            </div>
        </div>
        <div class="flex items-center gap-3">
            <div id="active-users-list" class="flex items-center"></div>
            <button onclick="toggleVersionPanel()" class="px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 rounded-lg text-sm font-medium transition flex items-center gap-2">
                🕒 Riwayat Versi
            </button>
        </div>
    </header>

    <!-- Main Content -->
    <main class="flex-1 overflow-y-auto p-6 relative">
        <!-- Editor Container -->
        <div id="editor-wrapper">
            <div id="editor-container"></div>
        </div>
     </main>

    <!-- Remote Cursors Layer -->
    <div id="cursors-layer"></div>

    <!-- Version History Sidebar -->
    <aside id="version-sidebar" class="shadow-xl">
        <div class="p-4 border-b flex justify-between items-center bg-gray-50">
            <h2 class="font-bold text-gray-800">Riwayat Revisi</h2>
            <button onclick="toggleVersionPanel()" class="text-gray-500 hover:text-gray-800 text-xl leading-none">&times;</button>
        </div>
        <div id="version-list" class="flex-1 overflow-y-auto p-4 space-y-2">
            <p class="text-center text-gray-400 mt-8">Memuat riwayat...</p>
        </div>
    </aside>

    <!-- JAVASCRIPT: Frontend Logic & Editor Integration -->
    <script src="https://cdn.jsdelivr.net/npm/quill@2.0.0/dist/quill.js"></script>
    <script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>
    <script>
        // ==========================================
        // 1. KONFIGURASI & INISIALISASI EDITOR
        // ==========================================
        const APP_CONFIG = {
            documentId: {{ $document->id ?? 'null' }},
            userId: {{ auth()->id() ?? 'null' }},
            userName: "{{ auth()->user()->name ?? 'Guest' }}",
            csrfToken: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            pusherKey: "{{ config('broadcasting.connections.reverb.key') ?? 'local-reverb-key' }}",
            initialContent: {!! json_encode($document->content ?? '<p>Selamat datang di editor kolaboratif...</p>') !!}
        };

        const quill = new Quill('#editor-container', {
            theme: 'snow',
            placeholder: 'Mulai mengetik atau format teks di sini...',
            modules: {
                toolbar: [
                    [{ 'header': [1, 2, 3, false] }],
                    ['bold', 'italic', 'underline', 'strike'],
                    [{ 'list': 'ordered'}, { 'list': 'bullet' }, { 'indent': '-1'}, { 'indent': '+1' }],
                    [{ 'color': [] }, { 'background': [] }],
                    ['blockquote', 'code-block'],
                    ['clean']
                ]
            }
        });
        quill.root.innerHTML = APP_CONFIG.initialContent;

        // ==========================================
        // 2. MULTI-USER EDITING & CONFLICT RESOLUTION
        // Strategi: Last-Write-Wins dengan Debouncing
        // ==========================================
        let isRemoteUpdate = false;
        let saveDebounceTimer = null;
        const SYNC_DELAY = 800; // ms sebelum sync ke server

        quill.on('text-change', function(delta, oldDelta, source) {
            // Hanya proses jika perubahan berasal dari user lokal
            if (source === 'user' && !isRemoteUpdate) {
                updateSyncStatus('Menyimpan...', 'text-blue-600');
                clearTimeout(saveDebounceTimer);
                saveDebounceTimer = setTimeout(() => syncContentToServer(), SYNC_DELAY);
            }
        });

        async function syncContentToServer() {
            try {
                const response = await fetch(`/documents/${APP_CONFIG.documentId}/collaborate`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': APP_CONFIG.csrfToken
                    },
                    body: JSON.stringify({
                        content: quill.root.innerHTML,
                        change_type: 'edit',
                        delta: quill.getContents()
                    })
                });
                if (response.ok) {
                    updateSyncStatus('Tersimpan', 'text-green-600');
                }
            } catch (err) {
                updateSyncStatus('Gagal sync', 'text-red-600');
                console.error('Sync error:', err);
            }
        }

        // Menerima update dari user lain (Conflict Resolution otomatis via Last-Write-Wins)
        function handleRemoteDocumentUpdate(data) {
            if (data.userId !== APP_CONFIG.userId) {
                isRemoteUpdate = true;
                const currentSelection = quill.getSelection();

                // Timpa konten lokal dengan versi terbaru dari server
                quill.root.innerHTML = data.content;
                
                // Kembalikan posisi cursor user lokal agar tidak hilang
                if (currentSelection) quill.setSelection(currentSelection);
                
                isRemoteUpdate = false;
                updateSyncStatus(`Diedit oleh ${data.userName}`, 'text-purple-600');
                registerActiveUser(data.userId, data.userName, data.color || '#3b82f6');
            }
        }

        // ==========================================
        // 3. LIVE CURSOR TRACKING
        // ==========================================
        const remoteCursors = {};
        const USER_COLORS = ['#ef4444', '#3b82f6', '#10b981', '#f59e0b', '#8b5cf6', '#ec4899'];
        let currentUserColor = USER_COLORS[APP_CONFIG.userId % USER_COLORS.length];

        quill.on('selection-change', function(range) {
            if (range && !isRemoteUpdate) {
                broadcastCursorPosition(range.index);
            }
        });

        async function broadcastCursorPosition(index) {
            fetch(`/documents/${APP_CONFIG.documentId}/cursor`, {
                method: 'POST',
                headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': APP_CONFIG.csrfToken },
                body: JSON.stringify({ position: index, color: currentUserColor })
            });
        }

        function updateRemoteCursor(data) {
            if (data.userId === APP_CONFIG.userId) return;
            
            registerActiveUser(data.userId, data.userName, data.color);
            
            if (!remoteCursors[data.userId]) {
                const cursorEl = document.createElement('div');
                cursorEl.className = 'remote-cursor';
                cursorEl.id = `cursor-${data.userId}`;
                cursorEl.style.borderColor = data.color;
                
                const labelEl = document.createElement('div');
                labelEl.className = 'remote-cursor-label';
                labelEl.style.backgroundColor = data.color;
                labelEl.textContent = data.userName;
                cursorEl.appendChild(labelEl);
                
                document.getElementById('cursors-layer').appendChild(cursorEl);
                remoteCursors[data.userId] = cursorEl;
            }

            const cursor = remoteCursors[data.userId];
            const bounds = quill.getBounds(data.position);
            const editorRect = document.getElementById('editor-container').getBoundingClientRect();
            
            if (bounds) {
                cursor.style.left = `${bounds.left + editorRect.left + window.scrollX}px`;
                cursor.style.top = `${bounds.top + editorRect.top + window.scrollY}px`;
                cursor.style.display = 'block';
                cursor.style.height = `${bounds.height}px`;
            } else {
                cursor.style.display = 'none'; 
            }
        }

        // ==========================================
        // 4. VERSION HISTORY UI & INTERACTION
        // ==========================================
        function toggleVersionPanel() {
            document.getElementById('version-sidebar').classList.toggle('open');
            if (document.getElementById('version-sidebar').classList.contains('open')) {
                loadVersionHistory();
            }
        }

        async function loadVersionHistory() {
            const listEl = document.getElementById('version-list');
            listEl.innerHTML = '<p class="text-center text-gray-400 mt-4">Memuat...</p>';
            try {
                const res = await fetch(`/documents/${APP_CONFIG.documentId}/versions`);
                const versions = await res.json();
                listEl.innerHTML = '';
                if (!versions.length) {
                    listEl.innerHTML = '<p class="text-center text-gray-400">Belum ada revisi.</p>';
                    return;
                }
                versions.forEach(v => {
                    const item = document.createElement('div');
                    item.className = 'version-item p-3 bg-white border-l-4 border-transparent rounded shadow-sm';
                    item.innerHTML = `
                        <div class="font-medium text-sm text-gray-800">${v.change_summary}</div>
                        <div class="text-xs text-gray-500 mt-1">${new Date(v.created_at).toLocaleString('id-ID')}</div>
                    `;
                    item.onclick = () => restoreVersion(v.id);
                    listEl.appendChild(item);
                });
            } catch (err) {
                listEl.innerHTML = '<p class="text-center text-red-600 mt-4">Gagal memuat riwayat.</p>';
                console.error('Load versions error:', err);
            }
        }
        async function restoreVersion(versionId) {
            if (!confirm('Kembalikan ke versi ini? Perubahan yang belum tersimpan akan ditimpa.')) return;
            try {
                await fetch(`/documents/${APP_CONFIG.documentId}/versions/${versionId}/restore`, {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': APP_CONFIG.csrfToken }
                });
                location.reload();
            } catch (err) {
                alert('Gagal memulihkan versi.');
            }
        }

        // ==========================================
        // HELPER & REAL-TIME CONNECTION SETUP
        // ==========================================
        function updateSyncStatus(message, colorClass) {
            const el = document.getElementById('sync-status');
            el.textContent = `● ${message}`;
            el.className = `text-xs font-medium ${colorClass}`;
        }

        function registerActiveUser(id, name, color) {
            const container = document.getElementById('active-users-list');
            if (!container.querySelector(`[data-uid="${id}"]`)) {
                const badge = document.createElement('div');
                badge.className = 'user-badge';
                badge.dataset.uid = id;
                badge.style.backgroundColor = color;
                badge.textContent = name;
                container.appendChild(badge);
            }
        }

        // Inisialisasi WebSocket (Laravel Reverb / Pusher)
        const pusher = new Pusher(APP_CONFIG.pusherKey, {
            cluster: 'mt1',
            wsHost: window.location.hostname,
            wsPort: 6001,
            wssPort: 6001,
            forceTLS: (location.protocol === 'https:'),
            enabledTransports: ['ws', 'wss']
        });

        const channel = pusher.subscribe(`document.${APP_CONFIG.documentId}`);
        channel.bind('document.updated', handleRemoteDocumentUpdate);
        channel.bind('cursor.moved', updateRemoteCursor);

        // Heartbeat untuk menjaga session aktif
        setInterval(() => {
            fetch(`/documents/${APP_CONFIG.documentId}/heartbeat`, { 
                method: 'POST', 
                headers: { 'X-CSRF-TOKEN': APP_CONFIG.csrfToken } 
            }).catch(() => {});
        }, 30000);
    </script>
</body>
</html>



