<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Welcome</title>
    @include('layouts.scaffolding.mail-css')
</head>

<body>

<div class="container">
    <br/>
  
    <br/>
    <div class="row">

        <div class="col-md-12">

            <h2>Dear Subscriber,</h2>

            <p>{{$data->body}}</p>
            <p>Thank you</p>
            

            <br/>

            <p>Regards,</p>
            <p>Delon Jobs</p>
         
        </div>
    </div>
    <br/>


</div>
</body>
</html>
