<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Send SMS to farmers</title>
        
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        
        <style>
            th, td{
                text-align: center;
            }
        </style>
    </head>
    <body>
        <div class="container col-md-12">
            <h2 class="text-center">Send SMS to farmers</h2>
            <p class="text-center text-danger"><span style="font-size:1.4em">Warning !!</span> 
                Pressing the 'Send SMS' will send message to farmers</p>
            <div id="tableContainer" class="text-center">
                <table border="1" class="col-md-8 col-md-offset-2">
                    <th>No.</th>    <th>Upozila</th>    <th>Date(YYYY-MM-DD)</th>
                    <th>Action</th>     <th>Forecasted Date(s)</th>
                    <?php $n=0; ?>
                    
                    @foreach($allUpozila as $upo)
                    <tr>
                        <td>{{++$n}}</td>
                        <td>{{$upo}}</td>
                        <td>
                            <select class="form-control">
                                @foreach($datesForDropdown as $date)
                                <option value="{{$date}}">{{$date}}</option>
                                @endforeach
                            </select>
                        </td>
                        <td><button class="sendBtn btn btn-primary">Send SMS</button></td>
                        <td><textarea class="form-control"></textarea></td>
                    </tr>
                    @endforeach
                </table>
            </div>
        </div>
        
        <script>
            $(document).ready(function (){
                
                $(".sendBtn").click(function (){
                    var THIS=$(this);
                    var upozila=$(this).parent().siblings().eq(1).text();
                    var dateToSend=$(this).parent().siblings().eq(2).children('select').val();
                    
                    //console.log(upozila+"--"+dateToSend);
                    
                    $.ajax({
                        url:"/admin/send/sms",
                        type:"POST",
                        dataType:"text",
                        data:{
                            _token:"<?php echo csrf_token(); ?>",
                            upozila:upozila,
                            dateToSend:dateToSend
                        },
                        success:function(response){
                            console.log(response);
                            if(response=="sent"){
                                THIS.text("Successfull");
                            }else{
                                alert("Unable to send SMS");
                            }
                        },
                        error:function (xhr, status){
                            
                        }
                    });
                });
            });
        </script>
        
    </body>
</html>
