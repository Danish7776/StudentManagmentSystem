<style>
    body {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        margin: 0;
        background-color: #f0f2f5;
        font-family: Arial, sans-serif;
    }

    .welcome-container {
        background-color: #fff;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        width: 100%;
        max-width: 400px;
        text-align: center;
        position: relative;
    }

    .welcome-container h2 {
        color: #333;
        margin-bottom: 20px;
    }

    .logout-button {
        position: absolute;
        top: 10px;
        right: 10px;
        background-color: #dc3545;
        color: #fff;
        border: none;
        padding: 10px 15px;
        border-radius: 5px;
        cursor: pointer;
    }

    .logout-button:hover {
        background-color: #c82333;
    }
</style>
 <div class="welcome-container">
    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-inline">
        @csrf
        <button type="submit" class="logout-button">Logout</button>
    </form>
    <h2>Hello, {{ $name }}</h2>
</div>