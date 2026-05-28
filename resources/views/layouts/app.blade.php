<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'TruckRental') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-100">
        @include('layouts.navigation')

        @isset($header)
            <header class="bg-white shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
        @endisset

        <main>
            {{ $slot ?? '' }}
            @yield('content')
        </main>

        </main>

        <!-- Footer -->
        <footer class="bg-[#0f172a] text-gray-300 py-12 mt-16 border-t border-gray-800">
            <div class="container mx-auto px-4 max-w-7xl">
                <div class="grid md:grid-cols-2 gap-12">
                    <!-- Left: Company Info -->
                    <div>
                        <div class="flex items-center gap-2 text-white font-bold text-xl mb-6">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path d="M8 7h10l3 3v6h-1m-14 0H4V7h4m0 0v10m12 0a2 2 0 11-4 0m-8 0a2 2 0 11-4 0" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                            TruckRental
                        </div>
                        <div class="space-y-4">
                            <div class="flex items-start gap-3">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mt-0.5 flex-shrink-0 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                                <p class="text-sm leading-relaxed">
                                    Jatirangon, RT 010/002, Jatisampurna<br>
                                    Bekasi, Jawa Barat
                                </p>
                            </div>
                            <div class="flex items-center gap-3">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                </svg>
                                <p class="text-sm">+62 813-1513-1442</p>
                            </div>
                        </div>
                    </div>

                    <!-- Right: FAQ Accordion -->
                    <div>
                        <h3 class="text-white font-semibold text-lg mb-6">Pertanyaan Umum</h3>
                        <div class="space-y-4" id="faq-accordion">
                            <!-- FAQ Item 1 -->
                            <div class="border-b border-gray-700 pb-2">
                                <button class="faq-button flex justify-between items-center w-full text-left text-sm py-2 hover:text-white transition-colors">
                                    Apakah bisa kirim luar kota?
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 transition-transform duration-200" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                    </svg>
                                </button>
                                <div class="faq-content hidden text-sm text-gray-400 pb-3 leading-relaxed">
                                    Ya, kami melayani pengiriman ke seluruh indonesia dengan harga kompetitif.
                                </div>
                            </div>
                            
                            <!-- FAQ Item 2 -->
                            <div class="border-b border-gray-700 pb-2">
                                <button class="faq-button flex justify-between items-center w-full text-left text-sm py-2 hover:text-white transition-colors">
                                    Barang apa saja yang tidak boleh di kirim?
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 transition-transform duration-200" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                    </svg>
                                </button>
                                <div class="faq-content hidden text-sm text-gray-400 pb-3 leading-relaxed">
                                    Barang terlarang meliputi: narkoba, senjata api, bahan peledak, dan barang illegal lainnya.
                                </div>
                            </div>

                            <!-- FAQ Item 3 -->
                            <div class="border-b border-gray-700 pb-2">
                                <button class="faq-button flex justify-between items-center w-full text-left text-sm py-2 hover:text-white transition-colors">
                                    Bagaimana cara pembayaran?
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 transition-transform duration-200" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                    </svg>
                                </button>
                                <div class="faq-content hidden text-sm text-gray-400 pb-3 leading-relaxed">
                                    Kami menerima transfer bank, e-wallet, dan cash. Pembayaran 50% di awal, sisanya setelah barang sampai.
                                </div>
                            </div>

                            <!-- FAQ Item 4 -->
                            <div class="border-b border-gray-700 pb-2">
                                <button class="faq-button flex justify-between items-center w-full text-left text-sm py-2 hover:text-white transition-colors">
                                    Berapa lama estimasi pengiriman?
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 transition-transform duration-200" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                    </svg>
                                </button>
                                <div class="faq-content hidden text-sm text-gray-400 pb-3 leading-relaxed">
                                    Tergantung jarak. Dalam kota 1-2 hari, luar kota 3-7 hari tergantung tujuan.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="border-t border-gray-800 mt-12 pt-8 text-center text-sm text-gray-500">
                    &copy; 2026 TruckRental. Hak Cipta Dilindungi.
                </div>
            </div>
        </footer>

        <!-- AI Chat Widget -->
        <div class="fixed bottom-6 right-6 z-50 flex flex-col items-end gap-3">
            <div id="ai-chat-panel" class="hidden w-80 max-w-[90vw] rounded-3xl bg-slate-950/95 border border-slate-700 shadow-2xl overflow-hidden text-white">
                <div class="flex items-center justify-between gap-3 px-4 py-3 border-b border-slate-800 bg-slate-900">
                    <div class="flex items-center gap-3">
                        <div class="h-10 w-10 rounded-full bg-blue-500 grid place-items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z" />
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm font-semibold">Chat AI</p>
                            <p class="text-xs text-slate-400">Tanya tentang truk...</p>
                        </div>
                    </div>
                    <button id="ai-chat-close" class="text-slate-300 hover:text-white text-lg leading-none">×</button>
                </div>
                <div id="ai-chat-messages" class="h-56 overflow-y-auto px-4 py-3 space-y-3 text-sm bg-slate-950 text-slate-100">
                    <div class="rounded-2xl bg-slate-900 px-3 py-2 text-slate-200">Halo! Ada yang bisa saya bantu?</div>
                </div>
                <div class="border-t border-slate-800 bg-slate-900 px-4 py-3">
                    <div class="flex gap-2">
                        <input id="ai-chat-input" type="text" placeholder="Tulis pertanyaan tentang truk..." class="flex-1 rounded-full border border-slate-700 bg-slate-950 px-3 py-2 text-sm text-white focus:outline-none focus:ring-2 focus:ring-blue-500" />
                        <button id="ai-chat-send" class="rounded-full bg-blue-600 px-4 text-sm font-semibold text-white hover:bg-blue-500">Kirim</button>
                    </div>
                </div>
            </div>

            <button id="ai-chat-toggle" class="relative bg-blue-600 hover:bg-blue-700 text-white rounded-full p-4 shadow-lg transition-transform hover:scale-110 focus:outline-none focus:ring-2 focus:ring-blue-400" aria-label="Buka chat AI">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z" />
                </svg>
            </button>
        </div>
    </div>

    <!-- Script for FAQ Accordion -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const buttons = document.querySelectorAll('.faq-button');
            
            buttons.forEach(button => {
                button.addEventListener('click', () => {
                    const content = button.nextElementSibling;
                    const icon = button.querySelector('svg');
                    
                    // Close all other accordions (optional)
                    buttons.forEach(otherBtn => {
                        if (otherBtn !== button) {
                            otherBtn.nextElementSibling.classList.add('hidden');
                            otherBtn.querySelector('svg').style.transform = 'rotate(0deg)';
                        }
                    });

                    // Toggle current accordion
                    if (content.classList.contains('hidden')) {
                        content.classList.remove('hidden');
                        icon.style.transform = 'rotate(180deg)';
                    } else {
                        content.classList.add('hidden');
                        icon.style.transform = 'rotate(0deg)';
                    }
                });
            });
            
            const aiChatToggle = document.getElementById('ai-chat-toggle');
            const aiChatPanel = document.getElementById('ai-chat-panel');
            const aiChatClose = document.getElementById('ai-chat-close');
            const aiChatSend = document.getElementById('ai-chat-send');
            const aiChatInput = document.getElementById('ai-chat-input');
            const aiChatMessages = document.getElementById('ai-chat-messages');

            if (aiChatToggle && aiChatPanel) {
                aiChatToggle.addEventListener('click', () => {
                    aiChatPanel.classList.toggle('hidden');
                    aiChatInput.focus();
                });
            }

            if (aiChatClose) {
                aiChatClose.addEventListener('click', () => {
                    aiChatPanel.classList.add('hidden');
                });
            }

            async function sendAiMessage() {
                const message = aiChatInput.value.trim();
                if (!message) return;

                appendAiMessage(message, true);
                aiChatInput.value = '';

                try {
                    const response = await fetch('/api/chatbot', {
                        method: 'POST',
                        headers: {'Content-Type': 'application/json'},
                        body: JSON.stringify({ message })
                    });

                    const data = await response.json();
                    appendAiMessage(data.reply || 'Maaf, saya tidak dapat merespons saat ini.', false);
                } catch (error) {
                    appendAiMessage('Terjadi kesalahan. Silakan coba lagi.', false);
                }
            }

            function appendAiMessage(text, isUser) {
                const bubble = document.createElement('div');
                bubble.textContent = text;
                bubble.className = 'rounded-2xl px-3 py-2 max-w-[85%] break-words';
                if (isUser) {
                    bubble.classList.add('ml-auto', 'bg-blue-500', 'text-white');
                } else {
                    bubble.classList.add('bg-slate-800', 'text-slate-200');
                }
                aiChatMessages.appendChild(bubble);
                aiChatMessages.scrollTop = aiChatMessages.scrollHeight;
            }

            if (aiChatSend && aiChatInput) {
                aiChatSend.addEventListener('click', sendAiMessage);
                aiChatInput.addEventListener('keydown', event => {
                    if (event.key === 'Enter') {
                        event.preventDefault();
                        sendAiMessage();
                    }
                });
            }
        });
    </script>
    </div>
</body>
</html>