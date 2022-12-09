
<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Enlist a farmer</title>
        
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        
        
        <style>
            body{
                background-image: url('/images/field.jpg');
            }
            #heading span{
                color: #000000;
            }
            .labeling{
                font-size: 1.3em;
            }
            .singleField{
                color: #000;
                font-weight: bold;
                box-shadow: 5px 5px 5px #5d5760;
            }
            .singleField input:hover {
                border: 2px solid #00cc88;
            }
        </style>
        
    </head>
    <body>
        <div id="container">
            <div>
                <h2 id="heading" class="text-center">
                    <span>'আলোকিত কৃষক' এর সদস্য হতে চাই</span>
                </h2>
            </div>
            <div id='formContainer' class="col-md-6 col-md-offset-3 text-center">
                
                @if($errors->any())
                <ul>
                    @foreach($errors->all() as $error)
                    <li class="alert alert-danger">{{$error}}</li>
                    @endforeach
                </ul>
                @endif
                
                {!! Form::open(['url'=>'/farmers']) !!}
                
                <div class="singleField">
                    <div class="labeling col-md-5 text-left">আমার নাম</div>
                    <div class="form-group col-md-7">
                        {!! Form::text('name', null, ['class'=>'form-control', 'id'=>'name', 'placeholder'=>'Name', 'required']) !!}
                    </div>
                </div>
                
                <div class="singleField">
                    <div class="labeling col-md-5 text-left">ইমেইল</div>
                    <div class="form-group col-md-7">
                        {!! Form::email('email', null, ['class'=>'form-control', 'id'=>'email', 'placeholder'=>'Optional']) !!}
                    </div>
                </div>
                
                <div class="singleField">
                    <div class="labeling col-md-5 text-left">উপজেলা</div>
                    <div class="form-group col-md-7">
                        {!! Form::text('upozilla', null, ['class'=>'form-control', 'id'=>'upozilla', 'placeholder'=>'Upozilla', 'required']) !!}
                    </div>
                </div>
                
                <div class="singleField">
                    <div class="labeling col-md-5 text-left">জাতীয় পরিচয়পত্র নম্বর</div>
                    <div class="form-group col-md-7">
                        {!! Form::text('nidNo', null, ['class'=>'form-control', 'id'=>'nidNo', 'placeholder'=>'NID No.', 'required']) !!}
                    </div>
                </div>
                
                <div class="singleField">
                    <div class="labeling col-md-5 text-left">ফোন</div>
                    <div class="form-group col-md-7">
                        {!! Form::text('phone', null, ['class'=>'form-control', 'id'=>'phone', 'placeholder'=>'Phone or Mobile number', 'required']) !!}
                    </div>
                </div>
                
                <div class="singleField">
                    <div class="labeling col-md-5 text-left">বয়স</div>
                    <div class="form-group col-md-7">
                        {!! Form::number('age', null, ['class'=>'form-control', 'min'=>'15', 'max'=>100,'placeholder'=>'Example : 36', 'required']) !!}
                    </div>
                </div>
                
                <div class="singleField">
                    <div class="labeling col-md-5 text-left">কী ধরনের ফসল</div>
                    <div class="form-group col-md-7">
                        {!! Form::text('crop_type', null, ['class'=>'form-control', 'placeholder'=>'Example : Mango', 'required']) !!}
                    </div>
                </div>
                
                
                
                <div class="singleField">
                    <div class="labeling col-md-5 text-left">চাষ যোগ্য জমির পরিমাণ</div>
                    <div class="form-group col-md-7">
                        {!! Form::text('amount_of_land', null, ['class'=>'form-control', 'placeholder'=>'Optional']) !!}
                    </div>
                </div>
                
                <div class="singleField">
                    {!! Form::hidden('lat', null, ['id'=>'lat']) !!}
                </div>
                <div class="singleField">
                    {!! Form::hidden('long', null, ['id'=>'long']) !!}
                </div>
                
                <div class="singleField">
                    {!! Form::submit('পরবর্তী ধাপ', ['class'=>'btn btn-primary form-control', 'id'=>'regBtn', 'style'=>'width:40%']) !!}
                </div>
                
                {!! Form::close() !!}
            </div>
        </div>
        
        <script src="/js/Library.js"></script>
        <script type="text/javascript">
            $(document).ready(function (){
                var gotPosition=false;
                var lat, long;
                $("#name").click(function (){
                    lat=$("#lat").val();
                    long=$("#long").val();
                    if(!gotPosition){
                        setGeoLocation();
                        gotPosition=true;
                        
                        if(!lat || !long){
                            $("#lat").val("null");
                            $("#long").val("null");
                        }
                    }
                });
                
                $("#regBtn").click(function (){
                    if(!lat || !long){
                        //alert("Error ! Please try again");
                    }
                });
            });
        </script>
        
    </body>
</html>
