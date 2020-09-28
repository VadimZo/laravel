@extends('blog.pages.layout')

@section('content')
    <!--main content start-->
    <div class="main-content">
        <div class="container">
            <div class="row">
                <div class="col-md-8">

                    <div class="leave-comment mr0"><!--leave comment-->

                        <h3 class="text-uppercase">Login</h3>
                        <br>
                        {{Form::open(['route'=>['login'],'class'=>'form-horizontal contact-form','role'=>'form'])}}
                            <div class="form-group">
                                <div class="col-md-12">
                                    <input type="text" class="form-control" id="email" name="email"
                                           placeholder="Email">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-12">
                                    <input type="text" class="form-control" id="password" name="password"
                                           placeholder="password">
                                </div>
                            </div>
                            <button type="submit" class="btn send-btn">Login</button>
                        {{Form::close()}}
                    </div><!--end leave comment-->
                </div>
                @include('blog.pages.sidebar')
            </div>
        </div>
    </div>
    <!-- end main content-->
@endsection
