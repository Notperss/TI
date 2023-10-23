@extends('layouts.app')

{{-- set title --}}
@section('title', 'PC')

@section('content')

    <!-- BEGIN: Content-->
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="content-wrapper">

            {{-- error --}}
            @if ($errors->any())
                <div class="alert bg-danger alert-dismissible mb-2" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>

                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{-- breadcumb --}}
            <div class="content-header row">
                <div class="content-header-left col-md-6 col-12 mb-2 breadcrumb-new">
                    <h3 class="content-header-title mb-0 d-inline-block">PC</h3>
                    <div class="row breadcrumbs-top d-inline-block">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">Dashboard</li>
                                <li class="breadcrumb-item active">PC</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>



            <div class="content-body">
                <section id="add-home">
                    <div class="row">
                        <div class="col-12">

                            <a href="{{ route('backsite.device_pc.create') }}" class="btn btn-success col-2 mb-2">
                                Tambah Data PC</a>

                        </div>
                    </div>
                </section>
            </div>

            {{-- table card --}}
            <div class="content-body">
                <section id="table-home">
                    <!-- Zero configuration table -->
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">List PC</h4>
                                    <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                                    <div class="heading-elements">
                                        <ul class="mb-0 list-inline">
                                            <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                            <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                                            <!-- <li><a data-action="close"><i class="ft-x"></i></a></li> -->
                                        </ul>
                                    </div>
                                </div>

                                <div class="card-content collapse show">
                                    <div class="card-body card-dashboard">

                                        <div class="table-responsive">
                                            <table
                                                class="table table-striped table-bordered text-inputs-searching default-table">
                                                <thead>
                                                    <tr>
                                                        <th style="text-align:center; width:50px;">No</th>
                                                        <th style="text-align:center;">No Asset</th>
                                                        <th style="text-align:center;">Motherboard</th>
                                                        <th style="text-align:center;">Processor</th>
                                                        <th style="text-align:center;">Hardisk</th>
                                                        <th style="text-align:center;">Ram</th>
                                                        <th style="text-align:center;">File</th>
                                                        <th style="text-align:center; width:100px;">Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @forelse($device_pc as $key => $device_pc_item)
                                                        <tr data-entry-id="{{ $device_pc_item->id }}">
                                                            <td class="text-center">{{ $loop->iteration }}</td>
                                                            <td class="text-center"> <span
                                                                    class="badge badge-success">{{ $device_pc_item->no_asset }}</span>
                                                            </td>
                                                            <td class="text-center">
                                                                {{ $device_pc_item->motherboard->name }}</td>
                                                            <td class="text-center">{{ $device_pc_item->processor->name }}
                                                            </td>
                                                            <td class="text-center">
                                                                {{-- {{ $device_pc_item->hardisk->name ? '' }} -
                                                                {{ $device_pc_item->hardisk->size ? }}
                                                                 --}}
                                                                @foreach (explode(',', $device_pc_item->hardisk_id) as $data_hardisk)
                                                                    @php
                                                                        $spek_hardisk = DB::table('hardware_hardisk')
                                                                            ->where('id', $data_hardisk)
                                                                            ->get();
                                                                    @endphp
                                                                    @foreach ($spek_hardisk as $hardisk)
                                                                        {{ $hardisk->name }} - {{ $hardisk->size }} ,
                                                                    @endforeach
                                                                @endforeach
                                                            </td>
                                                            <td class="text-center">
                                                                {{-- {{ $device_pc_item->ram->name }} -
                                                                {{ $device_pc_item->ram->size }} --}}

                                                                @foreach (explode(',', $device_pc_item->ram_id) as $data_ram)
                                                                    @php
                                                                        $spek_ram = DB::table('hardware_ram')
                                                                            ->where('id', $data_ram)
                                                                            ->get();
                                                                    @endphp
                                                                    @foreach ($spek_ram as $ram)
                                                                        {{ $ram->name }} - {{ $ram->size }} ,
                                                                    @endforeach
                                                                @endforeach
                                                            </td>
                                                            <td class="text-center">
                                                                <a data-fancybox
                                                                    data-src="{{ asset('storage/' . $device_pc_item->file) }}"
                                                                    class="blue accent-4 dropdown-item">Show</a>
                                                                {{-- <a data-fancybox="single"
                                                                    data-src="{{ asset('storage/' . $device_pc_item->file) }}"
                                                                    class="blue accent-4 dropdown-item">Show</a> --}}
                                                            </td>
                                                            <td class="text-center">
                                                                <div class="mb-1 mr-1 btn-group">
                                                                    <button type="button"
                                                                        class="btn btn-info btn-sm dropdown-toggle"
                                                                        data-toggle="dropdown" aria-haspopup="true"
                                                                        aria-expanded="false">Action</button>
                                                                    <div class="dropdown-menu">
                                                                        <a href="#mymodal"
                                                                            data-remote="{{ route('backsite.device_pc.show', encrypt($device_pc_item->id)) }}"
                                                                            data-toggle="modal" data-target="#mymodal"
                                                                            data-title="Detail Device PC"
                                                                            class="dropdown-item">
                                                                            Show
                                                                        </a>
                                                                        <a class="dropdown-item"
                                                                            href="{{ route('backsite.device_pc.edit', encrypt($device_pc_item->id)) }}">
                                                                            Edit
                                                                        </a>
                                                                        <form
                                                                            action="{{ route('backsite.device_pc.destroy', encrypt($device_pc_item->id)) }}"
                                                                            method="POST"
                                                                            onsubmit="return confirm('Anda yakin ingin menghapus data ini ?');">
                                                                            <input type="hidden" name="_method"
                                                                                value="DELETE">
                                                                            <input type="hidden" name="_token"
                                                                                value="{{ csrf_token() }}">
                                                                            <input type="submit" class="dropdown-item"
                                                                                value="Delete">
                                                                        </form>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    @empty
                                                        {{-- not found --}}
                                                    @endforelse
                                                </tbody>
                                                <tfoot hidden>
                                                    <th>No</th>
                                                    <th>No Asset</th>
                                                    <th>Motherboard</th>
                                                    <th>Processor</th>
                                                    <th>Hardisk</th>
                                                    <th>Ram</th>
                                                    <th>File</th>
                                                    <th>Action</th>
                                                </tfoot>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
            </section>
        </div>
    </div>
@endsection
@push('after-script')
    <script>
        jQuery(document).ready(function($) {
            $('#mymodal').on('show.bs.modal', function(e) {
                var button = $(e.relatedTarget);
                var modal = $(this);

                modal.find('.modal-body').load(button.data("remote"));
                modal.find('.modal-title').html(button.data("title"));
            });

        });
    </script>

    <div class="modal fade" id="mymodal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"></h5>
                    <button class="btn close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <i class="fa fa-spinner fa spin"></i>
                </div>
            </div>
        </div>
    </div>
@endpush
