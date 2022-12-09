@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Admin Panel</div>

                <div class="panel-body">
                    <p style="color: #a47c0c; font-size: 1.2em">Navigation Links :</p>
                    <ul id="admin-nav-links">
                        <li class="text-center"><a target="_blank" href="/farmers/enlist">Enlist a Farmer</a></li>
                        <li class="text-center"><a target="_blank" href="/farmers/all">All Farmers</a></li>
                        <li class="text-center"><a target="_blank" href="/admin/add_wdata">Add weather data manually</a></li>
                        <li class="text-center"><a target="_blank" href="/admin/test/sms">Test SMS</a></li>
                        <li class="text-center"><a target="_blank" href="/admin/send/sms">Send SMS (upozila wise)</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
