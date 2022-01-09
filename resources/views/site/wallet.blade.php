@extends('site.layouts.app')

@section('title', '| My Wallet')

@section('styles') @endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            @include('site._side_profile')
            <!-- /.col -->
            <div class="col-md-9">
            <div class="card">
                <div class="card-header p-2">
                    <h2>My Wallet</h2>
                </div><!-- /.card-header -->
                <div class="card-body">
                    <div class="card-body">
                        @include('sessionMessage')
                        <form class="form-horizontal" action="{{ route('site.charge_wallet') }}" method="POST">
                            @csrf

                            <div class="form-group row">
                                <label for="inputCardNumber" class="col-sm-2 col-form-label">Card Number</label>
                                <div class="col-sm-10">
                                    <input type="number" class="form-control" id="inputCardNumber" placeholder="Card Number" name="card_number" value="4242424242424242" min="14">
                                    @error('card_number') <b class="text-danger"> {{$message}}</b> @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputName" class="col-sm-2 col-form-label">Name</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="inputName" placeholder="Name" name="name" value="Ahmed Abdalla">
                                    @error('name') <b class="text-danger"> {{$message}}</b> @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="inputExpiryDate" class="col-sm-2 col-form-label">Expiry Date</label>
                                <div class="col-sm-10">
                                    <input type="month" class="form-control" id="inputExpiryDate" placeholder="ExpiryDate" name="expiry_date" value="2022-12">
                                    @error('expiry_date') <b class="text-danger"> {{$message}}</b> @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="inputCSV" class="col-sm-2 col-form-label">CSV</label>
                                <div class="col-sm-10">
                                    <input type="number" class="form-control" id="inputCSV" placeholder="CSV" name="csv" value="123">
                                    @error('csv') <b class="text-danger"> {{$message}}</b> @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="inputAmount" class="col-sm-2 col-form-label">Amount</label>
                                <div class="col-sm-10">
                                    <input type="number" class="form-control" id="inputAmount" placeholder="Amount" name="amount" value="">
                                    @error('amount') <b class="text-danger"> {{$message}}</b> @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                            <div class="offset-sm-2 col-sm-10">
                                <button type="submit" class="btn btn-primary">Save</button>
                            </div>
                            </div>
                        </form>
                    </div><!-- /.card-body -->
                <!-- /.tab-content -->
                </div><!-- /.card-body -->
            </div>
            <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->
@endsection

@section('scripts') @endsection
