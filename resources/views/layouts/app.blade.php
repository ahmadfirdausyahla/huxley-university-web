<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Huxley University - State College</title>
    
    <script src="https://cdn.tailwindcss.com"></script>
    
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'brand-blue': '#3B82F6',
                        'dark-bg': '#0f0f0f',
                    },
                    fontFamily: {
                        'serif': ['"Playfair Display"', 'serif'],
                        'sans': ['Inter', 'sans-serif'],
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-black text-white font-sans overflow-x-hidden">

    @include('components.navbar')

    <main>
        @yield('content')
    </main>

    @include('components.footer')

    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        // Initialize Animate On Scroll
        AOS.init({
            duration: 800,
            once: true,
            offset: 100,
        });
    </script>
</body>
</html>