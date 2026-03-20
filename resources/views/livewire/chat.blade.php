<div>
      <style>
        .chat-app {
            display: flex;
            height: 75vh;
            overflow: hidden;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        }

        /* Sidebar Styles */
        .sidebar {
            width: 30%;
            background-color: #f8f9fa;
            border-right: 1px solid #e9ecef;
            display: flex;
            flex-direction: column;
            min-width: 300px;
        }

        .sidebar-header {
            padding: 15px;
            border-bottom: 1px solid #e9ecef;
        }

        #searchInputWrapper {
            position: relative;
            margin-top: 10px;
        }

        #searchInput {
            padding: 8px 15px 8px 35px;
            border: 1px solid #e9ecef;
            border-radius: 20px;
            background: #fff;
            width: 100%;
        }

        #searchIcon {
            position: absolute;
            top: 50%;
            left: 12px;
            transform: translateY(-50%);
            color: #6c757d;
        }

        .chat-list {
            flex: 1;
            overflow-y: auto;
            padding: 0;
            margin: 0;
            list-style: none;
        }

        .chat-item {
            padding: 12px 15px;
            border-bottom: 1px solid #e9ecef;
            cursor: pointer;
            transition: background-color 0.2s;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .chat-item:hover {
            background-color: #e9ecef;
        }

        .chat-item.active {
            background-color: #e9ecef;
        }

        .chat-item img {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            object-fit: cover;
        }

        .chat-info {
            flex: 1;
            min-width: 0;
        }

        .chat-info small {
            color: #6c757d;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        /* Chat Area Styles */
        .chat-area {
            flex: 1;
            display: flex;
            flex-direction: column;
            background-color: #f1f1f1;
        }

        .chat-header {
            padding: 15px;
            background-color: #fff;
            border-bottom: 1px solid #e9ecef;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .chat-header img {
            width: 45px;
            height: 45px;
            border-radius: 50%;
            object-fit: cover;
        }

        .chat-body {
            flex: 1;
            padding: 15px;
            overflow-y: auto;
            background-color: #e5ddd5;
            background-image: url('https://web.whatsapp.com/img/bg-chat-tile-light_a4be512e7195b6b733d9110b408f075d.png');
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        #chatBody {
            flex: 1;
            /* takes all available vertical space */
            overflow-y: auto;
            /* enables vertical scrolling */
            padding: 15px;
            display: flex;
            flex-direction: column;
            gap: 10px;
            /* scroll-behavior: smooth; */
            /* smooth scrolling */
        }


        .message-container {
            display: flex;
            flex-direction: column;
        }

        .message-container.sent {
            align-items: flex-end;
        }

        .message-container.received {
            align-items: flex-start;
        }

        .message-bubble {
            max-width: 70%;
            padding: 8px 12px;
            border-radius: 18px;
            margin-bottom: 5px;
            word-wrap: break-word;
        }

        .sent .message-bubble {
            background-color: #dcf8c6;
            border-top-right-radius: 0;
        }

        .received .message-bubble {
            background-color: #fff;
            border-top-left-radius: 0;
        }

        .message-time {
            font-size: 11px;
            color: #666;
            margin-top: 3px;
        }

        .chat-input {
            padding: 10px 15px;
            background-color: #f0f2f5;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .chat-input input {
            flex: 1;
            padding: 10px 15px;
            border-radius: 20px;
            border: none;
            outline: none;
        }

        .chat-input button {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            border: none;
            background-color: #128c7e;
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
        }

        /* Custom Scrollbar */
        ::-webkit-scrollbar {
            width: 6px;
        }

        ::-webkit-scrollbar-track {
            background: #f1f1f1;
        }

        ::-webkit-scrollbar-thumb {
            background: #888;
            border-radius: 3px;
        }

        /* Empty State */
        .empty-chat {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100%;
            color: #6c757d;
        }

        .empty-chat img {
            width: 150px;
            opacity: 0.5;
            margin-bottom: 15px;
        }
    </style>
    <div class="container-fluid py-3" style="height: 100vh; max-height: 100vh;">
        <div class="chat-app"
            style="display:flex; height: 80vh; border: 1px solid #ddd; border-radius: 5px; overflow: hidden;">


            <!-- Sidebar -->
            <div class="sidebar"
                style="width: 320px; border-right: 1px solid #ddd; display:flex; flex-direction: column;">
                <div class="sidebar-header p-3 border-bottom" style="background: #f8f9fa;">
                    <h5 class="mb-2">Chats</h5>
                    <div id="searchInputWrapper" style="position: relative;">
                        <i id="searchIcon" class="fa fa-search"
                            style="position: absolute; top: 50%; left: 8px; transform: translateY(-50%); color: #aaa;"></i>
                        <input type="text" id="searchInput" placeholder="Search conversations..."
                            style="padding-left: 30px; width: 100%; border-radius: 4px; border: 1px solid #ccc;">
                    </div>
                </div>

                <ul class="chat-list list-unstyled flex-grow-1 overflow-auto m-0 p-0" id="chatUserList"
                    style="background: #fff;"></ul>
            </div>

            <!-- Chat Area -->
            <div class="chat-area flex-grow-1 d-flex flex-column" style="background: #fff;">
                <div class="empty-chat d-flex flex-column align-items-center justify-content-center text-center p-4"
                    id="emptyChatState" style="flex-grow:1;">
                    <img src="{{ asset('assets/img/logos/GFEPLUSE.png') }}" alt="Start chat"
                        style="max-width: 150px; margin-bottom: 15px;">
                    <h5>No chat selected</h5>
                    <p>Select a conversation to start messaging</p>
                </div>

                <div id="activeChat" style="display: none; flex-direction: column; height: 100%;">
                    <div class="chat-header d-flex align-items-center border-bottom p-3" style="background: #f1f1f1;">
                        <img id="chatPartnerAvatar" src="https://via.placeholder.com/45" alt="User"
                            class="rounded-circle"
                            style="width:45px; height:45px; object-fit:cover; margin-right: 15px;">
                        <div>
                            <h6 class="mb-0" id="chatPartnerName"></h6>
                            <small class="text-success">Online</small>
                        </div>
                    </div>
                    <div class="chat-body overflow-auto p-3" id="chatBody" style="flex-grow: 1; background: #fafafa;">
                        <!-- Messages go here -->
                    </div>
                    <div class="chat-input d-flex border-top p-3">
                        <input type="text" id="newMessageInput" placeholder="Type a message..."
                            style="flex-grow:1; padding: 8px 12px; border-radius: 4px; border: 1px solid #ccc;">
                        <button id="sendMessageBtn" class="btn btn-primary ms-2" title="Send message">
                            <i class="fa fa-paper-plane"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            fetchChatUserList();
        });

        function fetchChatUserList() {
            fetch("https://bita.gfebusiness.org/erp/api/sales/ops_recent_get_chat.php")
                .then(response => response.json())
                .then(data => {
                    const chatList = document.getElementById("chatUserList");
                    chatList.innerHTML = "";

                    if (Array.isArray(data) && data.length > 0) {
                        data.forEach(user => {
                            const listItem = document.createElement("li");
                            listItem.classList.add("p-3", "border-bottom", "chat-user-item");
                            listItem.style.cursor = "pointer";

                            listItem.innerHTML = `
                            <div class="d-flex align-items-center">
                                <img src="${user.avatar || 'https://via.placeholder.com/40'}" alt="User" class="rounded-circle me-2" style="width:40px; height:40px; object-fit:cover;">
                                <div>
                                    <div class="fw-bold">${user.name || 'Unknown'}</div>
                                    <small class="text-muted">${user.last_message || ''}</small>
                                </div>
                            </div>
                        `;

                            // Optionally handle user click to open chat
                            listItem.addEventListener("click", function() {
                                openChat(user); // you can define this function
                            });

                            chatList.appendChild(listItem);
                        });
                    } else {
                        chatList.innerHTML = `<li class="p-3 text-center text-muted">No conversations found</li>`;
                    }
                })
                .catch(error => {
                    console.error("Error fetching chat user list:", error);
                    document.getElementById("chatUserList").innerHTML =
                        `<li class="p-3 text-danger text-center">Error loading chats</li>`;
                });
        }

        // Optional function if you want to handle chat opening
        function openChat(user) {
            document.getElementById("emptyChatState").style.display = "none";
            const activeChat = document.getElementById("activeChat");
            activeChat.style.display = "flex";

            document.getElementById("chatPartnerName").innerText = user.name || 'Unknown';
            document.getElementById("chatPartnerAvatar").src = user.avatar || 'https://via.placeholder.com/45';
            // You can also load messages here based on user ID if needed.
        }
    </script>
</div>
