<div>
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
                                        <button class="btn btn-primary btn-sm" wire:click="create">Add sub-category
                                        </button>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <table class="table table-striped table-sm table-responsive-sm table-hover">
                                        <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Sub category name</th>
                                            <th scope="col">Category name</th>
                                            <th scope="col">Date</th>
                                            <th scope="col">Status</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($sub_categories as $key=> $sub_category)
                                            <tr>
                                                <th scope="row">{{ $sub_categories->firstItem() + $key }}</th>
                                                <td>{{ $sub_category->name }}</td>

                                                <td>{{$sub_category->category_info ? $sub_category->category_info->name : '' }}</td>
                                                <td>{{ $sub_category->created_at }}</td>

                                                @if($sub_category->status == 0)
                                                    <td><span class="badge badge-success">Active</span></td>
                                                @else
                                                    <td><span class="badge badge-warning">Inactive</span></td>
                                                @endif
                                                <td>
                                                    <button class="btn btn-info btn-sm"
                                                            wire:click="edit({{ $sub_category }})"><i
                                                            class="fas fa-edit"></i></button>
                                                    <button class="btn btn-warning btn-sm"
                                                            wire:click="delete({{ $sub_category->id }})"><i
                                                            class="fas fa-trash"></i></button>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                    <div class="card-footer">
                                        <div>{{ $sub_categories->links() }}</div>
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
                            <h5 class="modal-title"
                                id="cuFormleModalLabel">{{ $sub_category_update ? 'Edit sub category' : 'Add sub category' }}</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form wire:submit.prevent="{{ $sub_category_update ? 'update' : 'store' }}">
                            <div class="modal-body">
                                <!--forms-->
                                <div class="form-group">
                                    <label for="status">Select category name</label>
                                    <select class="form-control @error('category_id') is-invalid @enderror"
                                            wire:model="state.category_id" name="category_id">
                                        <option selected>Select category name</option>
                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('category_id')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                                {{--{{ $this->state['category_id'] }}--}}
                                <div class="form-group">
                                    <label for="name">Sub category name</label>
                                    <input type="text" wire:model.defer="state.name"
                                           class="form-control @error('name')is-invalid @enderror" id="name"
                                           aria-describedby="nameHelp" placeholder="Enter full name">
                                    @error('name') <span class="invalid-feedback">{{ $message }}</span> @enderror
                                </div>
                                <div class="form-group">
                                    <label for="status">Status:</label>
                                    <select id="status" wire:model.defer="state.status"
                                            class="form-control @error('status') is-invalid @enderror">
                                        <option value="">Select Status</option>
                                        <option value="0">Active</option>
                                        <option value="1">Inactive</option>
                                    </select>
                                    @error('status')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                                <!--//forms-->
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">
                                    @if($sub_category_update)
                                        <span>Update</span>
                                    @else
                                        <span>Save</span>
                                    @endif
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
                $('#cu-form').modal('show');
            })
            window.addEventListener('hide-form', event => {
                $('#cu-form').modal('hide')
            })
        </script>
    @endpush

</div>
