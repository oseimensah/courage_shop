<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="csrf-token" content="{{ csrf_token() }}">

		<title>{{ config('app.name', 'Laravel') }}</title>
        <link rel="shortcut icon" href="{{ asset('images/favicon/favicon.ico') }}" type="image/x-icon">

		<!-- Fonts -->
		<link rel="stylesheet" href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap">
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
		<!-- Scripts -->
		@vite(['resources/css/app.css', 'resources/js/app.js'])
	</head>
	<body class="font-sans antialiased">
		<div class="min-h-screen bg-gray-100 dark:bg-gray-900 flex">
			@include('partials.admin.sidebar')
			<div class="w-full mx-auto p-3">
                <div class="h-full min-h-fit bg-gray-50 shadow-lg rounded-md">
                    @include('partials.admin.header')

                    <div class="max-w-[90rem] mx-auto px-4 sm:px-6 lg:px-8">
                        {{ $slot }}
                    </div>
                </div>
            </div>
		</div>
        @include('partials.admin.scripts')
	</body>
</html>
