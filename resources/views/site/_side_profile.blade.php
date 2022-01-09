<div class="col-md-3">

    <!-- Profile Image -->
    <div class="card card-primary card-outline">
        <div class="card-body box-profile">
            <div class="text-center">
                <img class="profile-user-img img-fluid img-circle"
                    src="{{asset('uploads_images\\'. $user->image)}}"
                    alt="User profile picture">
            </div>

            <h3 class="profile-username text-center">{{ $user->name??'' }}</h3>

            <p class="text-muted text-center">{{ $user->email??'' }}</p>

            <ul class="list-group list-group-unbordered mb-3">
                <li class="list-group-item">
                    <b>My Profile</b> <a class="float-right" href="{{ route('site.profile') }}">Update</a>
                </li>
                <li class="list-group-item">
                    <b>My Wallet</b> <a class="float-right"href="{{ route('site.wallet') }}">{{ $user->wallet??'' }} $</a>
                </li>
                <li class="list-group-item">
                    <b>Gift</b> <a class="float-right">{{ $user->gift->amount??'' }} $</a>
                </li>
                <li class="list-group-item">
                    <b>My Purchases</b> <a class="float-right" href="{{ route('site.purchase') }}">{{ $user->purchases_count}}</a>
                </li>
            </ul>

            <a href="{{route('site.logout') }}" class="btn btn-primary btn-block"><b>Logout</b></a>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
</div>
