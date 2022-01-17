    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid p-0">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0">{{ $label ?? ''}}</h1>
            </div><!-- /.col -->
            @if (!isset($home))
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
                    <li class="breadcrumb-item active">{{ $label ?? ''}}</li>
                </ol>
            </div><!-- /.col -->
            @endif
        </div><!-- /.row -->
        </div><!-- /.container-fluid -->
      </div>
      <!-- /.content-header -->