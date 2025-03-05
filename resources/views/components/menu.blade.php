<!-- BEGIN: Main Menu-->
<div class="main-menu menu-fixed menu-light menu-accordion menu-shadow " data-scroll-to-active="true">
  <div class="main-menu-content">
    @if (Auth::user() != null)
      <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
        <li class="active">
          <a href="{{ route('dashboard.index') }}">
            <i
              class="{{ request()->is('backsite/dashboard') || request()->is('backsite/dashboard/*') ? 'bx bx-category-alt bx-flashing' : 'bx bx-category-alt' }}"></i>
            <span class="menu-title" data-i18n="Dashboard"><strong>Dashboard</strong></span>
          </a>
        </li>

        {{-- start --}}

        {{-- Program Kerja --}}
        {{-- @can('work_program') --}}
        <li class=" nav-item"><a href="{{ route('backsite.work_program.index') }}"><i
              class="{{ request()->is('backsite/work_program') || request()->is('backsite/work_program/*') || request()->is('backsite/*/work_program') || request()->is('backsite/*/work_program/*') ? 'bx bx-book-bookmark bx-flashing' : 'bx bx-book-bookmark' }}"></i><span
              class="menu-title primary" data-i18n="Program Kerja"><strong>Program Kerja</strong></span></a>
        </li>
        {{-- @endcan --}}
        {{-- END Program Kerja --}}

        {{-- Master Data --}}
        <li class=" nav-item"><a href="#"><i
              class="{{ request()->is('backsite/location_detail') || request()->is('backsite/location_detail/*') || request()->is('backsite/*/location_detail') || request()->is('backsite/*/location_detail/*') || request()->is('backsite/location') || request()->is('backsite/location/*') || request()->is('backsite/*/location') || request()->is('backsite/*/location/*') || request()->is('backsite/location_sub') || request()->is('backsite/location_sub/*') || request()->is('backsite/*/location_sub') || request()->is('backsite/*/location_sub/*') || request()->is('backsite/location_room') || request()->is('backsite/location_room/*') || request()->is('backsite/*/location_room') || request()->is('backsite/*/location_room/*') ? 'bx bx-briefcase bx-flashing' : 'bx bx-briefcase' }}"></i><span
              class="menu-title danger" data-i18n="Lokasi"> <strong>Master Data </strong></span></a>
          <ul class="menu-content">

            <li class=" nav-item"><a href="#"><i
                  class="{{ request()->is('backsite/location_detail') || request()->is('backsite/location_detail/*') || request()->is('backsite/*/location_detail') || request()->is('backsite/*/location_detail/*') || request()->is('backsite/location') || request()->is('backsite/location/*') || request()->is('backsite/*/location') || request()->is('backsite/*/location/*') || request()->is('backsite/location_sub') || request()->is('backsite/location_sub/*') || request()->is('backsite/*/location_sub') || request()->is('backsite/*/location_sub/*') || request()->is('backsite/location_room') || request()->is('backsite/location_room/*') || request()->is('backsite/*/location_room') || request()->is('backsite/*/location_room/*') ? 'la la-caret-right bx-flashing' : 'la la-caret-right' }}"></i><span
                  class="menu-title" data-i18n="Lokasi"> <strong>User</strong></span></a>
              <ul class="menu-content">
                {{-- @can('location_detail') --}}
                {{-- <li
                  class="{{ request()->is('backsite/user') || request()->is('backsite/user/*') || request()->is('backsite/*/user') || request()->is('backsite/*/user/*') ? 'active' : '' }} ">
                  <a class="menu-item" href="{{ route('backsite.user.index') }}">
                    <i></i><span>User Aplikasi</span>
                  </a>
                </li> --}}
                {{-- @endcan --}}

                {{-- @can('location_detail') --}}
                <li
                  class="{{ request()->is('backsite/employee') || request()->is('backsite/employee/*') || request()->is('backsite/*/employee') || request()->is('backsite/*/employee/*') ? 'active' : '' }} ">
                  <a class="menu-item" href="{{ route('backsite.employee.index') }}">
                    <i></i><span>User PC</span>
                  </a>
                </li>
                {{-- @endcan --}}
              </ul>
            </li>

            <li class=" nav-item"><a href="#"><i
                  class="{{ request()->is('backsite/location_detail') || request()->is('backsite/location_detail/*') || request()->is('backsite/*/location_detail') || request()->is('backsite/*/location_detail/*') || request()->is('backsite/location') || request()->is('backsite/location/*') || request()->is('backsite/*/location') || request()->is('backsite/*/location/*') || request()->is('backsite/location_sub') || request()->is('backsite/location_sub/*') || request()->is('backsite/*/location_sub') || request()->is('backsite/*/location_sub/*') || request()->is('backsite/location_room') || request()->is('backsite/location_room/*') || request()->is('backsite/*/location_room') || request()->is('backsite/*/location_room/*') ? 'la la-caret-right bx-flashing' : 'la la-caret-right' }}"></i><span
                  class="menu-title" data-i18n="Lokasi"> <strong>Divisi</strong></span></a>
              <ul class="menu-content">

                {{-- @can('location_sub') --}}
                <li
                  class="{{ request()->is('backsite/division') || request()->is('backsite/division/*') || request()->is('backsite/*/division') || request()->is('backsite/*/division/*') ? 'active' : '' }} ">
                  <a class="menu-item" href="{{ route('backsite.division.index') }}">
                    <i></i><span>Divisi</span>
                  </a>
                </li>
                {{-- @endcan --}}

                {{-- @can('location_sub') --}}
                <li
                  class="{{ request()->is('backsite/department') || request()->is('backsite/department/*') || request()->is('backsite/*/department') || request()->is('backsite/*/department/*') ? 'active' : '' }} ">
                  <a class="menu-item" href="{{ route('backsite.department.index') }}">
                    <i></i><span>Departemen</span>
                  </a>
                </li>
                {{-- @endcan --}}

                {{-- @can('location_sub') --}}
                <li
                  class="{{ request()->is('backsite/section') || request()->is('backsite/section/*') || request()->is('backsite/*/section') || request()->is('backsite/*/section/*') ? 'active' : '' }} ">
                  <a class="menu-item" href="{{ route('backsite.section.index') }}">
                    <i></i><span>Seksi</span>
                  </a>
                </li>
                {{-- @endcan --}}
              </ul>
            </li>

            <li class=" nav-item"><a href="#"><i
                  class="{{ request()->is('backsite/location_detail') || request()->is('backsite/location_detail/*') || request()->is('backsite/*/location_detail') || request()->is('backsite/*/location_detail/*') || request()->is('backsite/location') || request()->is('backsite/location/*') || request()->is('backsite/*/location') || request()->is('backsite/*/location/*') || request()->is('backsite/location_sub') || request()->is('backsite/location_sub/*') || request()->is('backsite/*/location_sub') || request()->is('backsite/*/location_sub/*') || request()->is('backsite/location_room') || request()->is('backsite/location_room/*') || request()->is('backsite/*/location_room') || request()->is('backsite/*/location_room/*') ? 'la la-caret-right bx-flashing' : 'la la-caret-right' }}"></i><span
                  class="menu-title" data-i18n="Lokasi"> <strong>PC </strong></span></a>
              <ul class="menu-content">

                {{-- @can('location_room') --}}
                <li
                  class="{{ request()->is('backsite/motherboard') || request()->is('backsite/motherboard/*') || request()->is('backsite/*/motherboard') || request()->is('backsite/*/motherboard/*') ? 'active' : '' }} ">
                  <a class="menu-item" href="{{ route('backsite.motherboard.index') }}">
                    <i></i><span>Motherboard</span>
                  </a>
                </li>
                {{-- @endcan --}}

                {{-- @can('location_room') --}}
                <li
                  class="{{ request()->is('backsite/processor') || request()->is('backsite/processor/*') || request()->is('backsite/*/processor') || request()->is('backsite/*/processor/*') ? 'active' : '' }} ">
                  <a class="menu-item" href="{{ route('backsite.processor.index') }}">
                    <i></i><span>Processor</span>
                  </a>
                </li>
                {{-- @endcan --}}

                {{-- @can('location_room') --}}
                <li
                  class="{{ request()->is('backsite/ram') || request()->is('backsite/ram/*') || request()->is('backsite/*/ram') || request()->is('backsite/*/ram/*') ? 'active' : '' }} ">
                  <a class="menu-item" href="{{ route('backsite.ram.index') }}">
                    <i></i><span>RAM</span>
                  </a>
                </li>
                {{-- @endcan --}}

                {{-- @can('location_room') --}}
                <li
                  class="{{ request()->is('backsite/hardisk') || request()->is('backsite/hardisk/*') || request()->is('backsite/*/hardisk') || request()->is('backsite/*/hardisk/*') ? 'active' : '' }} ">
                  <a class="menu-item" href="{{ route('backsite.hardisk.index') }}">
                    <i></i><span>Hardisk</span>
                  </a>
                </li>
                {{-- @endcan --}}

                {{-- @can('location_room')
              <li
                class="{{ request()->is('backsite/monitor') || request()->is('backsite/monitor/*') || request()->is('backsite/*/monitor') || request()->is('backsite/*/monitor/*') ? 'active' : '' }} ">
                <a class="menu-item" href="{{ route('backsite.monitor.index') }}">
                  <i></i><span>Monitor</span>
                </a>
              </li> --}}
                {{-- @endcan --}}
              </ul>
            </li>

            <li class=" nav-item"><a href="#"><i
                  class="{{ request()->is('backsite/location_detail') || request()->is('backsite/location_detail/*') || request()->is('backsite/*/location_detail') || request()->is('backsite/*/location_detail/*') || request()->is('backsite/location') || request()->is('backsite/location/*') || request()->is('backsite/*/location') || request()->is('backsite/*/location/*') || request()->is('backsite/location_sub') || request()->is('backsite/location_sub/*') || request()->is('backsite/*/location_sub') || request()->is('backsite/*/location_sub/*') || request()->is('backsite/location_room') || request()->is('backsite/location_room/*') || request()->is('backsite/*/location_room') || request()->is('backsite/*/location_room/*') ? 'la la-caret-right bx-flashing' : 'la la-caret-right' }}"></i><span
                  class="menu-title" data-i18n="Lokasi"><strong>Lokasi</strong></span></a>
              <ul class="menu-content">

                {{-- @can('location_room') --}}
                <li
                  class="{{ request()->is('backsite/location') || request()->is('backsite/location/*') || request()->is('backsite/*/location') || request()->is('backsite/*/location/*') ? 'active' : '' }} ">
                  <a class="menu-item" href="{{ route('backsite.location.index') }}">
                    <i></i><span>Lokasi Utama</span>
                  </a>
                </li>
                {{-- @endcan --}}

                {{-- @can('location_room') --}}
                <li
                  class="{{ request()->is('backsite/location_sub') || request()->is('backsite/location_sub/*') || request()->is('backsite/*/location_sub') || request()->is('backsite/*/location_sub/*') ? 'active' : '' }} ">
                  <a class="menu-item" href="{{ route('backsite.location_sub.index') }}">
                    <i></i><span>Sub Lokasi</span>
                  </a>
                </li>
                {{-- @endcan --}}

                {{-- @can('location_room') --}}
                <li
                  class="{{ request()->is('backsite/location_room') || request()->is('backsite/location_room/*') || request()->is('backsite/*/location_room') || request()->is('backsite/*/location_room/*') ? 'active' : '' }} ">
                  <a class="menu-item" href="{{ route('backsite.location_room.index') }}">
                    <i></i><span>Lokasi</span>
                  </a>
                </li>
                {{-- @endcan --}}
              </ul>
            </li>

            <li class=" nav-item"><a href="#"><i
                  class="{{ request()->is('backsite/location_detail') || request()->is('backsite/location_detail/*') || request()->is('backsite/*/location_detail') || request()->is('backsite/*/location_detail/*') || request()->is('backsite/location') || request()->is('backsite/location/*') || request()->is('backsite/*/location') || request()->is('backsite/*/location/*') || request()->is('backsite/location_sub') || request()->is('backsite/location_sub/*') || request()->is('backsite/*/location_sub') || request()->is('backsite/*/location_sub/*') || request()->is('backsite/location_room') || request()->is('backsite/location_room/*') || request()->is('backsite/*/location_room') || request()->is('backsite/*/location_room/*') ? 'la la-caret-right bx-flashing' : 'la la-caret-right' }}"></i><span
                  class="menu-title" data-i18n="Latol"><strong>Lattol</strong></span></a>
              <ul class="menu-content">

                {{-- @can('location_room') --}}
                {{-- <li
                  class="{{ request()->is('backsite/asset-latol') || request()->is('backsite/asset-latol/*') || request()->is('backsite/*/asset-latol') || request()->is('backsite/*/asset-latol/*') ? 'active' : '' }} ">
                  <a class="menu-item" href="{{ route('backsite.barang.assetLatol') }}">
                    <i></i><span>Jenis Peralatan</span>
                  </a>
                </li> --}}
                {{-- @endcan --}}

                {{-- @can('location_room') --}}
                <li
                  class="{{ request()->is('backsite/type-asset') || request()->is('backsite/type-asset/*') || request()->is('backsite/*/type-asset') || request()->is('backsite/*/type-asset/*') ? 'active' : '' }} ">
                  <a class="menu-item" href="{{ route('backsite.type-asset.index') }}">
                    <i></i><span>Jenis Peralatan</span>
                  </a>
                </li>
                {{-- @endcan --}}

                {{-- @can('location_room') --}}
                <li
                  class="{{ request()->is('backsite/asset-indicator') || request()->is('backsite/asset-indicator/*') || request()->is('backsite/*/asset-indicator') || request()->is('backsite/*/asset-indicator/*') ? 'active' : '' }} ">
                  <a class="menu-item" href="{{ route('backsite.asset-indicator.index') }}">
                    <i></i><span>Indikator</span>
                  </a>
                </li>
                {{-- @endcan --}}

              </ul>
            </li>

            {{-- @can('location') --}}
            <li
              class="{{ request()->is('backsite/jobdesk') || request()->is('backsite/jobdesk/*') || request()->is('backsite/*/jobdesk') || request()->is('backsite/*/jobdesk/*') ? 'active' : '' }} ">
              <a class="menu-item" href="{{ route('backsite.jobdesk.index') }}">
                <i></i><span>Jobdesk</span>
              </a>
            </li>
            {{-- @endcan --}}

            {{-- @can('location_room') --}}
            <li
              class="{{ request()->is('backsite/vendor_ti') || request()->is('backsite/vendor_ti/*') || request()->is('backsite/*/vendor_ti') || request()->is('backsite/*/vendor_ti/*') ? 'active' : '' }} ">
              <a class="menu-item" href="{{ route('backsite.vendor_ti.index') }}">
                <i></i><span>Vendor TI</span>
              </a>
            </li>
            {{-- @endcan --}}

            {{-- @can('location_room') --}}
            <li
              class="{{ request()->is('backsite/information') || request()->is('backsite/information/*') || request()->is('backsite/*/information') || request()->is('backsite/*/information/*') ? 'active' : '' }} ">
              <a class="menu-item" href="{{ route('backsite.information.index') }}">
                <i></i><span>Informasi</span>
              </a>
            </li>
            {{-- @endcan --}}

            {{-- @can('location_room') --}}
            <li
              class="{{ request()->is('backsite/form') || request()->is('backsite/form/*') || request()->is('backsite/*/form') || request()->is('backsite/*/form/*') ? 'active' : '' }} ">
              <a class="menu-item" href="{{ route('backsite.form.index') }}">
                <i></i><span>Form </span>
              </a>
            </li>
            {{-- @endcan --}}

            {{-- @can('location_room') 
          <li
            class="{{ request()->is('backsite/barang') || request()->is('backsite/barang/*') || request()->is('backsite/*/barang') || request()->is('backsite/*/barang/*') ? 'active' : '' }} ">
            <a class="menu-item" href="{{ route('backsite.barang.index') }}">
              <i></i><span>Barang</span>
            </a>
          </li>
           @endcan --}}

          </ul>
        </li>
        {{-- END Master Data --}}

        {{-- Administrasi --}}
        <li class=" nav-item"><a href="{{ route('backsite.software.index') }}"><i
              class="{{ request()->is('backsite/software') || request()->is('backsite/software/*') || request()->is('backsite/*/software') || request()->is('backsite/*/software/*') ? 'la la-file-text bx-flashing' : 'la la-file-text' }}"></i><span
              class="menu-title success" data-i18n="Software"><strong>Administrasi</strong></span></a>
          <ul class="menu-content">

            {{-- @can('location_detail') --}}
            {{-- <li
              class="{{ request()->is('backsite/location_detail') || request()->is('backsite/location_detail/*') || request()->is('backsite/*/location_detail') || request()->is('backsite/*/location_detail/*') ? 'active' : '' }} ">
              <a class="menu-item" href="{{ route('backsite.location_detail.index') }}">
                <i></i><span>Job Desk</span>
              </a>
            </li> --}}
            {{-- @endcan --}}

            {{-- @can('location_detail') --}}
            <li
              class="{{ request()->is('backsite/attendance') || request()->is('backsite/attendance/*') || request()->is('backsite/*/attendance') || request()->is('backsite/*/attendance/*') ? 'active' : '' }} ">
              <a class="menu-item" href="{{ route('backsite.attendance.index') }}">
                <i></i><span>Absensi</span>
              </a>
            </li>
            {{-- @endcan --}}

            {{-- @can('location_detail') --}}
            <li
              class="{{ request()->is('backsite/pp') || request()->is('backsite/pp/*') || request()->is('backsite/*/pp') || request()->is('backsite/*/pp/*') ? 'active' : '' }} ">
              <a class="menu-item" href="{{ route('backsite.pp.index') }}">
                <i></i><span>PR</span>
              </a>
            </li>
            {{-- @endcan --}}

            {{-- @can('location_detail') --}}
            <li
              class="{{ request()->is('backsite/bill') || request()->is('backsite/bill/*') || request()->is('backsite/*/bill') || request()->is('backsite/*/bill/*') ? 'active' : '' }} ">
              <a class="menu-item" href="{{ route('backsite.bill.index') }}">
                <i></i><span>Tagihan</span>
              </a>
            </li>
            {{-- @endcan --}}

            {{-- @can('location_detail') --}}
            <li
              class="{{ request()->is('backsite/letter') || request()->is('backsite/letter/*') || request()->is('backsite/*/letter') || request()->is('backsite/*/letter/*') ? 'active' : '' }} ">
              <a class="menu-item" href="{{ route('backsite.letter.index') }}">
                <i></i><span>Surat Keluar/Masuk</span>
              </a>
            </li>
            {{-- @endcan --}}

            {{-- @can('location_detail') --}}
            <li
              class="{{ request()->is('backsite/demand') || request()->is('backsite/demand/*') || request()->is('backsite/*/demand') || request()->is('backsite/*/demand/*') ? 'active' : '' }} ">
              <a class="menu-item" href="{{ route('backsite.demand.index') }}">
                <i></i><span>Permintaan Uang</span>
              </a>
            </li>
            {{-- @endcan --}}

            {{-- @can('location_detail') --}}
            <li
              class="{{ request()->is('backsite/atk') || request()->is('backsite/atk/*') || request()->is('backsite/*/atk') || request()->is('backsite/*/atk/*') ? 'active' : '' }} ">
              <a class="menu-item" href="{{ route('backsite.atk.index') }}">
                <i></i><span>ATK</span>
              </a>
            </li>
            {{-- @endcan --}}

            {{-- @can('location_detail') --}}
            <li
              class="{{ request()->is('backsite/lendingfacility') || request()->is('backsite/lendingfacility/*') || request()->is('backsite/*/lendingfacility') || request()->is('backsite/*/lendingfacility/*') ? 'active' : '' }} ">
              <a class="menu-item" href="{{ route('backsite.lendingfacility.index') }}">
                <i></i><span>Peminjaman TI</span>
              </a>
            </li>
            {{-- @endcan --}}

            {{-- @can('location_detail') --}}
            <li
              class="{{ request()->is('backsite/form_ti') || request()->is('backsite/form_ti/*') || request()->is('backsite/*/form_ti') || request()->is('backsite/*/form_ti/*') ? 'active' : '' }} ">
              <a class="menu-item" href="{{ route('backsite.form_ti.index') }}">
                <i></i><span>Form TI</span>
              </a>
            </li>
            {{-- @endcan --}}
          </ul>
        </li>
        {{-- END Administrasi --}}

        {{-- Sistem Informasi --}}
        <li class=" nav-item"><a href="{{ route('backsite.software.index') }}"><i
              class="{{ request()->is('backsite/software') || request()->is('backsite/software/*') || request()->is('backsite/*/software') || request()->is('backsite/*/software/*') ? 'la la-android bx-flashing' : 'la la-android' }}"></i><span
              class="menu-title info" data-i18n="Software"><strong>Sistem Informasi</strong></span></a>
          <ul class="menu-content">

            {{-- @can('location_detail') --}}
            <li class=" nav-item"><a href="{{ route('backsite.software.index') }}"><i
                  class="{{ request()->is('backsite/application') || request()->is('backsite/application/*') || request()->is('backsite/*/application') || request()->is('backsite/*/application/*') ? 'la la-caret-right bx-flashing' : 'la la-caret-right' }}"></i>
                <span class="menu-item" data-i18n="application"><strong>Application</strong></span></a>
              <ul class="menu-content">
                {{-- @endcan --}}

                {{-- @can('location_detail') --}}
                <li
                  class="{{ request()->is('backsite/application') || request()->is('backsite/application/*') || request()->is('backsite/*/application') || request()->is('backsite/*/application/*') ? 'active' : '' }} ">
                  <a class="menu-item" href="{{ route('backsite.application.index') }}">
                    <i></i><span>Aplikasi</span>
                  </a>
                </li>
                {{-- @endcan --}}

                {{-- @can('location_detail') --}}
                <li
                  class="{{ request()->is('backsite/license') || request()->is('backsite/license/*') || request()->is('backsite/*/license') || request()->is('backsite/*/license/*') ? 'active' : '' }} ">
                  <a class="menu-item" href="{{ route('backsite.license.index') }}">
                    <i></i><span>Lisensi</span>
                  </a>
                </li>
                {{-- @endcan --}}

                {{-- @can('location_detail') --}}
                <li
                  class="{{ request()->is('backsite/drc') || request()->is('backsite/drc/*') || request()->is('backsite/*/drc') || request()->is('backsite/*/drc/*') ? 'active' : '' }} ">
                  <a class="menu-item" href="{{ route('backsite.drc.index') }}">
                    <i></i><span>DRC & Back Up</span>
                  </a>
                </li>
                {{-- @endcan --}}

                {{-- @can('location_detail') --}}
                <li
                  class="{{ request()->is('backsite/antivirus') || request()->is('backsite/antivirus/*') || request()->is('backsite/*/antivirus') || request()->is('backsite/*/antivirus/*') ? 'active' : '' }} ">
                  <a class="menu-item" href="{{ route('backsite.antivirus.index') }}">
                    <i></i><span>Antivirus</span>
                  </a>
                </li>
                {{-- @endcan --}}

                {{-- @can('location_detail') --}}
                <li
                  class="{{ request()->is('backsite/pp') || request()->is('backsite/pp/*') || request()->is('backsite/*/pp') || request()->is('backsite/*/pp/*') ? 'active' : '' }} ">
                  <a class="menu-item" href="{{ route('backsite.pp.index') }}">
                    <i></i><span>PP</span>
                  </a>
                </li>
                {{-- @endcan --}}

                {{-- @can('location_detail') --}}
                <li
                  class="{{ request()->is('backsite/tpt') || request()->is('backsite/tpt/*') || request()->is('backsite/*/tpt') || request()->is('backsite/*/tpt/*') ? 'active' : '' }} ">
                  <a class="menu-item" href="{{ route('backsite.tpt.index') }}">
                    <i></i><span>TPT</span>
                  </a>
                </li>
              </ul>
              {{-- @endcan --}}

              {{-- @can('location_detail') --}}
            <li class=" nav-item"><a href="{{ route('backsite.software.index') }}"><i
                  class="{{ request()->is('backsite/software') || request()->is('backsite/software/*') || request()->is('backsite/*/software') || request()->is('backsite/*/software/*') ? 'la la-caret-right bx-flashing' : 'la la-caret-right' }}"></i><span
                  class="menu-title" data-i18n="Software"><strong>Monitoring</strong></span></a>
              <ul class="menu-content">
                <li
                  class="{{ request()->is('backsite/application-monitoring') || request()->is('backsite/application-monitoring/*') || request()->is('backsite/*/application-monitoring') || request()->is('backsite/*/application-monitoring/*') ? 'active' : '' }} ">
                  <a class="menu-item" href="{{ route('backsite.application-monitoring.index') }}">
                    <i></i><span>Aplikasi</span>
                  </a>
                </li>
                <li
                  class="{{ request()->is('backsite/drc-monitoring') || request()->is('backsite/drc-monitoring/*') || request()->is('backsite/*/drc-monitoring') || request()->is('backsite/*/drc-monitoring/*') ? 'active' : '' }} ">
                  <a class="menu-item" href="{{ route('backsite.drc-monitoring.index') }}">
                    <i></i><span>DRC & Back Up</span>
                  </a>
                </li>
                <li
                  class="{{ request()->is('backsite/tpt') || request()->is('backsite/tpt/*') || request()->is('backsite/*/tpt') || request()->is('backsite/*/tpt/*') ? 'active' : '' }} ">
                  <a class="menu-item" href="{{ route('backsite.tpt.index') }}">
                    <i></i><span>TPT</span>
                  </a>
                </li>
              </ul>
            </li>
            {{-- @endcan --}}
          </ul>
        </li>
        {{-- END Sistem Informasi --}}

        {{-- Jaringan/Hardware --}}
        <li class=" nav-item"><a href="{{ route('backsite.software.index') }}"><i
              class="{{ request()->is('backsite/software') || request()->is('backsite/software/*') || request()->is('backsite/*/software') || request()->is('backsite/*/software/*') ? 'bx bx-network-chart bx-flashing' : 'bx bx-network-chart' }}"></i><span
              class="menu-title warning" data-i18n="Software"><strong>Jaringan/Hardware</strong></span></a>
          <ul class="menu-content">

            {{-- @can('location_detail') --}}
            <li
              class="{{ request()->is('backsite/ip_phone') || request()->is('backsite/ip_phone/*') || request()->is('backsite/*/ip_phone') || request()->is('backsite/*/ip_phone/*') ? 'active' : '' }} ">
              <a class="menu-item" href="{{ route('backsite.ip_phone.index') }}">
                <i></i><span>IP Phone</span>
              </a>
            </li>
            {{-- @endcan --}}

            {{-- @can('location_detail') --}}
            <li
              class="{{ request()->is('backsite/cctv') || request()->is('backsite/cctv/*') || request()->is('backsite/*/cctv') || request()->is('backsite/*/cctv/*') ? 'active' : '' }} ">
              <a class="menu-item" href="{{ route('backsite.cctv.index') }}">
                <i></i><span>CCTV</span>
              </a>
            </li>
            {{-- @endcan --}}

            {{-- @can('location_detail') --}}
            <li
              class="{{ request()->is('backsite/distribution') || request()->is('backsite/distribution/*') || request()->is('backsite/*/distribution') || request()->is('backsite/*/distribution/*') ? 'active' : '' }} ">
              <a class="menu-item" href="{{ route('backsite.distribution.index') }}">
                <i></i><span>Aset Deployment</span>
              </a>
            </li>
            {{-- @endcan --}}

            {{-- @can('location_detail') --}}
            <li
              class="{{ request()->is('backsite/barang') || request()->is('backsite/*/barang/*') ? 'active' : '' }} ">
              <a class="menu-item" href="{{ route('backsite.barang.index') }}">
                <i></i><span>Hardware</span>
              </a>
            </li>
            {{-- @endcan --}}

            <li class=" nav-item"><a href="{{ route('backsite.software.index') }}" hidden><i
                  class="{{ request()->is('backsite/software') || request()->is('backsite/software/*') || request()->is('backsite/*/software') || request()->is('backsite/*/software/*') ? 'la la-caret-right bx-flashing' : 'la la-caret-right' }}"></i><span
                  class="menu-title" data-i18n="Software"><strong>Monitoring</strong></span></a>
              <ul class="menu-content">

                {{-- @can('location_detail') --}}
                <li
                  class="{{ request()->is('backsite/location_detail') || request()->is('backsite/location_detail/*') || request()->is('backsite/*/location_detail') || request()->is('backsite/*/location_detail/*') ? 'active' : '' }} ">
                  <a class="menu-item" href="{{ route('backsite.location_detail.index') }}">
                    <i></i><span>IP Phone</span>
                  </a>
                </li>
                {{-- @endcan --}}

                {{-- @can('location_detail') --}}
                <li
                  class="{{ request()->is('backsite/location_detail') || request()->is('backsite/location_detail/*') || request()->is('backsite/*/location_detail') || request()->is('backsite/*/location_detail/*') ? 'active' : '' }} ">
                  <a class="menu-item" href="{{ route('backsite.location_detail.index') }}">
                    <i></i><span>CCTV</span>
                  </a>
                </li>
                {{-- @endcan --}}

                {{-- @can('location_detail') --}}
                <li
                  class="{{ request()->is('backsite/location_detail') || request()->is('backsite/location_detail/*') || request()->is('backsite/*/location_detail') || request()->is('backsite/*/location_detail/*') ? 'active' : '' }} ">
                  <a class="menu-item" href="{{ route('backsite.location_detail.index') }}">
                    <i></i><span>Exchange</span>
                  </a>
                </li>
                {{-- @endcan --}}

              </ul>
          </ul>
        </li>
        {{-- END Jaringan --}}

        {{-- Lattol --}}
        <li class=" nav-item"><a href="{{ route('backsite.software.index') }}" hidden><i
              class="{{ request()->is('backsite/software') || request()->is('backsite/software/*') || request()->is('backsite/*/software') || request()->is('backsite/*/software/*') ? 'la la-area-chart bx-flashing' : 'la la-area-chart' }}"></i><span
              class="menu-title amber" data-i18n="Software"><strong>Lattol</strong></span></a>
          <ul class="menu-content">

            {{-- @can('location_detail') --}}
            <li
              class="{{ request()->is('backsite/location_detail') || request()->is('backsite/location_detail/*') || request()->is('backsite/*/location_detail') || request()->is('backsite/*/location_detail/*') ? 'active' : '' }} ">
              <a class="menu-item" href="{{ route('backsite.location_detail.index') }}">
                <i></i><span>Data PPFTI</span>
              </a>
            </li>
            {{-- @endcan --}}

            {{-- @can('location_detail') --}}
            <li
              class="{{ request()->is('backsite/location_detail') || request()->is('backsite/location_detail/*') || request()->is('backsite/*/location_detail') || request()->is('backsite/*/location_detail/*') ? 'active' : '' }} ">
              <a class="menu-item" href="{{ route('backsite.location_detail.index') }}">
                <i></i><span>Data LK</span>
              </a>
            </li>
            {{-- @endcan --}}

            {{-- @can('location_detail') --}}
            <li
              class="{{ request()->is('backsite/location_detail') || request()->is('backsite/location_detail/*') || request()->is('backsite/*/location_detail') || request()->is('backsite/*/location_detail/*') ? 'active' : '' }} ">
              <a class="menu-item" href="{{ route('backsite.location_detail.index') }}">
                <i></i><span>Maintenance PC</span>
              </a>
            </li>
            {{-- @endcan --}}

            {{-- @can('location_detail') --}}
            <li
              class="{{ request()->is('backsite/location_detail') || request()->is('backsite/location_detail/*') || request()->is('backsite/*/location_detail') || request()->is('backsite/*/location_detail/*') ? 'active' : '' }} ">
              <a class="menu-item" href="{{ route('backsite.location_detail.index') }}">
                <i></i><span>Inventaris Hardware</span>
              </a>
            </li>
            {{-- @endcan --}}
          </ul>
        </li>
        {{-- END Lattol --}}

        {{-- TPT --}}
        <li class=" nav-item"><a href="{{ route('backsite.software.index') }}" hidden><i
              class="{{ request()->is('backsite/software') || request()->is('backsite/software/*') || request()->is('backsite/*/software') || request()->is('backsite/*/software/*') ? 'la la-line-chart bx-flashing' : 'la la-line-chart' }}"></i><span
              class="menu-title teal" data-i18n="Software"><strong>TPT</strong></span></a>
          <ul class="menu-content">

            {{-- @can('location_detail') --}}
            <li
              class="{{ request()->is('backsite/location_detail') || request()->is('backsite/location_detail/*') || request()->is('backsite/*/location_detail') || request()->is('backsite/*/location_detail/*') ? 'active' : '' }} ">
              <a class="menu-item" href="{{ route('backsite.location_detail.index') }}">
                <i></i><span>Data Maintenance</span>
              </a>
            </li>
            {{-- @endcan --}}

            {{-- @can('location_detail') --}}
            <li
              class="{{ request()->is('backsite/location_detail') || request()->is('backsite/location_detail/*') || request()->is('backsite/*/location_detail') || request()->is('backsite/*/location_detail/*') ? 'active' : '' }} ">
              <a class="menu-item" href="{{ route('backsite.location_detail.index') }}">
                <i></i><span>Pendapatan</span>
              </a>
            </li>
            {{-- @endcan --}}

            {{-- @can('location_detail') --}}
            <li
              class="{{ request()->is('backsite/location_detail') || request()->is('backsite/location_detail/*') || request()->is('backsite/*/location_detail') || request()->is('backsite/*/location_detail/*') ? 'active' : '' }} ">
              <a class="menu-item" href="{{ route('backsite.location_detail.index') }}">
                <i></i><span>Lain-lain</span>
              </a>
            </li>
            {{-- @endcan --}}
          </ul>
        </li>
        {{-- END TPT --}}

        {{-- Link Aplikasi --}}
        <li class=" nav-item"><a href="{{ route('backsite.application.app_link') }}" hidden><i
              class="{{ request()->is('backsite/mainbacksite.application.app_link') || request()->is('backsite/application.app_link/*') || request()->is('backsite/*/application.app_link') || request()->is('backsite/*/application.app_link/*') ? 'la la-share-alt bx-flashing' : 'la la-share-alt' }}"></i><span
              class="menu-title pink" data-i18n="application.app_link"><strong>Link Aplikasi</strong></span></a> </li>
        {{-- END Link Aplikasi --}}

        {{-- Maintenance --}}
        <li class=" nav-item"><a href="{{ route('backsite.maintenance.index') }}"><i
              class="{{ request()->is('backsite/mainbacksite.maintenance.index') || request()->is('backsite/mainbacksite.maintenance.index/*') || request()->is('backsite/*/mainbacksite.maintenance.index') || request()->is('backsite/*/mainbacksite.maintenance.index/*') ? 'la la-wrench bx-flashing' : 'la la-wrench' }}"></i><span
              class="menu-title purple bg-darken-4" data-i18n="mainbacksite.maintenance.index">
              <strong>Laporan Gangguan</strong></span></a>
        </li>
        {{-- END Maintenance --}}

        {{-- Kegiatan Harian --}}
        <li class=" nav-item"><a href="{{ route('backsite.act_daily.index') }}"><i
              class="{{ request()->is('backsite/act_daily') || request()->is('backsite/act_daily/*') || request()->is('backsite/*/act_daily') || request()->is('backsite/*/act_daily/*') ? 'bx bx-code-block bx-flashing' : 'bx bx-code-block' }}"></i><span
              class="menu-title cyan" data-i18n="Aktivitas Harian">
              <strong>Aktivitas Harian</strong></span></a>
          <ul class="menu-content">
            {{-- @can('location_detail') --}}
            <li
              class="{{ request()->is('backsite/act_daily') || request()->is('backsite/act_daily/*') || request()->is('backsite/*/act_daily') || request()->is('backsite/*/act_daily/*') ? 'active' : '' }} ">
              <a class="menu-item" href="{{ route('backsite.act_daily.index') }}">
                <i></i><span>Daily Activity</span>
              </a>
            </li>
            {{-- @can('location_detail') --}}
            <li
              class="{{ request()->is('backsite/workcat') || request()->is('backsite/workcat/*') || request()->is('backsite/*/workcat') || request()->is('backsite/*/workcat/*') ? 'active' : '' }} ">
              <a class="menu-item" href="{{ route('backsite.workcat.index') }}">
                <i></i><span>Jenis Pekerjaan</span>
              </a>
            </li>
        </li>
      </ul>

      {{-- END Kegiatan Harian --}}
      @if (Auth::user()->hasRole('super-admin'))
        {{-- @role('super-admin') --}}
        {{-- @can('management_access') --}}
        <li class="nav-item"><a href="#"><i
              class="{{ request()->is('backsite/user') || request()->is('backsite/user/*') || request()->is('backsite/*/user') || request()->is('backsite/*/user/*') || request()->is('backsite/type_user') || request()->is('backsite/type_user/*') || request()->is('backsite/*/type_user') || request()->is('backsite/*/type_user/*') ? 'bx bx-group bx-flashing' : 'bx bx-group' }}"></i><span
              class="menu-title" data-i18n="Management Access">Management Access</span></a>
          <ul class="menu-content">
            {{-- @can('type_user_access') --}}
            <li
              class="{{ request()->is('permission') || request()->is('permission/*') || request()->is('*/permission') || request()->is('*/permission/*') ? 'active' : '' }} ">
              <a class="menu-item" href="{{ route('permission.index') }}">
                <i></i><span>Permission</span>
              </a>
            </li>

            <li
              class="{{ request()->is('role') || request()->is('role/*') || request()->is('*/role') || request()->is('*/role/*') ? 'active' : '' }} ">
              <a class="menu-item" href="{{ route('role.index') }}">
                <i></i><span>Role</span>
              </a>
            </li>

            <li
              class="{{ request()->is('job-position') || request()->is('job-position/*') || request()->is('*/job-position') || request()->is('*/job-position/*') ? 'active' : '' }} ">
              <a class="menu-item" href="{{ route('job-position.index') }}">
                <i></i><span>Job Position</span>
              </a>
            </li>
            {{-- <li
              class="{{ request()->is('backsite/type_user') || request()->is('backsite/type_user/*') || request()->is('backsite/*/type_user') || request()->is('backsite/*/type_user/*') ? 'active' : '' }} ">
              <a class="menu-item" href="{{ route('backsite.type_user.index') }}">
                <i></i><span>Type User</span>
              </a>
            </li> --}}
            {{-- @endcan --}}
            {{-- @can('user_access') --}}
            <li
              class="{{ request()->is('user') || request()->is('user/*') || request()->is('*/user') || request()->is('*/user/*') ? 'active' : '' }} ">
              <a class="menu-item" href="{{ route('user.index') }}">
                <i></i><span>User</span>
              </a>
            </li>
            {{-- @endcan --}}
          </ul>
        </li>
        {{-- @endcan --}}
        {{-- @endrole --}}
      @endif


      {{-- @can('setting') --}}
      <li class=" nav-item"><a href="#"><i
            class="{{ request()->is('logout') || request()->is('backsite/profile') || request()->is('backsite/profile/*') || request()->is('backsite/*/profile') || request()->is('backsite/*/profile/*') ? 'bx bx-brightness bx-flashing' : 'bx bx-brightness' }}"></i><span
            class="menu-title" data-i18n="Setting">Setting</span></a>
        <ul class="menu-content">
          {{-- @can('profile') --}}
          <li
            class="{{ request()->is('backsite/profile') || request()->is('backsite/profile/*') || request()->is('backsite/*/profile') || request()->is('backsite/*/profile/*') ? 'active' : '' }} ">
            <a class="menu-item" href="{{ route('backsite.profile.index') }}">
              <i></i><span>Profil</span>
            </a>
          </li>
          {{-- @endcan --}}

          {{-- @can('logout') --}}
          <li class="{{ request()->is('logout') ? 'active' : '' }} ">
            <a class="menu-item" href="{{ route('logout') }}"
              onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
              <i></i><span>Logout</span>
              <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
              </form>
            </a>
          </li>
        </ul>
      </li>
      {{-- END --}}
      </ul>
    @endif
  </div>
</div>

<!-- END: Main Menu-->
