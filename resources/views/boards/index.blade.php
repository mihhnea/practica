@extends('layout.main')

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Blank Page</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Blank Page</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">

    <!-- Default box -->
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Bordered Table</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th style="width: 10px">#</th>
                        <th>Name</th>
                        <th>User Id</th>
                        <th>Created At</th>
                        <th>Updated At</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($boards as $board)
                    <tr class='board-row-{{$board->id}}'>
                        <td>{{$board->id}}</td>
                        <td>{{$board->name}}</td>
                        <td>{{$board->user_id}}</td>
                        <td>{{$board->created_at}}</td>
                        <td>{{$board->updated_at}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- /.card-body -->
        <div class="card-footer clearfix">
            <ul class="pagination pagination-sm m-0 float-right">
                @if ($boards->currentPage() > 1)
                <li class="page-item"><a class="page-link" href="{{$boards->previousPageUrl()}}">&laquo;</a></li>
                <li class="page-item"><a class="page-link" href="{{$boards->url(1)}}">1</a></li>
                @endif

                @if ($boards->currentPage() < $boards->lastPage() )
                    <li class="page-item"><a class="page-link" href="{{$boards->url($boards->lastPage())}}">{{$boards->lastPage()}}</a></li>
                    <li class="page-item"><a class="page-link" href="{{$boards->nextPageUrl()}}">&raquo;</a></li>
                    @endif
            </ul>
        </div>
    </div>
    <!-- /.card -->

    <!-- <div class="modal fade" id="edit-modal">
        <div class="modal-dialog">

            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Edit user</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div id="editName"></div>
                    <div class="form-group">
                        <label for="editRole">Role</label>
                        <select class="custom-select rounded-0" id="editRole">
                            <option value="{{\App\Models\User::ROLE_USER}}">User</option>
                            <option value="{{\App\Models\User::ROLE_ADMIN}}">Admin</option>
                        </select>
                    </div>

                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" id="update-user" data-id="" class="btn btn-primary">Save changes</button>
                </div>

            </div>
            </form>
            <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
    </div> -->

    <!-- <div class="modal fade" id="delete-modal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Delete</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Do you want to delete user?</p>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" id="delete-user" class="btn btn-danger">Delete</button>
                </div>
            </div>
            <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
    </div> -->

</section>
<!-- /.content -->
@endsection