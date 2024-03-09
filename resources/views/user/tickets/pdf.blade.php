<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Ticket</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .ticket {
            display: flex;
            background: white;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
        }

        .left,
        .right {
            flex: 1;
            padding: 20px;
        }

        .left {
            background-image: url("{{ asset('images/' . $event->image) }}");
            background-size: cover;
            position: relative;
            color: #fff;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            align-items: center;
        }

        .left .admit-one {
            transform: rotate(90deg);
            position: absolute;
            top: 20px;
            left: -80px;
            background: rgba(255, 255, 255, 0.2);
            padding: 10px;
            border-radius: 5px;
        }

        .left .ticket-number {
            background: rgba(255, 255, 255, 0.2);
            padding: 10px;
            border-radius: 5px;
            margin-top: auto;
        }

        .left .ticket-number p {
            margin: 0;
            font-size: 18px;
        }

        .right {
            background: #fff;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            align-items: center;
        }

        .right .admit-one {
            transform: rotate(-90deg);
            background: rgba(0, 0, 0, 0.1);
            padding: 10px;
            border-radius: 5px;
        }

        .right .ticket-number {
            background: rgba(0, 0, 0, 0.1);
            padding: 10px;
            border-radius: 5px;
        }

        .right .barcode img {
            width: 100px;
        }

        .show-name h1 {
            font-size: 24px;
            margin-bottom: 10px;
            text-align: center;
        }

        .time p {
            margin: 5px 0;
            text-align: center;
        }

        .location p {
            margin: 5px 0;
            text-align: center;
        }
    </style>
</head>
<body>

<div class="ticket">
    <div class="left">
        <div class="admit-one">
            <span>ADMIT ONE</span>
            <span>ADMIT ONE</span>
            <span>ADMIT ONE</span>
        </div>
        <div class="ticket-number">
            <p>#20030220</p>
        </div>
    </div>
    <div class="right">
        <div class="admit-one">
            <span>ADMIT ONE</span>
            <span>ADMIT ONE</span>
            <span>ADMIT ONE</span>
        </div>
        <div class="right-info-container">
            <div class="show-name">
                <h1>{{$event->title}}</h1>
            </div>
            <div class="time">
                <p>{{ date('h:i A', strtotime($event->time)) }} - {{ date('h:i A', strtotime('+3 hours', strtotime($event->time))) }}</p>
                <p>DOORS @ {{ date('h:i A', strtotime('-1 hour', strtotime($event->time))) }}</p>
            </div>
            <div class="location">
                <p>{{$event->location}}</p>
            </div>
        </div>
        <div class="barcode">
            <img src="https://external-preview.redd.it/cg8k976AV52mDvDb5jDVJABPrSZ3tpi1aXhPjgcDTbw.png?auto=webp&s=1c205ba303c1fa0370b813ea83b9e1bddb7215eb" alt="QR code">
        </div>
        <div class="ticket-number">
            <p>aichaettabet</p>
        </div>
    </div>
</div>

</body>
</html>
