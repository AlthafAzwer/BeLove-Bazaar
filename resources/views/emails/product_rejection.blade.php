<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <!-- resources/views/emails/product_rejection.blade.php -->

<h1>Your Product Listing Has Been Rejected</h1>
<p>Unfortunately, your product titled "{{ $product->title }}" has been rejected.</p>
<p>Reason: {{ $reason }}</p>
<p>You can edit and resubmit your listing for review.</p>

</body>
</html>