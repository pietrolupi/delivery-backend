<div class="container">
    @if($userType === 'owner')
    <p>Hey there,</p>

    <p>I hope this message finds you in good spirits. This is Cheetboo from DeliveBoo, and I'm thrilled to inform you that we've received a new order from a valued customer.</p>

    <p><strong>Order Details:</strong></p>
    <ul>
        <li><strong>Customer Name:</strong> {{ $lead->name }}</li>
        <li><strong>Delivery Address:</strong> {{ $lead->address }}</li>
        <li><strong>Contact Phone:</strong> {{ $lead->phone }}</li>
        <li><strong>Contact Email:</strong> {{ $lead->email }}</li>

        @if($lead->message)
            <li><strong>Customer Message:</strong> {{ $lead->message }}</li>
        @endif

    </ul>

    <p>We value every order and appreciate the trust our customers place in us. Your commitment to delivering exceptional service aligns perfectly with our mission at DeliveBoo.</p>

    <p>To view more details and manage this order efficiently, please log in to your Dashboard on our website.</p>

    <p>Thank you for choosing DeliveBoo! If you have any questions or need assistance, feel free to reach out.</p>

    <p>Best regards,<br>
        Cheetboo from DeliveBoo</p>
    @else
    <p>Dear {{ $lead->name }},</p>

    <p>We hope this message finds you well. This is Cheetboo from DeliveBoo, and I'm excited to confirm that we've received your order and it's now being processed.</p>

    <p><strong>Your Details:</strong></p>
    <ul>
        <li><strong>Delivery Address:</strong> {{ $lead->address }}</li>
        <li><strong>Contact Phone:</strong> {{ $lead->phone }}</li>
        <li><strong>Contact Email:</strong> {{ $lead->email }}</li>

        @if($lead->message)
            <li><strong>Your Message:</strong> {{ $lead->message }}</li>
        @endif

    </ul>

    <p>Your satisfaction is our top priority, and we're working diligently to ensure your order is delivered promptly. You can expect updates on the status of your delivery in the coming moments.</p>

    <p>If you have any questions or special requests, feel free to reply to this email or contact our customer support at [Customer Support Email/Phone].</p>

    <p>Thank you for choosing DeliveBoo! We appreciate your business.</p>

    <p>Best regards,<br>
        Cheetboo from DeliveBoo</p>
    @endif
</div>
