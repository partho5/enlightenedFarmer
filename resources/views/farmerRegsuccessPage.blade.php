<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>অভিনন্দন</title>
        
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        
        <style>
            .congrats{
                margin-top: 2em;
                font-size: 1.3em;
            }
        </style>
        
    </head>
    <body>
        <div class="container col-md-8 col-md-offset-2 text-center">
            <p class="congrats">আপনার মত একজন প্রযুক্তি সচেতন কৃষক কে পেয়ে আমারা আনন্দিত</p>
            <p class="congrats">{{$name}}, অভিনন্দন আপনাকে</p>
            <p>এখানে সকল কৃষকের <a href="/farmers/all">তালিকা</a> দেখুন</p>
        </div>
    </body>
</html>
