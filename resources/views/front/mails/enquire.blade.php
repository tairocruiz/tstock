<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Safari Enquiry</title>
</head>
<body>
<div style="max-width: 800px; padding: 30px; border: 2px solid #cccccc; border-radius: 8px; margin: 15px auto">
    @if(!is_null($tour))
        <h1 style="text-align: center;">{{ 'Re: Enquiring for '.$tour->name }}</h1>
    @endif
    <hr style="margin-bottom: 15px;">
    Dear TakeMeToTanzania, <br><br>

    I'm {{ $data['name'] }}, can you please give more details about the Tour below? <br><br>

    <table>
        <tr><td>Tour Name: </td><td>{{ $tour->name }}</td></tr>
        <tr><td>Tour Duration: </td><td>{{ $tour->days }} Days</td></tr>
        <tr><td>Expected Date: </td><td>{{ $data['date'] }}</td></tr>
        @if($tour->price) <tr><td>Tour Price: </td><td>US${{ number_format($tour->price) }}</td></tr> @endif
    </table>

    <br><br>
    <div>{{ $data['message'] }}</div>
    <br><br>

    Best Regards <br>
    <a href="mailto:{{ $data['email'] }}">{{ $data['email'] }}</a><br>
    @if(isset($data['phone'])) {{ $data['phone'] }} @endif
</div>
</body>
</html>