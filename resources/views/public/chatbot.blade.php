@extends('layouts.master')

@section('content')
<div class="container mx-auto p-4" style="padding-top: 9rem; padding-bottom: 5rem;">
    <h1 class="text-3xl font-bold text-center mb-6 text-gray-800">🌟 Emilia 🌟</h1>
    <p class="text-center text-gray-600 mb-6">Halo! Saya Emilia, asisten virtual Anda. Ada yang bisa saya bantu?</p>
    <!-- Opsi Mode -->
    <div class="flex justify-center mb-6">
        <a href="/chatbot">
            <button
                id="qna-button"
                class="px-4 py-2 bg-green-500 text-white rounded-l-lg hover:bg-green-600 focus:outline-none"
            >
                Tanya
            </button>
        </a>
        <a href="/chatbot/upload">
            <button
                id="document-button"
                class="px-4 py-2 bg-gray-500 text-white rounded-r-lg hover:bg-gray-700 focus:outline-none"
            >
                Dokumen
            </button>
        </a>
    </div>

    <!-- Chat Container -->
    <div id="chat-container" class="border p-4 rounded-lg shadow h-96 overflow-y-scroll bg-white">
        <!-- Animasi Loading -->
        <div id="loading-indicator" class="hidden text-center text-gray-500">
            <img src="/assets/emilia.jpg" alt="EmiliaProfile" class="w-12 h-12 rounded-full mx-auto mb-2">
            <span class="animate-pulse">Emilia sedang mengetik...</span>
        </div>
    </div>

    <!-- Chat Input -->
    <form action="/chatbot" method="POST" enctype="json" id="chat-form" class="mt-4 flex" autocomplete="off">
        <input
            type="text"
            id="chat-input"
            placeholder="Ketik pesan Anda..."
            class="flex-grow p-2 border border-gray-300 rounded-l-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
            autocomplete="off"
        />
        <button
            type="submit"
            class="px-4 py-2 bg-blue-600 text-white rounded-r-lg hover:bg-blue-700 focus:outline-none"
        >
            Kirim
        </button>
    </form>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const chatContainer = document.getElementById('chat-container');
        const chatForm = document.getElementById('chat-form');
        const chatInput = document.getElementById('chat-input');
        const loadingIndicator = document.getElementById('loading-indicator');

        const userName = "User";
        const botName = "Emilia";

        let isLoadingMessageVisible = false;

        function appendMessage(sender, content, isUser = false) {
            const messageWrapper = document.createElement('div');
            messageWrapper.classList.add('mb-4', 'flex', isUser ? 'justify-end' : 'justify-start', 'items-start');

            // Profil Picture
            if (!isUser) {
                const profileImage = document.createElement('img');
                profileImage.src = "/assets/emilia.jpg";
                profileImage.alt = `EmiliaProfile`;
                profileImage.classList.add('w-12', 'h-12', 'rounded-full', 'mr-2');
                messageWrapper.appendChild(profileImage);
            }

            const messageElement = document.createElement('div');
            messageElement.classList.add('rounded-lg', 'text-sm', 'max-w-full', 'w-auto', 'p-3', 'leading-relaxed');

            if (isUser) {
                messageElement.classList.add('bg-gray-200', 'text-black', 'shadow-md', 'p-3');
            } else {
                messageElement.classList.add('bg-white', 'text-black', 'ml-2');
            }

            if (!isUser) {
                const senderName = document.createElement('div');
                senderName.classList.add('font-bold', 'mb-1');
                senderName.textContent = sender;
                messageElement.appendChild(senderName);
            }

            const messageText = document.createElement('div');
            messageText.textContent = content;

            messageElement.appendChild(messageText);
            messageWrapper.appendChild(messageElement);

            chatContainer.appendChild(messageWrapper);
            chatContainer.scrollTop = chatContainer.scrollHeight;
        }

        function showLoadingIndicator() {
            if (isLoadingMessageVisible) return;

            const loadingWrapper = document.createElement('div');
            loadingWrapper.id = 'loading-message';
            loadingWrapper.classList.add('mb-4', 'flex', 'justify-start', 'items-start');

            const profileImage = document.createElement('img');
            profileImage.src = "/assets/emilia.jpg";
            profileImage.alt = `EmiliaProfile`;
            profileImage.classList.add('w-12', 'h-12', 'rounded-full', 'mr-2');

            const loadingText = document.createElement('div');
            loadingText.classList.add(
                'rounded-lg',
                'text-sm',
                'max-w-full',
                'w-auto',
                'p-3',
                'leading-relaxed',
                'text-gray-800',
                'italic',
                'animate-pulse'
            );
            loadingText.textContent = 'Emilia is typing...';

            loadingWrapper.appendChild(profileImage);
            loadingWrapper.appendChild(loadingText);

            chatContainer.appendChild(loadingWrapper);
            chatContainer.scrollTop = chatContainer.scrollHeight;

            isLoadingMessageVisible = true;
        }

        function hideLoadingIndicator() {
            const loadingMessage = document.getElementById('loading-message');
            if (loadingMessage) {
                loadingMessage.remove();
                isLoadingMessageVisible = false;
            }
        }

        // Handle form submission
        chatForm.addEventListener('submit', async function (e) {
            e.preventDefault();
            const userMessage = chatInput.value.trim();
            if (userMessage === '') return;

            appendMessage(userName, userMessage, true);

            chatInput.value = '';

            showLoadingIndicator();

            try {
                const response = await fetch('/chatbot', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    },
                    body: JSON.stringify({ question: userMessage }),
                });

                const result = await response.json();
                const botMessage = result.answer;

                hideLoadingIndicator();

                appendMessage(botName, botMessage);
            } catch (error) {
                hideLoadingIndicator();
                appendMessage(botName, 'Maaf, terjadi kesalahan saat menghubungi server.');
                console.error(error);
            }
        });
    });
</script>
@endsection
