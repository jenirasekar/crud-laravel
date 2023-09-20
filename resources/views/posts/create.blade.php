<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Data Post - aku.com</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.3.2/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5 mb5">
        <div class="row">
            <div class="col-md-12">
                <div class="card border-0 shadow rounded">
                    <div class="card-body">
                        <form action="{{ route('posts.store) }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="" class="font-weight-bold">Gambar</label>
                                <input type="file" name="image" id="image" class="form-control" @error("image") is-invalid @enderror>
                                @error('image')
                                <div class="alert alert-danger">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="" class="font-weight-bold">Konten</label>
                                <textarea name="content" id="content" rows="5" class="form-control" @error("content") is-invalid @enderror placeholder="Masukkan kontent Post">{{ old('content') }}</textarea>
                                @error('content')
                                <div class="alert alert-danger">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <button class="btn btn-md btn-primary" type="submit">Simpan</button>
                            <button class="btn btn-md btn-primary" type="reset">Reset</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script>
        CKEDITOR.replace('content');
    </script>
</body>
</html>