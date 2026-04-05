<!DOCTYPE html>

<html class="light" lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Admin Login | Academic Curator</title>

<link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;600;700;800&family=Inter:wght@400;500;600&display=swap" rel="stylesheet" />
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet" />

<script src="https://cdn.tailwindcss.com"></script>


</head>

<body class="font-body bg-gray-100 flex items-center justify-center min-h-screen">


<main class="w-full max-w-[900px] flex bg-white rounded-lg shadow-lg overflow-hidden">

    <!-- LEFT -->
    <div class="bg-blue-900 text-white p-10 w-1/2 flex flex-col justify-center">
        <h1 class="text-3xl font-bold mb-4">Institutional Control Center</h1>
        <p>Access the administrative core.</p>
    </div>

    <!-- RIGHT -->
    <div class="p-10 w-1/2">

        <h2 class="text-2xl font-bold mb-4">Admin Login</h2>

        <!-- ERRORS -->
        @if ($errors->any())
            <div class="bg-red-100 text-red-700 p-3 rounded mb-4">
                @foreach ($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif

        <!-- FORM -->
        <form action="{{ route('admin.login.submit') }}" method="POST" class="space-y-4">
            @csrf

            <!-- EMAIL -->
            <div>
                <label>Email</label>
                <input 
                    type="email" 
                    name="email" 
                    value="{{ old('email') }}"
                    class="w-full border p-2 rounded"
                    required>
            </div>

            <!-- PASSWORD -->
            <div>
                <label>Password</label>
                <input 
                    type="password" 
                    name="password"
                    class="w-full border p-2 rounded"
                    required>
            </div>

            <!-- REMEMBER -->
            <div class="flex items-center">
                <input type="checkbox" name="remember">
                <label class="ml-2">Remember me</label>
            </div>

            <!-- BUTTON -->
            <button type="submit"
                class="w-full bg-blue-900 text-white py-2 rounded hover:bg-blue-700">
                Login
            </button>

        </form>

    </div>

</main>


</body>
</html>
