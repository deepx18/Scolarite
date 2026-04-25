<!-- Header Section -->
<header class="flex justify-between items-end mb-12">
    <div>
        <nav class="flex items-center gap-2 text-xs font-bold text-slate-400 mb-2 uppercase tracking-widest">
            <span>{{ __('admin.breadcrumb.admin') }}</span>
            <span class="material-symbols-outlined text-[10px]">chevron_right</span>
            <span class="text-primary">{{ __('admin.all_requests') }}</span>
        </nav>
        <h1 class="text-4xl font-extrabold tracking-tight text-on-surface">{{ __('admin.administrative_requests') }}</h1>
        <p class="text-on-surface-variant mt-2 max-w-md">{{ __('admin.administrative_requests_description') }}</p>
    </div>
    <div class="flex gap-4">
        <div class="relative">
            <button id="requestersButton" type="button" class="flex -space-x-2 items-center"
                onclick="toggleRequestersMenu(event)">
                <img alt="Team avatar" class="w-10 h-10 rounded-full border-2 border-surface"
                    src="https://lh3.googleusercontent.com/aida-public/AB6AXuAnTrhL5qScPv8NFiVbpu1GYuE8clclF6zoJNPrtV0aUpsYP627wVzbAsH7DNmmDBMhdax-CsP8AQe51uTo3UZ0ZGLhVSP51QJYoOU44HTvqzzO9hCV4HFlcOMqvFjTAxpUXbbr9sr3rjPA8be6UUgPpaPjt6kJdLcFExDRkFJFeiW8fXfxhIeEil51ZU3dB2ByGjLJBkG8zR8J-7jxmMvdkv10gyP6GSrICsD_Q6YRm1HuzX5hzf8MWab6o5c4c7BnfVzyROlpIpA" />
                <img alt="Team avatar" class="w-10 h-10 rounded-full border-2 border-surface"
                    src="https://lh3.googleusercontent.com/aida-public/AB6AXuDA4HL3FlwCxa38bejdxq8UW4EN_6_gQP2sVd33xGG8qNfxKBipLv6yq7Q3NGb4t58dwWH8AE1j-yK1r4_1kbr4-I5wpmn-BCXkdC-yeYgEgMOkDty0yq1-kydprotNxWrP0cIm9I0NWn4sBadObXyJAFSFUMEbAXcibALlAKcuFtBusuZTPXfrdHA6Vop9u9kJQaZkOKW90y8kR-I46Hmn96f6WE2DdPDZjofNy3HBZDRtoEdiQCjYZiAgNrYo6JSel9lnD-exa10" />
                <div
                    class="w-10 h-10 rounded-full border-2 border-surface bg-surface-container-highest flex items-center justify-center text-xs font-bold text-on-surface-variant">
                    +4</div>
            </button>

            <div id="requestersMenu"
                class="hidden absolute right-0 mt-2 w-72 max-h-64 overflow-auto rounded-2xl bg-white border border-slate-200 shadow-xl z-50">
                <div class="p-3 text-sm text-slate-500">Recent requesters</div>
                <div id="requestersList" class="divide-y divide-slate-100"></div>
                <div id="requestersFooter" class="p-2 text-center text-xs text-slate-400"></div>
            </div>
        </div>
    </div>

    <script>
        let requestersLoaded = false;

        function toggleRequestersMenu(event) {
            event.stopPropagation();
            const menu = document.getElementById('requestersMenu');
            if (!requestersLoaded) {
                loadRequesters();
            }
            menu.classList.toggle('hidden');
        }

        async function loadRequesters() {
            try {
                const url = "{{ route('admin.recentRequesters') }}";
                const res = await fetch(url, { credentials: 'same-origin' });
                if (!res.ok) throw new Error('Network error');
                const json = await res.json();
                const list = document.getElementById('requestersList');
                list.innerHTML = '';
                if (json.data && json.data.length) {
                    json.data.forEach(function (s) {
                        const a = document.createElement('a');
                        a.href = s.profile_url;
                        a.className = 'flex items-center gap-3 px-3 py-2 hover:bg-slate-50 text-sm text-slate-700';
                        a.innerHTML = `<img src="${s.avatar}" alt="${s.name}" class="w-8 h-8 rounded-full object-cover" /> <div class=\"flex-1\"><div class=\"font-semibold text-slate-900\">${s.name}</div><div class=\"text-xs text-slate-500\">View profile</div></div>`;
                        list.appendChild(a);
                    });
                    document.getElementById('requestersFooter').textContent = '';
                } else {
                    document.getElementById('requestersFooter').textContent = 'No recent requesters';
                }
                requestersLoaded = true;
            } catch (e) {
                document.getElementById('requestersFooter').textContent = 'Unable to load requesters';
            }
        }

        document.addEventListener('click', function () {
            const menu = document.getElementById('requestersMenu');
            if (menu && !menu.classList.contains('hidden')) {
                menu.classList.add('hidden');
            }
        });
    </script>
</header>