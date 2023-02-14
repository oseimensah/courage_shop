<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="csrf-token" content="{{ csrf_token() }}">

		<title>@yield('title')</title>
        <link rel="shortcut icon" href="{{ asset('images/favicon/favicon.ico') }}" type="image/x-icon">

		<!-- Fonts -->
		<link rel="stylesheet" href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap">
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">

		<!-- Scripts -->
		@vite(['resources/css/app.css', 'resources/js/app.js'])
        @livewireStyles
        @include('partials.user.styles')
	</head>
	<body class="font-poppins antialiased">
		<div class="min-h-screen bg-gray-100 dark:bg-gray-900">
			<!-- Page Heading -->
			@if (isset($header))
			<header class="bg-white dark:bg-gray-800 shadow">
				<div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
					{{ $header }}
				</div>
			</header>
			@endif

			<!-- Page Content -->
			<main>
				{{ $slot }}
			</main>
		</div>
        @livewireScripts
        @include('partials.user.scripts')
	</body>
</html>
