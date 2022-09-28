<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Safari Booking</title>
</head>
<body>
    <div style="max-width: 800px; padding: 30px; border: 2px solid #cccccc; border-radius: 8px; margin: 15px auto">
        <h1 style="text-align: center;">{{ 'Re: Booking for '.$tour->name }}</h1>
        <hr style="margin-bottom: 15px;">
        <p style="font-size: 16px">
            Dear TakeMeToTanzania, <br><br>

            I'm {{ $data['name'] }} {{ '('.$data['country'].')' }} and I'm interested with the package subjected above <br><br>

            {{ $data['enquiry'] }} <br><br>

            Please give more details! <br><br><br>

            Best Regards <br>
            <a href="mailto:{{ $data['email'] }}">{{ $data['name'] }}</a>
        </p>
    </div>
</body>
</html>