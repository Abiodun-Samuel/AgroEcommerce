<x-mail::message>
# Hurray!!!

<p> {{ $orderData['name'] }}, just placed an order. Please check the order and process it.</p>

<p>
<x-mail::button :url="'mailto:'.$orderData['email']">
 Reply
</x-mail::button>

<x-mail::button :url="$orderData['url']">
 View Order
</x-mail::button>
</p>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
