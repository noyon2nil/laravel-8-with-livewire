@push('css')
@endpush
<div>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h4 class="m-0">Category Lists</h4>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Category lists</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card card-primary card-outline">
                            <div class="card-header">
                                <div class="card-tools">
                                    <button class="btn btn-primary btn-sm" wire:click="create">Add Category</button>
                                </div>
                            </div>
                            <div class="card-body">
                                <table class="table table-striped table-sm table-responsive-sm table-hover">
                                    <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Date</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($categories as $key => $category)
                                        <tr>
                                            <th scope="row">{{ $categories->firstItem() + $key   }}</th>
                                            <td>{{ $category->name }}</td>
                                            <td>{{ $category->created_at }}</td>
                                            @if($category->status == 0)
                                                <td><span class="badge badge-success">Active</span></td>
                                            @else
                                                <td><span class="badge badge-warning">Inactive</span></td>
                                            @endif
                                            <td>
                                                <button class="btn btn-info btn-sm" wire:click="edit({{ $category }})"><i class="fas fa-edit"></i></button>
                                                <button class="btn btn-warning btn-sm" wire:click="delete({{ $category->id }})"><i class="fas fa-trash"></i></button>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                                <div class="card-footer">
                                    <div>{{ $categories->links() }}</div>
                                </div>
                            </div>
                        </div><!--//card-->
                    </div>
                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content -->

        <!-- Modal -->
        <div wire:ignore.self class="modal fade" id="cu-form" tabindex="-1" role="dialog"
             aria-labelledby="cuFormleModalLabel"
             aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="cuFormleModalLabel">Add category</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form wire:submit.prevent="{{ $is_category_update ? 'update' : 'store' }}">
                        <div class="modal-body">
                            <!--forms-->
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" wire:model.defer="state.name"
                                       class="form-control @error('name')is-invalid @enderror" id="name"
                                       aria-describedby="nameHelp" placeholder="Enter full name">
                                @error('name') <span class="invalid-feedback">{{ $message }}</span> @enderror
                            </div>

                            <div class="form-group">
                                <label for="status">Publication status</label>
                                <select class="form-control"  wire:model.defer="state.status">
                                    <option selected >- please select -</option>
                                    <option value="0">Active</option>
                                    <option value="1">Inactive</option>
                                </select>
                            </div>
                            <!--//forms-->
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">

                                    <span>Save</span>

                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>


    </div>
    <!-- /.content-wrapper -->
</div>
@push('js')
    <script>
        window.addEventListener('show-form', event => {
            $('#cu-form').modal('show')
        });
        window.addEventListener('hide-form', event=>{
            $('#cu-form').modal('hide')
        })
    </script>
@endpush
