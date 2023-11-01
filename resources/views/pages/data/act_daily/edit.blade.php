@extends('layouts.app')

{{-- set title --}}
@section('title', 'Aktivitas Harian')
@section('content')
  <div class="app-content content">
    <div class="content-overlay"></div>
    <div class="content-wrapper">

      <div class="content-body">
        <section id="add-home">
          <div class="row">
            <div class="col-12">
              <div class="card">
                <div class="card-header bg-success text-white">
                  <h4 class="card-title text-white">Edit Aktivitas Harian</h4>
                </div>


                <form class="form form-horizontal" action="{{ route('backsite.act_daily.update', [$actdaily->id]) }}"
                  method="POST" enctype="multipart/form-data">
                  @method('put')
                  @csrf

                  <div class="form-body mr-3">
                    <div class="form-section">
                      <p class="ml-2">Isi input <code>Required (*)</code>, Sebelum menekan tombol
                        submit. </p>
                    </div>

                    <input type="hidden" id="executor" name="executor" value="{{ isset($user_id) ? $user_id : '' }}">
                    <div class="form-group row">
                      <label class="col-md-2 label-control" for="executor">Pelaksana
                        <code style="color:red;">*</code></label>
                      <div class="col-md-4">
                        <input type="text" id="executor" class="form-control"
                          value="{{ isset($executor) ? $executor : '' }}" readonly>

                        @if ($errors->has('executor'))
                          <p style="font-style: bold; color: red;">
                            {{ $errors->first('executor') }}</p>
                        @endif
                      </div>

                      <label class="col-md-2 label-control" for="work_type_id">Jenis
                        Pekerjaan <code style="color:red;">*</code></label>
                      <div class="col-md-4">
                        <select name="work_type_id" id="work_type_id" class="form-control select2" required>
                          <option value="{{ '' }}" disabled selected>
                            Choose
                          </option>
                          @foreach ($work_type as $key => $work_type_item)
                            <option value="{{ $work_type_item->id }}"
                              {{ $work_type_item->id == $actdaily->work_type_id ? 'selected' : '' }}>
                              {{ $work_type_item->job_type }}</option>
                          @endforeach
                        </select>

                        @if ($errors->has('work_type_id'))
                          <p style="font-style: bold; color: red;">
                            {{ $errors->first('work_type_id') }}</p>
                        @endif
                      </div>
                    </div>
                    <div class="form-group row">
                      <label class="col-md-2 label-control" for="users_id">Pendamping
                      </label>
                      <div class="col-md-4">
                        <select name="users_id" id="users_id" class="form-control select2">
                          <option value="{{ '' }}" disabled selected>
                            Choose
                          </option>
                          @foreach ($user as $key => $user_item)
                            <option value="{{ $user_item->id }}"
                              {{ $user_item->id == $actdaily->users_id ? 'selected' : '' }}>
                              {{ $user_item->name }}</option>
                          @endforeach
                        </select>

                        @if ($errors->has('users_id'))
                          <p style="font-style: bold; color: red;">
                            {{ $errors->first('users_id') }}</p>
                        @endif
                      </div>
                      <label class="col-md-2 label-control" for="location_room_id">Lokasi
                      </label>
                      <div class="col-md-4">
                        <select name="location_room_id" id="location_room_id" class="form-control select2">
                          <option value="{{ '' }}" disabled selected>
                            Choose
                          </option>
                          @foreach ($location_room as $key => $location_room_item)
                            <option value="{{ $location_room_item->id }}"
                              {{ $location_room_item->id == $actdaily->location_room_id ? 'selected' : '' }}>
                              {{ $location_room_item->name }}</option>
                          @endforeach
                        </select>

                        @if ($errors->has('location_room_id'))
                          <p style="font-style: bold; color: red;">
                            {{ $errors->first('location_room_id') }}</p>
                        @endif
                      </div>
                    </div>
                    <div class="form-group row">
                      <label class="col-md-2 label-control" for="start_date">Tanggal Mulai
                        <code style="color:red;">*</code></label>
                      <div class="col-md-4">
                        <input type="datetime-local" id="start_date" name="start_date" class="form-control"
                          value="{{ old('start_date', $actdaily->start_date) }}" required>

                        @if ($errors->has('start_date'))
                          <p style="font-style: bold; color: red;">
                            {{ $errors->first('start_date') }}</p>
                        @endif
                      </div>
                      <label class="col-md-2 label-control" for="finish_date">Tanggal
                        Selesai
                      </label>
                      <div class="col-md-4">
                        <input type="datetime-local" id="finish_date" name="finish_date" class="form-control"
                          value="{{ old('finish_date', $actdaily->finish_date) }}">

                        @if ($errors->has('finish_date'))
                          <p style="font-style: bold; color: red;">
                            {{ $errors->first('finish_date') }}</p>
                        @endif
                      </div>
                    </div>
                    <div class="form-group row">
                      <label class="col-md-2 label-control" for="status">Status</label>
                      <div class="col-md-4">
                        <select name="status" id="status" class="form-control select2">
                          <option value="{{ '' }}" disabled selected>
                            Choose
                          </option>
                          <option value="1" {{ $actdaily->status == 1 ? 'selected' : '' }}>
                            Aktif
                          </option>
                          <option value="2" {{ $actdaily->status == 2 ? 'selected' : '' }}>
                            Tidak
                            Aktif
                          </option>
                        </select>

                        @if ($errors->has('status'))
                          <p style="font-style: bold; color: red;">
                            {{ $errors->first('status') }}</p>
                        @endif
                      </div>
                    </div>
                    <div class="form-group row">
                      <label class="col-md-2 label-control" for="activity">Kegiatan<code
                          style="color:red;">*</code></label>
                      <div class="col-md-10">
                        <textarea rows="5" class="form-control summernote" id="activity" name="activity" required> {{ $actdaily->activity }}</textarea>

                      </div>
                    </div>
                    <div class="form-group row">
                      <label class="col-md-2 label-control" for="description">Catatan
                      </label>
                      <div class="col-md-10">
                        <textarea rows="5" class="form-control summernote" id="description" name="description">{{ $actdaily->description }}</textarea>

                      </div>
                    </div>

                  </div>

                  <div class="form-actions ">
                    <button type="submit" style="width:120px;" class="btn btn-cyan float-right mr-2"
                      onclick="return confirm('Apakah Anda yakin ingin menyimpan data ini ?')">
                      <i class="la la-check-square-o"></i> Submit
                    </button>

                    <a href="{{ route('backsite.act_daily.index') }}" class="btn btn-success text-left ml-2">
                      <i class="la la-arrow-left"></i> Kembali</a>
                  </div>
                </form>



              </div>
            </div>
          </div>
        </section>
      </div>
    </div>
  </div>



@endsection
