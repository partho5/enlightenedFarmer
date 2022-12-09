<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Test SMS</title>
        
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        
        <style>
            body{
                background-color: #e4dfeb;
            }
            .labeling{
                font-weight: bold;
                font-size: 1.1em;
            }
        </style>
        
    </head>
    <body>
        <div class="container">
            <h2 class="text-center">Test SMS</h2>
            <p class="text-center">Weather forecast of specified date will be delivered to the the given mobile number</p>
            <div id="formWrapper">
                {!! Form::open(['url'=>'/admin/test/sms', 'method'=>'post']) !!}
                    <div class="singleField form-group col-md-4 col-md-offset-4">
                        <div class="labeling">Mobile Number</div>
                        {!! Form::text('mobile', null, ['id'=>'mobile', 'class'=>'form-control', 'placeholder'=>'01xxxxxxxxx', 'required']) !!}
                    </div>
                    <div class="singleField form-group col-md-4 col-md-offset-4">
                        <div class="labeling">Date</div>
                        {!! Form::text('date', null, ['class'=>'form-control', 'placeholder'=>'Must follow : YYYY-MM-DD', 'required']) !!}
                    </div>
                    <div class="singleField form-group col-md-4 col-md-offset-4 text-center">
                        {!! Form::submit('Send SMS', ['class'=>'btn btn-primary']) !!}
                    </div>
                {!! Form::close() !!} 
            </div>
        </div>

    </body>
</html>
