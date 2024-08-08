<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to {{ config('app.name') }}</title>
</head>

<body>
    <div style="font-family: Arial, sans-serif; max-width: 600px; margin: 0 auto; padding: 20px;">
        <h1 style="color: #4CAF50;">{{ $user->name }}, Welcome to {{ config('app.name') }}!</h1>
        <p>
            Congratulations! You've successfully joined {{ config('app.name') }} community. Get ready to explore a world of exciting features designed just for you. Whether you're here to share your thoughts, connect with like-minded individuals, or simply explore, we've got you covered.
        </p>
        <p>
            Here are some key features waiting for you:
        </p>
        <ul>
            <li>Share your thoughts and ideas with the community</li>
            <li>Connect with friends and followers</li>
            <li>Explore trending topics and discussions</li>
            <li>Participate in engaging conversations</li>
            <li>Customize your profile and settings</li>
        </ul>
        <p>
            If you have any questions or need assistance, our dedicated support team is here to help. Feel free to reach out to us at <a href="mailto:vaslovikneven@gmail.com">vaslovikneven@gmail.com</a>.
        </p>
        <hr>
        <p>
            To get started, simply log in to your account by clicking the button below:
        </p>
        <p>
            <a href="{{ route('login') }}" style="display: inline-block; padding: 10px 20px; background-color: #4CAF50; color: white; text-decoration: none;">Log in</a>
        </p>
        <p>
            Best regards,<br>
            {{ config('app.name') }}
        </p>
    </div>
</body>

</html>
