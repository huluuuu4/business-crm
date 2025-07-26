<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-gray-100">
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0">
        <div class="w-full sm:max-w-md mt-6 px-6 py-8 bg-white shadow-md overflow-hidden sm:rounded-lg">
            
            <h1 class="text-2xl font-bold text-center text-gray-800 mb-4">Contact Us</h1>
            <p class="text-center text-gray-600 mb-6">Interested in our software? Fill out the form below to get in touch.</p>

            @if(session('success'))
                <div class="mb-4 font-medium text-sm text-green-600 bg-green-100 p-3 rounded-lg">
                    {{ session('success') }}
                </div>
            @endif

            <form method="POST" action="{{ route('contact.store') }}">
                @csrf
                <div>
                    <label class="block font-medium text-sm text-gray-700" for="name">Name</label>
                    <input id="name" class="block mt-1 w-full border-gray-300 rounded-md shadow-sm" type="text" name="name" required autofocus />
                </div>
                <div class="mt-4">
                    <label class="block font-medium text-sm text-gray-700" for="email">Email</label>
                    <input id="email" class="block mt-1 w-full border-gray-300 rounded-md shadow-sm" type="email" name="email" required />
                </div>
                <div class="mt-4">
                    <label class="block font-medium text-sm text-gray-700" for="phone_number">Phone Number (Optional)</label>
                    <input id="phone_number" class="block mt-1 w-full border-gray-300 rounded-md shadow-sm" type="text" name="phone_number" />
                </div>
                <div class="mt-4">
                    <label class="block font-medium text-sm text-gray-700" for="message">Message</label>
                    <textarea id="message" name="message" rows="4" class="block mt-1 w-full border-gray-300 rounded-md shadow-sm" required></textarea>
                </div>

                <div class="flex items-center justify-end mt-4">
                    <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded-md">
                        Send Message
                    </button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>