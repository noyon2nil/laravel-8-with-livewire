@push('css')
    <style>
        /*!
 * Load Awesome v1.1.0 (http://github.danielcardoso.net/load-awesome/)
 * Copyright 2015 Daniel Cardoso <@DanielCardoso>
 * Licensed under MIT
 */
        .la-ball-clip-rotate,
        .la-ball-clip-rotate > div {
            position: relative;
            -webkit-box-sizing: border-box;
            -moz-box-sizing: border-box;
            box-sizing: border-box;
        }

        .la-ball-clip-rotate {
            display: block;
            font-size: 0;
            color: #fff;
        }

        .la-ball-clip-rotate.la-dark {
            color: #333;
        }

        .la-ball-clip-rotate > div {
            display: inline-block;
            float: none;
            background-color: currentColor;
            border: 0 solid currentColor;
        }

        .la-ball-clip-rotate {
            width: 32px;
            height: 32px;
        }

        .la-ball-clip-rotate > div {
            width: 32px;
            height: 32px;
            background: transparent;
            border-width: 2px;
            border-bottom-color: transparent;
            border-radius: 100%;
            -webkit-animation: ball-clip-rotate .75s linear infinite;
            -moz-animation: ball-clip-rotate .75s linear infinite;
            -o-animation: ball-clip-rotate .75s linear infinite;
            animation: ball-clip-rotate .75s linear infinite;
        }

        .la-ball-clip-rotate.la-sm {
            width: 16px;
            height: 16px;
        }

        .la-ball-clip-rotate.la-sm > div {
            width: 16px;
            height: 16px;
            border-width: 1px;
        }

        .la-ball-clip-rotate.la-2x {
            width: 64px;
            height: 64px;
        }

        .la-ball-clip-rotate.la-2x > div {
            width: 64px;
            height: 64px;
            border-width: 4px;
        }

        .la-ball-clip-rotate.la-3x {
            width: 96px;
            height: 96px;
        }

        .la-ball-clip-rotate.la-3x > div {
            width: 96px;
            height: 96px;
            border-width: 6px;
        }

        /*
         * Animation
         */
        @-webkit-keyframes ball-clip-rotate {
            0% {
                -webkit-transform: rotate(0deg);
                transform: rotate(0deg);
            }
            50% {
                -webkit-transform: rotate(180deg);
                transform: rotate(180deg);
            }
            100% {
                -webkit-transform: rotate(360deg);
                transform: rotate(360deg);
            }
        }

        @-moz-keyframes ball-clip-rotate {
            0% {
                -moz-transform: rotate(0deg);
                transform: rotate(0deg);
            }
            50% {
                -moz-transform: rotate(180deg);
                transform: rotate(180deg);
            }
            100% {
                -moz-transform: rotate(360deg);
                transform: rotate(360deg);
            }
        }

        @-o-keyframes ball-clip-rotate {
            0% {
                -o-transform: rotate(0deg);
                transform: rotate(0deg);
            }
            50% {
                -o-transform: rotate(180deg);
                transform: rotate(180deg);
            }
            100% {
                -o-transform: rotate(360deg);
                transform: rotate(360deg);
            }
        }

        @keyframes ball-clip-rotate {
            0% {
                -webkit-transform: rotate(0deg);
                -moz-transform: rotate(0deg);
                -o-transform: rotate(0deg);
                transform: rotate(0deg);
            }
            50% {
                -webkit-transform: rotate(180deg);
                -moz-transform: rotate(180deg);
                -o-transform: rotate(180deg);
                transform: rotate(180deg);
            }
            100% {
                -webkit-transform: rotate(360deg);
                -moz-transform: rotate(360deg);
                -o-transform: rotate(360deg);
                transform: rotate(360deg);
            }
        }
    </style>
@endpush
<div>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h4 class="m-0">Users Lists</h4>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Users lists</li>
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
                                <div class="d-flex justify-content-between">
                                    <button class="btn btn-primary btn-sm" wire:click="create"><i
                                            class="fas fa-plus"></i>
                                        &nbsp; Add User
                                    </button>
                                    <div
                                        class="d-flex justify-content-center align-items-center border bg-white pr-2 input-group-sm">
                                        <input wire:model="search_keywords" type="text" class="form-control border-0"
                                               placeholder="Search">
                                        <div wire:loading.delay wire:target="search_keywords">
                                            <div class="la-ball-clip-rotate la-dark la-sm">
                                                <div></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <table class="table table-striped table-sm table-responsive-sm table-hover">
                                    <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Join</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($users as $key => $user)
                                        <tr>
                                            <th scope="row">{{ $users->firstItem() + $key   }}</th>
                                            <td>{{ $user->name }}</td>
                                            <td>{{ $user->email }}</td>
                                            <td>{{ $user->created_at->toDateFormat() }}</td>
                                            @if($user->status == 0)
                                                <td><span class="badge badge-success">Active</span></td>
                                            @else
                                                <td><span class="badge badge-warning">Inactive</span></td>
                                            @endif
                                            <td>
                                                <button class="btn btn-info btn-sm" wire:click="edit({{ $user }})"><i
                                                        class="fas fa-edit"></i></button>
                                                <button class="btn btn-warning btn-sm"
                                                        wire:click="destroy({{ $user->id }})"><i
                                                        class="fas fa-trash"></i></button>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                                <div class="card-footer">
                                    <div>{{ $users->links() }}</div>
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
                            id="cuFormleModalLabel">{{ $is_user_update ? 'Edit User' : 'Add User' }}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form wire:submit.prevent="{{ $is_user_update ? 'update' : 'store' }}">
                        <div class="modal-body">
                            <!--forms-->
                            <div class="form-group">
                                <label for="name">Full name</label>
                                <input type="text" wire:model.defer="state.name"
                                       class="form-control @error('name')is-invalid @enderror" id="name"
                                       aria-describedby="nameHelp" placeholder="Enter full name">
                                @error('name') <span class="invalid-feedback">{{ $message }}</span> @enderror
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" wire:model.defer="state.email"
                                       class="form-control @error('email')is-invalid @enderror" id="email"
                                       aria-describedby="emailHelp" placeholder="Enter email">
                                @error('email') <span class="invalid-feedback">{{ $message }}</span> @enderror

                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Password</label>
                                <input type="password" wire:model.defer="state.password"
                                       class="form-control @error('password')is-invalid @enderror"
                                       id="exampleInputPassword1"
                                       placeholder="Password">
                                @error('password') <span class="invalid-feedback">{{ $message }}</span> @enderror
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Password Confirmation</label>
                                <input type="password" wire:model.defer="state.password_confirmation"
                                       class="form-control " id="exampleInputPassword1"
                                       placeholder="Password">
                                @error('password_confirmation') <span
                                    class="invalid-feedback">{{ $message }}</span> @enderror
                            </div>
                            <!--//forms-->
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">
                                @if($is_user_update)
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
        $(document).ready(function () {

            toastr.options = {
                "progressBar": true,
                "positionClass": "toast-bottom-right",
            }

            window.addEventListener('hide-form', event => {
                $('#cu-form').modal('hide')
                toastr.success(event.detail.message, 'Success!')
            })
        })
    </script>

    <script>
        window.addEventListener('show-form', event => {
            $('#cu-form').modal('show')
        });
    </script>

    <script>
        window.addEventListener('delete-confirm-alert', event => {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    Livewire.emit('confirm_deleted')
                }
            })
        });

        window.addEventListener('deleted-success-alert', event => {
            Swal.fire(
                'Deleted!',
                event.detail.message,
                'success'
            )
        })
    </script>
@endpush
