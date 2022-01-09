@extends('adminPanel.layouts.app')

@section('title', '| Shows:edit')

@section('breadcrumb')
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Shows</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route('adminPanel.dashboard')}}">Dashboard</a></li>
              <li class="breadcrumb-item"><a href="{{route('adminPanel.shows.index')}}">Shows</a></li>
              <li class="breadcrumb-item active">{{ $show->title??'' }}</li>
            </ol>
          </div>
        </div>
      </div>
    </section>
@endsection

@section('content')
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">{{ $show->title??'' }}</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <form id="editForm" action="{{ route('adminPanel.shows.update', $show->id) }}" method="POST">
                    @csrf
                    @method('PATCH')
                    <input type="hidden" name="edit" value="1">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="typeInput">Type</label>
                            <Select name="type" id="typeInput" class="form-control @error('type') is-invalid @enderror">
                                <option value="">Select Type</option>
                                <option value="1" {{old('type', $show->type) ==  1 ? 'Selected':''}}>Series</option>
                                <option value="2" {{old('type', $show->type) ==  2 ? 'Selected':''}}>TV</option>
                            </Select>
                            @error('type')
                                <p class="text-danger">{{$message}}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="titleInput">Title</label>
                            <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" id="titleInput" value="{{ old('title', $show->title) }}">
                            @error('title')
                                <p class="text-danger">{{$message}}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="descriptionInput">Description</label>
                            <textarea name="description" id="descriptionInput" class="form-control @error('description') is-invalid @enderror" cols="30" rows="10">{{ old('description', $show->description) }}</textarea>
                            @error('description')
                                <p class="text-danger">{{$message}}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="priceInput">Price</label>
                            <input type="number" name="price" class="form-control @error('price') is-invalid @enderror" id="priceInput" value="{{ old('price', $show->price) }}">
                            @error('price')
                                <p class="text-danger">{{$message}}</p>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="statusInput">Status</label>
                            <Select name="status" id="statusInput" class="form-control @error('status') is-invalid @enderror">
                                <option value="">Select Status</option>
                                <option value="1" {{old('status', $show->status) ==  1? 'Selected':''}}>Active</option>
                                <option value="0" {{old('status', $show->status) ==  0? 'Selected':''}}>Inactive</option>
                            </Select>
                            @error('status')
                                <p class="text-danger">{{$message}}</p>
                            @enderror
                        </div>
                    
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                      <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
      </div>
    </div><!-- /.container-fluid -->
  </section>
@endsection


