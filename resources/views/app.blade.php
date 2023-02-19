<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta
        content="Supero Agrobase Limited is an indigenous company in Nigeria with deep understanding of the needs and challenges of Nigerian farmers. We deal with  Agro - Input products, claims, research and Promotion, Sales of Agro input Products (AgriCourt Ventures) and Production of Vegetable Crops (HarvestYield Farm)"
        name="description" />

    <meta
        content="irrigation cultivation husbandry horticulture crop biofuel farm animal husbandry farming cultivate agribusiness food domestication agricultural manure  tillage monoculture forestry livestock harvest agronomy pesticide cotton wheat crop rotation dairy aquaculture sow overcrop education raw material genetically modified organism selective breeding climate plow farmer plant fertilize fiber grow fertile crescent"
        name="keywords" />
    <title inertia>{{ config('app.name', 'SuperoAgrobase Ltd') }}</title>
    <link href="{{ asset('favicon.png') }}" rel="icon" />
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet" />
    <!-- Scripts -->
    <style>
        body {
            font-family: "Poppins", sans-serif !important;
            overflow-x: hidden;
        }

        body::-webkit-scrollbar {
            width: 13px;
        }

        body::-webkit-scrollbar-track {
            box-shadow: inset 0 0 5px grey;
            border-radius: 5px;
        }

        body::-webkit-scrollbar-thumb {
            background: #28c76f;
            border-radius: 5px;
        }

        button:disabled,
        button[disabled] {
            border: 1px solid #d8d8d8 !important;
            background: #d8d8d8 !important;
            color: #666666 !important;
        }
    </style>
    @routes
    {{-- @vite(['resources/js/app.js']) --}}
    @vite(['resources/js/app.js', "resources/js/Pages/{$page['component']}.vue"])
    @inertiaHead
</head>

<body class="font-sans antialiased">
    @inertia
</body>

</html>
