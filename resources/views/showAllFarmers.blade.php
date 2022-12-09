<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>All Alokito Farmers</title>
        
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        
        <style>
            body{
                background-color:   #d2e6d7  ;
            }
            #heading h2 span{
                
            }
            #tableContainer table th, td{
                text-align: center
            }
        </style>
    </head>
    <body>
        <div class="container">
            <div id="heading">
                <h2 class="text-center"><span>আলোকিত কৃষকদের তালিকা (মোট {{count($allFarmers)}} জন)</span></h2>
            </div>
            <div id="tableContainer" >
                <?php $i=0; ?>
                <table border='1' style="100%" class="col-md-10 col-md-offset-1">
                    <th>No.</th>    <th>Name</th>   <th>Upozilla</th> <th>NID Number</th>
                    <th>Phone</th>   <th>Age</th> <th>Crop Type</th>
                    @foreach($allFarmers as $farmer)
                    <tr>
                        <td>{{++$i}}</td>    <td>{{$farmer->name}}</td>  <td>{{$farmer->upozilla}}</td>  <td>{{$farmer->nidNo}}</td>
                        <td>{{$farmer->phone}}</td>  <td>{{$farmer->age}}</td>  <td>{{$farmer->crop_type}}</td>
                    </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </body>
</html>
