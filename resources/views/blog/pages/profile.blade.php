@extends('blog.pages.layout')

@section('content')
    <!--main content start-->
    <div class="main-content">
        <div class="container">
            <div class="row">
                <div class="col-md-8">

                    <div class="leave-comment mr0"><!--leave comment-->

                        <h3 class="text-uppercase">My profile</h3>
                        <br>
                        <img src="{{$user->getAvatar()}}" alt="" class="profile-image">
                        {{Form::open(['route'=>['profile.store'],'class'=>'form-horizontal contact-form','role'=>'form','files'=>true])}}
                            <div class="form-group">
                                <div class="col-md-12">
                                    <input type="text" class="form-control" id="name" name="name"
                                           placeholder="Name" value="{{$user->name}}" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-12">
                                    <input type="email" class="form-control" id="email" name="email"
                                           placeholder="Email" value="{{$user->email}}" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-12">
                                    <input type="text" class="form-control" id="password" name="password"
                                           placeholder="password">
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-12">
                                    <input type="file" class="form-control" id="image" name="image">
                                </div>
                            </div>
                            <button type="submit" name="submit" class="btn send-btn">Update</button>
                       {{Form::close()}}
                    </div><!--end leave comment-->
                </div>
                @include('blog.pages.sidebar')
            </div>
        </div>
    </div>
    <!-- end main content-->
@endsection
