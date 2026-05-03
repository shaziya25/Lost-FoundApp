/* ================= ROOT THEME ================= */
:root {
    --bg: #0f172a;
    --card: rgba(255,255,255,0.06);
    --border: rgba(255,255,255,0.08);
    --text: #e2e8f0;
    --muted: #94a3b8;

    --primary: #3b82f6;
    --success: #22c55e;
    --danger: #ef4444;
    --dark: #1f2937;
}

/* ================= GLOBAL ================= */
body {
    margin: 0;
    font-family: 'Segoe UI', sans-serif;
    background: linear-gradient(120deg, #0f172a, #020617);
    color: var(--text);
}

/* ================= HEADER ================= */
.header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 15px 25px;
    background: rgba(15,23,42,0.9);
    backdrop-filter: blur(12px);
    border-bottom: 1px solid var(--border);
}

.logo {
    font-size: 20px;
    font-weight: bold;
}

.nav {
    display: flex;
    gap: 20px;
}

.nav a {
    text-decoration: none;
    color: var(--muted);
    transition: 0.2s;
}

.nav a:hover {
    color: white;
}

/* Language */
.lang-switch a {
    color: var(--muted);
    margin-left: 10px;
    font-size: 14px;
}

.lang-switch a:hover {
    color: white;
}

/* ================= CONTAINER ================= */
.container {
    width: 90%;
    max-width: 1100px;
    margin: 30px auto;
}

/* ================= GRID ================= */
.grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
    gap: 20px;
}

/* ================= CARD ================= */
.card {
    background: var(--card);
    border: 1px solid var(--border);
    padding: 18px;
    border-radius: 16px;
    backdrop-filter: blur(12px);
    transition: 0.3s ease;
    box-shadow: 0 8px 25px rgba(0,0,0,0.3);
}

.card:hover {
    transform: translateY(-6px);
    box-shadow: 0 12px 35px rgba(0,0,0,0.4);
}

/* ================= BUTTONS ================= */
.actions {
    display: flex;
    gap: 10px;
    margin-top: 12px;
}

.btn {
    flex: 1;
    padding: 12px;
    border-radius: 10px;
    text-align: center;
    text-decoration: none;
    font-weight: 600;
    font-size: 14px;
    color: white;
    border: none;
    cursor: pointer;
    transition: 0.2s;
}

.btn:hover {
    transform: translateY(-2px);
    opacity: 0.9;
}

/* COLORS */
.green { background: var(--success); }
.red { background: var(--danger); }
.dark { background: var(--dark); }
.blue { background: var(--primary); }
.gray { background: #64748b; }
.cyan { background: #06b6d4; }

/* ================= NOTICE ================= */
.notice {
    background: rgba(234,179,8,0.15);
    padding: 12px;
    border-radius: 10px;
    margin-bottom: 20px;
}

/* ================= ITEM ================= */
.item-card img {
    width: 100%;
    height: 170px;
    object-fit: cover;
    border-radius: 10px;
    margin-bottom: 10px;
}

/* BADGES */
.badge {
    padding: 4px 8px;
    border-radius: 6px;
    font-size: 12px;
    font-weight: bold;
}

.lost { background: var(--danger); }
.found { background: var(--success); }

.high {
    color: #f87171;
    font-weight: bold;
}

/* ================= CHAT ================= */
.chat-container {
    max-width: 800px;
    margin: auto;
    height: 75vh;
    display: flex;
    flex-direction: column;
    background: var(--card);
    border-radius: 15px;
    overflow: hidden;
}

/* TOP BAR */
.chat-top {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 12px;
    background: rgba(0,0,0,0.4);
}

.avatar {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    background: var(--primary);
    display: flex;
    align-items: center;
    justify-content: center;
}

/* MESSAGES */
.chat-messages {
    flex: 1;
    overflow-y: auto;
    padding: 15px;
}

/* MESSAGE */
.msg {
    max-width: 65%;
    padding: 10px;
    margin: 6px;
    border-radius: 12px;
}

.me {
    background: var(--primary);
    margin-left: auto;
}

.other {
    background: #e5e7eb;
    color: black;
}

/* INPUT */
.chat-input {
    display: flex;
    padding: 10px;
    background: rgba(0,0,0,0.2);
}

.chat-input input {
    flex: 1;
    padding: 10px;
    border-radius: 20px;
    border: none;
}

.chat-input button {
    margin-left: 10px;
    border-radius: 50%;
    width: 45px;
    background: var(--primary);
    color: white;
}

/* ================= CALL MODAL ================= */
.call-modal {
    display: none;
    position: fixed;
    inset: 0;
    background: rgba(0,0,0,0.8);
}

.call-screen {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%,-50%);
    text-align: center;
}

.end-btn {
    background: var(--danger);
    padding: 12px 20px;
    border-radius: 50px;
    border: none;
    color: white;
}

/* ================= CHAT LIST ================= */
.chat-list {
    display: flex;
    flex-direction: column;
    gap: 10px;
}

.chat-card {
    display: flex;
    align-items: center;
    padding: 12px;
    border-radius: 12px;
    background: var(--card);
    text-decoration: none;
    color: white;
    transition: 0.2s;
}

.chat-card:hover {
    background: rgba(255,255,255,0.1);
}

.chat-info {
    margin-left: 10px;
}

.name {
    font-weight: bold;
}

.time {
    font-size: 12px;
    color: var(--muted);
}

/* ================= MOBILE ================= */
@media(max-width: 768px) {

    .header {
        flex-direction: column;
        gap: 10px;
    }

    .nav {
        flex-wrap: wrap;
        justify-content: center;
    }

    .grid {
        grid-template-columns: 1fr;
    }

    .chat-container {
        height: 80vh;
    }

    .chat-input {
        flex-direction: column;
    }

    .chat-input button {
        width: 100%;
        margin-top: 8px;
    }
}
body {
    display: flex;
    flex-direction: column;
    min-height: 100vh;
}

.container {
    flex: 1;
}

.footer {
    margin-top: auto;
}
.item-card {
    background: rgba(255,255,255,0.08);
    border: 1px solid rgba(255,255,255,0.1);
    border-radius: 18px;
    padding: 15px;
    transition: 0.3s;
}

.item-card:hover {
    transform: translateY(-6px);
    box-shadow: 0 10px 25px rgba(0,0,0,0.3);
}

.item-card h3 {
    margin: 10px 0 5px;
    font-size: 18px;
}

.item-card p {
    font-size: 14px;
    opacity: 0.85;
}

.actions {
    margin-top: 12px;
    display: flex;
    gap: 10px;
}
.time {
    font-size: 11px;
    opacity: 0.7;
    margin-top: 4px;
    text-align: right;
}
.chat-messages {
    scroll-behavior: smooth;
}
.container {
    padding: 0 10px;
}
form {
    display: flex;
    flex-direction: column;
    gap: 10px;
}

input, textarea, select {
    background: #020617;
    color: white;
    border: 1px solid rgba(255,255,255,0.1);
}

input::placeholder {
    color: #94a3b8;
}
form input {
    width: 70%;
    display: inline-block;
}

form button {
    width: 25%;
}
.search-bar {
    display: flex;
    gap: 10px;
    margin-bottom: 20px;
}

.search-bar input {
    flex: 1;
    padding: 12px;
    border-radius: 10px;
    border: 1px solid var(--border);
    background: rgba(255,255,255,0.05);
    color: white;
}

.search-bar button {
    padding: 12px 20px;
    border-radius: 10px;
    background: var(--primary);
    border: none;
    color: white;
    font-weight: bold;
}
.form-card {
    max-width: 600px;
    margin: auto;
    background: var(--card);
    padding: 25px;
    border-radius: 18px;
}

.form-card label {
    margin-top: 10px;
    display: block;
    font-size: 14px;
    color: var(--muted);
}

.form-card input,
.form-card textarea,
.form-card select {
    width: 100%;
    padding: 12px;
    margin-top: 5px;
    border-radius: 10px;
    border: 1px solid var(--border);
    background: rgba(255,255,255,0.05);
    color: white;
}
@media(max-width: 500px){
    .search-bar {
        flex-direction: column;
    }

    .btn {
        font-size: 13px;
        padding: 10px;
    }
}
.item-title {
    font-size: 18px;
    font-weight: 600;
    margin: 10px 0;
}