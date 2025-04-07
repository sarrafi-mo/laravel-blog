<html>
<head>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">
    <div class="bg-white p-8 rounded-lg shadow-lg text-center max-w-md w-full">
        <h1 class="text-2xl font-bold text-gray-800 mb-4">{{ 'Welcome to ' . config('app.name', '') }}</h1>

        <p class="text-gray-600 mb-6">
            We're thrilled to have you join us! Please enter the verification code below to complete your registration.
        </p>

        <div class="bg-blue-50 p-4 rounded-lg">
            <span class="text-blue-600 font-bold text-3xl">{{ $code }}</span>
        </div>
    </div>
</body>
</html>