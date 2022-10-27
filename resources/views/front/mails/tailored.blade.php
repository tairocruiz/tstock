<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Tailor Made Safari Booking</title>
</head>
<body>
<div style="max-width: 800px; padding: 30px; border: 2px solid #cccccc; border-radius: 8px; margin: 15px auto">
    @if(!is_null($tour))
        <h1 style="text-align: center;">{{ 'Re: Tailored / Customizing '.$tour->name }}</h1>
    @else
        <h1 style="text-align: center;">{{ 'Re: Tailor-Made Safari Enquiry' }}</h1>
    @endif
    <hr style="margin-bottom: 15px;">
        Dear TakeMeToTanzania, <br><br>

        I'm {{ $data['full_name'] }} and I'm interested with Tanzania Safari of details below; <br>
        @if(!is_null($tour)) ( Customizing {{ $tour->name }} ) @endif <br><br>

        <table>
            <tr><td>Tourist Count</td><td>{{ $data['tourist_count'] }}</td></tr>
            <tr><td>Interested Destinations</td><td>{{ implode(',', $data['destinations']) }}</td></tr>
            @if(isset($data['other_destination'])) <tr><td>Added Destination</td><td>{{ $data['other_destination'] }}</td></tr> @endif
            <tr><td>Travel Dates</td><td>{{ $data['dates'] }}</td></tr>
            <tr><td>Hotels/Lodges</td><td>{{ $data['hotels'] }}</td></tr>
            <tr><td>Further Information</td><td>{{ $data['further_info'] }}</td></tr>
            <tr><td>How did you hear us?</td><td>{{ implode(',',$data['HowDidYouHearUs']) }}</td></tr>
            <tr><td>Tourist Full Name</td><td>{{ $data['full_name'] }}</td></tr>
            @if(isset($data['phone'])) <tr><td>Tourist Phone</td><td>{{ $data['phone'] }}</td></tr> @endif
            <tr><td>Tourist Email</td><td>{{ $data['email'] }}</td></tr>
        </table>
        <br><br>

        Please give more details! <br><br><br>

        Best Regards <br>
        <a href="mailto:{{ $data['email'] }}">{{ $data['full_name'] }}</a><br>
        @if(isset($data['phone'])) {{ $data['phone'] }} @endif
</div>
</body>
</html>