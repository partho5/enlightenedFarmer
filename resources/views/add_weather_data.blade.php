<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Add Weather Data</title>
        
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        
        <style>
            body{
                background-image: url('/images/weather-bg.png');
                color: #000;
            }
            table{
                
            }
            th{
                text-align: center;
            }
            td{
                background-color: #fff;
                height: 150px;
            }
            .short-description-input{
                height: 150px;
            }
            td:hover{
                background-color: #fff;
            }
            .container h1{
                color: #ff9900;
                text-shadow: -1px 0 black, 0 1px black, 1px 0 black, 0 -1px black;
            }
            .weather-src{
                background-color: #61c2f2;
                border: 2px solid #ff9900;
                border-radius: 5%;
                text-align: center;
                font-size: 1.1em;
                color: #50cf49;
            }
            .weather-src a{
                text-decoration: none;
            }
            .weather-src:hover{
                box-shadow: 2px 2px 5px #66ccff;
                background-color: #cceeff;
            }
            .charCount{
                color: #00F;
                background-color: #fff;
            }
        </style>
    </head>
    <body>
        <?php $n=0; $l=count($weatherData); ?>
        
        <div class="container">
            <h1 class="text-center">Add Weather Data Manually</h1>
            @for($i=0; $i< $l; ++$i)
            <div class="tableContainer">
                <h2 class="text-center upozila">Region : {{$weatherData[$i][0]->upozila}}</h2>
                <diV class="col-md-6 col-md-offset-3">
                    <div class="col-md-4 weather-src"><a target="_blank" href="http://www.accuweather.com/en/weather-news/accuweather-25-day-forecast/63449">Accuweather</a></div>
                    <div class="col-md-4 weather-src"><a target="_blank" href="https://www.wunderground.com/">Wunderground</a></div>
                    <div class="col-md-4 weather-src"><a target="_blank" href="https://openweathermap.org/">Openweather</a></div>
                </diV> <br><br>
                <table border="1" class="col-md-10 col-md-offset-1">
                    <th style="display:none">id</th>    <th>No.</th>    <th>Date</th>   <th>Long Description</th>
                    <th>Short Description<br>(to send as SMS)</th>  <th>Source</th> <th>Action</th>
                    @foreach($weatherData[$i] as $wData)
                    <?php
                    $d = $wData->date;
                    if ($today == $d) {
                        $style = "background-color: #ffd9b3";
                    } else {
                        $style = "";
                    }
                    ?>
                    <tr>
                        <td style="display: none; ">{{$wData->id}}</td>
                        <td>{{++$n}}</td>
                        <td style="{{$style}}">{{$wData->date}}</td>
                        <td style="width:5%"><input type="text" class="form-control" value="{{$wData->long_description}}" style="{{$style}}"></td>
                        <td style="width:60%">
                            <div class="input-group text-left">
                                <textarea cols="60" class="short-description-input"  style="{{$style}}">{{$wData->short_description}}</textarea>
                                <span class="charCount input-group-addon"></span>
                            </div>
                        </td>
                        <td>
                            <textarea cols="12" class="short-description-input"  style="{{$style}}">{{$wData->source}}</textarea>
                        <td><button class="updateBtn btn btn-group-sm">Update</button></td>
                    </tr>
                    @endforeach
                </table>

            </div>
            @endfor
        </div>
        
        
        <script src="/js/Library.js"></script>
        <script> 
            function smsCredit(count) {
                return Math.ceil(count/160);
            }
            $(document).ready(function(){
                
                $(".short-description-input").each(function (index){
                    var sd=$(this).val();
                    var count=sd.length;
                    txt=count+"~"+smsCredit(count);
                    $(this).next().text(txt);
                    if(count>140){
                        $(this).next().css('color', '#F00');
                    }
                });
                
                $(".short-description-input").keyup(function (){
                    var sd=$(this).val();
                    var count=sd.length;
                    $(this).next().text(count+"~"+smsCredit(count));
                    if(count>140){
                        $(this).next().css('color', '#F00');
                    }else{
                        $(this).next().css('color', '#00F');
                    }
                });
                
                
                $(".updateBtn").click(function (){
                    var THIS=$(this);
                    
                    var upozila=$(this).closest('table').prev().text();
                    var rowId=$(this).parent().siblings().eq(0).text();
                    var longDescription=$(this).parent().siblings().eq(3).children('input').val();
                    var shortDescription=$(this).parent().siblings().eq(4).children().eq(0).children().eq(0).val();
                    var source=$(this).parent().siblings().eq(5).children('textarea').val();
                    
                    console.log(rowId+"------"+longDescription+"---"+shortDescription+"---"+source);
                    
                    shortDescription = shortDescription ? shortDescription : "not set";
                    longDescription =longDescription ? longDescription : "not set";
                    source = source ? source : "not set";
                    
                    
                    THIS.text("Wait...");
                    THIS.css("color", "#00E");
                    $.ajax({
                        url:"/admin/"+rowId,
                        type:"PUT",
                        dataType:"text",
                        data:{
                            _token:"<?php echo csrf_token(); ?>",
                            rowId:rowId,
                            longDescription:longDescription,
                            shortDescription:shortDescription,
                            source:source
                        },
                        success: function (response){
                            if(response==="saved"){
                                console.log(response);
                                
                                THIS.css("color", "#00CC33");
                                THIS.text("Updated");
                                setTimeout(function (){
                                    THIS.text("Update");
                                    THIS.css("color", "#000");
                                }, 2000);
                                
                            }
                        },
                        error:function (xhr, textStatus){
                            console.log(xhr+"\n"+textStatus);
                        }
                    });
                });
            });
        </script>
    </body>
</html>
