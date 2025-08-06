@props(['currentUser' => auth()->user()])

<div id="chatContainer" class="flex flex-col h-96 bg-white rounded-lg shadow-lg">
    <div class="flex-1 overflow-y-auto p-4" id="messagesContainer">
        <!-- Messages will be loaded here -->
    </div>
    
    <div class="border-t p-4">
        <div class="flex space-x-2">
            <input type="text" id="messageInput" placeholder="Type your message..." 
                   class="flex-1 rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500">
            <button id="sendButton" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                Send
            </button>
        </div>
    </div>
</div>

<script type="module">
import { initializeApp } from 'https://www.gstatic.com/firebasejs/10.7.1/firebase-app.js';
import { getDatabase, ref, push, onValue, serverTimestamp } from 'https://www.gstatic.com/firebasejs/10.7.1/firebase-database.js';
import { getAuth, signInWithCustomToken } from 'https://www.gstatic.com/firebasejs/10.7.1/firebase-auth.js';

class FirebaseChat {
    constructor() {
        this.currentUser = @json($currentUser);
        this.db = null;
        this.auth = null;
        this.messagesRef = null;
        this.init();
    }

    async init() {
        // Initialize Firebase
        const firebaseConfig = {
            apiKey: "{{ config('services.firebase.api_key') }}",
            authDomain: "{{ config('services.firebase.auth_domain') }}",
            databaseURL: "{{ config('services.firebase.database_url') }}",
            projectId: "{{ config('services.firebase.project_id') }}",
            storageBucket: "{{ config('services.firebase.storage_bucket') }}",
            messagingSenderId: "{{ config('services.firebase.messaging_sender_id') }}",
            appId: "{{ config('services.firebase.app_id') }}"
        };

        const app = initializeApp(firebaseConfig);
        this.db = getDatabase(app);
        this.auth = getAuth(app);

        await this.authenticateUser();
        this.setupChat();
        this.bindEvents();
    }

    async authenticateUser() {
        try {
            // Get custom token from Laravel backend
            const response = await fetch('/api/firebase/token', {
                headers: {
                    'Authorization': `Bearer {{ auth()->user()->createToken('firebase')->plainTextToken ?? '' }}`,
                    'Accept': 'application/json'
                }
            });
            
            const { token } = await response.json();
            await signInWithCustomToken(this.auth, token);
        } catch (error) {
            console.error('Firebase authentication failed:', error);
        }
    }

    setupChat() {
        // Setup messages reference for the current chat room
        const chatRoomId = this.getChatRoomId();
        this.messagesRef = ref(this.db, `chats/${chatRoomId}/messages`);
        
        // Listen for new messages
        onValue(this.messagesRef, (snapshot) => {
            this.renderMessages(snapshot.val());
        });
    }

    getChatRoomId() {
        // Generate chat room ID based on participants
        // For now, using a general room, but you can customize this
        return 'general';
    }

    renderMessages(messages) {
        const container = document.getElementById('messagesContainer');
        container.innerHTML = '';

        if (!messages) return;

        Object.entries(messages).forEach(([key, message]) => {
            const messageEl = this.createMessageElement(message);
            container.appendChild(messageEl);
        });

        container.scrollTop = container.scrollHeight;
    }

    createMessageElement(message) {
        const div = document.createElement('div');
        const isOwnMessage = message.userId === this.currentUser.id;
        
        div.className = `mb-4 ${isOwnMessage ? 'text-right' : 'text-left'}`;
        
        div.innerHTML = `
            <div class="inline-block max-w-xs lg:max-w-md px-4 py-2 rounded-lg ${
                isOwnMessage 
                    ? 'bg-blue-600 text-white' 
                    : 'bg-gray-200 text-gray-800'
            }">
                <div class="font-medium text-sm mb-1">${message.userName}</div>
                <div>${this.escapeHtml(message.text)}</div>
                <div class="text-xs opacity-75 mt-1">
                    ${new Date(message.timestamp).toLocaleTimeString()}
                </div>
            </div>
        `;
        
        return div;
    }

    async sendMessage(text) {
        if (!text.trim()) return;

        try {
            await push(this.messagesRef, {
                text: text.trim(),
                userId: this.currentUser.id,
                userName: this.currentUser.name,
                userRole: this.currentUser.role,
                timestamp: serverTimestamp()
            });
        } catch (error) {
            console.error('Failed to send message:', error);
        }
    }

    bindEvents() {
        const input = document.getElementById('messageInput');
        const button = document.getElementById('sendButton');

        button.addEventListener('click', () => {
            this.sendMessage(input.value);
            input.value = '';
        });

        input.addEventListener('keypress', (e) => {
            if (e.key === 'Enter') {
                this.sendMessage(input.value);
                input.value = '';
            }
        });
    }

    escapeHtml(text) {
        const div = document.createElement('div');
        div.textContent = text;
        return div.innerHTML;
    }
}

// Initialize chat when DOM is ready
document.addEventListener('DOMContentLoaded', () => {
    new FirebaseChat();
});
</script>