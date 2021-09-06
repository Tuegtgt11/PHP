<!DOCTYPE html>
<html>
<head>
    <base href="{{asset('/')}}">
    <title>Covid-19</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="front/css/style.css" rel="stylesheet">
</head>
<body>
    <div class="wrapper">
        <div class="container">
            <div class="top_19">
                @if(Session::has('success'))
                <div class="alert alert-success">
                    {{Session::get('success')}}
                </div>
                @endif
                <div class="row">
                    <div class="col">
                        <h2>Đăng Kí Tiêm Vắc Xin Covid-19</h2>
                    </div>
                    <div class="col-md-auto">
                        <form action="/search" method="get">
                            <input type="search" name="search" class="form-control">
                            <span class="input-group-prepend">
                                <br>
                                <button type="submit" class="btn btn-primary">Search</button>
                            </span>
                        </form>
                    </div>

                </div>
                <form action="{{route('store')}}" method="post" class="form_19">
                   @csrf
                    <h5 class="text_19">Điền thông tin đăng kí người tiêm</h5>
                    <div class="row1">
                       <div class="row">
                           <div class="col">
                               <label for="id_card"><span>Căn cước công dân/Chứng minh thư:</span></label><br>
                               <input type="text" name="id_card" required="required" placeholder="CCCD/Số CMND">
                           </div>
                           <div class="col">
                               <label for="name"><span>Họ và tên:</span></label><br>
                               <input type="text" name="name" required="required" placeholder="Họ và tên">
                           </div>
                           <div class="col">
                               <label for="name"><span>Ngày sinh:</span></label><br>
                               <input type="date" name="date_year" required="required" placeholder="Ngày sinh">
                           </div>
                       </div>
                   </div>
                    <div class="row2">
                       <div class="row">
                           <div class="col">
                               <label for="id_card"><span>Địa chỉ:</span></label><br>
                               <input type="text" name="address" required="required" placeholder="Địa chỉ">
                           </div>
                           <div class="col">
                               <label for="name"><span>Số Điện Thoại:</span></label><br>
                               <input type="text" name="phone" required="required" placeholder="Số điện thoại">
                           </div>
                           <div class="col">
                               <label for="name"><span>Tiền sử dị ứng:</span></label><br>
                               <input type="text" name="allergy_history" required="required" placeholder="Tiền sử dị ứng">
                           </div>
                       </div>
                   </div>
                    <button class="btn btn-success" style="width: 100px; height:40px; margin-top: 20px">Đăng kí</button>
                </form>
            </div>
        </div>
        <br>
        <table class="table table-bordered" style="width: 1170px;margin-left: 120px;margin-top: 20px" >
            <thead>
                <tr>
                    <th>Id_Card</th>
                    <th>Name</th>
                    <th>Date</th>
                    <th>Address</th>
                    <th>Phone</th>
                    <th width="250">History</th>
                </tr>
            </thead>
            <tbody>
                @foreach($userss as $user)
                    <tr>
                        <td>{{$user->id_card}}</td>
                        <td>{{$user->name}}</td>
                        <td>{{$user->date_year}}</td>
                        <td>{{$user->address}}</td>
                        <td>{{$user->phone}}</td>
                        <td>{{$user->allergy_history}}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>


</body>
</html>
