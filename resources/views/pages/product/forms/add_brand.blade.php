<form action="{{ route("product.add_brand") }}" id="edit_form" method="POST" enctype="multipart/form-data">

    @csrf
    <div class="errors"></div>

    <div class="form-group">
      <label for="">Brand Name</label>
      <input type="text" name="name" value="{{ old("name") }}" class="form-control">
      @if($errors->has('name'))
        <div class="alert alert-danger">{{ $errors->first('name') }}</div>
      @endif
    </div>

    <input type="submit" class="btn btn-info" value="Add Brand">
</form>