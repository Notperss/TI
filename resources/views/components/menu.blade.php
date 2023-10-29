<!-- BEGIN: Main Menu-->
<div class="main-menu menu-fixed menu-light menu-accordion menu-shadow " data-scroll-to-active="true">
  <div class="main-menu-content">
    <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
      <li class="active">
        <a href="{{ route('backsite.dashboard.index') }}">
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

          {{-- @can('location_detail') --}}
          <li
            class="{{ request()->is('backsite/user') || request()->is('backsite/user/*') || request()->is('backsite/*/user') || request()->is('backsite/*/user/*') ? 'active' : '' }} ">
            <a class="menu-item" href="{{ route('backsite.user.index') }}">
              <i></i><span>User Aplikasi</span>
            </a>
          </li>
          {{-- @endcan --}}

          {{-- @can('location_detail') --}}
          <li
            class="{{ request()->is('backsite/employee') || request()->is('backsite/employee/*') || request()->is('backsite/*/employee') || request()->is('backsite/*/employee/*') ? 'active' : '' }} ">
            <a class="menu-item" href="{{ route('backsite.employee.index') }}">
              <i></i><span>User PC</span>
            </a>
          </li>
          {{-- @endcan --}}

          {{-- @can('location_detail') --}}
          <li
            class="{{ request()->is('backsite/device_pc') || request()->is('backsite/device_pc/*') || request()->is('backsite/*/device_pc') || request()->is('backsite/*/device_pc/*') ? 'active' : '' }} ">
            <a class="menu-item" href="{{ route('backsite.device_pc.index') }}">
              <i></i><span>PC</span>
            </a>
          </li>
          {{-- @endcan --}}

          {{-- @can('location') --}}
          <li
            class="{{ request()->is('backsite/jobdesk') || request()->is('backsite/jobdesk/*') || request()->is('backsite/*/jobdesk') || request()->is('backsite/*/jobdesk/*') ? 'active' : '' }} ">
            <a class="menu-item" href="{{ route('backsite.jobdesk.index') }}">
              <i></i><span>Jobdesk</span>
            </a>
          </li>
          {{-- @endcan --}}

          {{-- @can('location_sub') --}}
          <li
            class="{{ request()->is('backsite/division') || request()->is('backsite/division/*') || request()->is('backsite/*/division') || request()->is('backsite/*/division/*') ? 'active' : '' }} ">
            <a class="menu-item" href="{{ route('backsite.division.index') }}">
              <i></i><span>Divisi</span>
            </a>
          </li>
          {{-- @endcan --}}

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

          {{-- @can('location_room') --}}
          <li
            class="{{ request()->is('backsite/monitor') || request()->is('backsite/monitor/*') || request()->is('backsite/*/monitor') || request()->is('backsite/*/monitor/*') ? 'active' : '' }} ">
            <a class="menu-item" href="{{ route('backsite.monitor.index') }}">
              <i></i><span>Monitor</span>
            </a>
          </li>
          {{-- @endcan --}}

          {{-- @can('location_room') --}}
          <li
            class="{{ request()->is('backsite/location') || request()->is('backsite/location/*') || request()->is('backsite/*/location') || request()->is('backsite/*/location/*') ? 'active' : '' }} ">
            <a class="menu-item" href="{{ route('backsite.location.index') }}">
              <i></i><span>Lokasi</span>
            </a>
          </li>
          {{-- @endcan --}}

          {{-- @can('location_room') --}}
          <li
            class="{{ request()->is('backsite/location_room') || request()->is('backsite/location_room/*') || request()->is('backsite/*/location_room') || request()->is('backsite/*/location_room/*') ? 'active' : '' }} ">
            <a class="menu-item" href="{{ route('backsite.location_room.index') }}">
              <i></i><span>Ruangan</span>
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
              <i></i><span>Informasi </span>
            </a>
          </li>
          {{-- @endcan --}}

        </ul>
      </li>
      {{-- END Master Data --}}

      {{-- Administrasi --}}
      <li class=" nav-item"><a href="{{ route('backsite.software.index') }}"><i
            class="{{ request()->is('backsite/software') || request()->is('backsite/software/*') || request()->is('backsite/*/software') || request()->is('backsite/*/software/*') ? 'la la-file-text bx-flashing' : 'la la-file-text' }}"></i><span
            class="menu-title success" data-i18n="Software"><strong>Administrasi</strong></span></a>
        <ul class="menu-content">

          {{-- @can('location_detail') --}}
          <li
            class="{{ request()->is('backsite/location_detail') || request()->is('backsite/location_detail/*') || request()->is('backsite/*/location_detail') || request()->is('backsite/*/location_detail/*') ? 'active' : '' }} ">
            <a class="menu-item" href="{{ route('backsite.location_detail.index') }}">
              <i></i><span>Job Desk</span>
            </a>
          </li>
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
            class="{{ request()->is('backsite/location_detail') || request()->is('backsite/location_detail/*') || request()->is('backsite/*/location_detail') || request()->is('backsite/*/location_detail/*') ? 'active' : '' }} ">
            <a class="menu-item" href="{{ route('backsite.location_detail.index') }}">
              <i></i><span>PP</span>
            </a>
          </li>
          {{-- @endcan --}}

          {{-- @can('location_detail') --}}
          <li
            class="{{ request()->is('backsite/location_detail') || request()->is('backsite/location_detail/*') || request()->is('backsite/*/location_detail') || request()->is('backsite/*/location_detail/*') ? 'active' : '' }} ">
            <a class="menu-item" href="{{ route('backsite.location_detail.index') }}">
              <i></i><span>Tagihan</span>
            </a>
          </li>
          {{-- @endcan --}}

          {{-- @can('location_detail') --}}
          <li
            class="{{ request()->is('backsite/location_detail') || request()->is('backsite/location_detail/*') || request()->is('backsite/*/location_detail') || request()->is('backsite/*/location_detail/*') ? 'active' : '' }} ">
            <a class="menu-item" href="{{ route('backsite.location_detail.index') }}">
              <i></i><span>Surat Keluar/Masuk</span>
            </a>
          </li>
          {{-- @endcan --}}

          {{-- @can('location_detail') --}}
          <li
            class="{{ request()->is('backsite/location_detail') || request()->is('backsite/location_detail/*') || request()->is('backsite/*/location_detail') || request()->is('backsite/*/location_detail/*') ? 'active' : '' }} ">
            <a class="menu-item" href="{{ route('backsite.location_detail.index') }}">
              <i></i><span>Memo</span>
            </a>
          </li>
          {{-- @endcan --}}

          {{-- @can('location_detail') --}}
          <li
            class="{{ request()->is('backsite/location_detail') || request()->is('backsite/location_detail/*') || request()->is('backsite/*/location_detail') || request()->is('backsite/*/location_detail/*') ? 'active' : '' }} ">
            <a class="menu-item" href="{{ route('backsite.location_detail.index') }}">
              <i></i><span>PJ</span>
            </a>
          </li>
          {{-- @endcan --}}

          {{-- @can('location_detail') --}}
          <li
            class="{{ request()->is('backsite/location_detail') || request()->is('backsite/location_detail/*') || request()->is('backsite/*/location_detail') || request()->is('backsite/*/location_detail/*') ? 'active' : '' }} ">
            <a class="menu-item" href="{{ route('backsite.location_detail.index') }}">
              <i></i><span>Kendaraan</span>
            </a>
          </li>
          {{-- @endcan --}}

          {{-- @can('location_detail') --}}
          <li
            class="{{ request()->is('backsite/location_detail') || request()->is('backsite/location_detail/*') || request()->is('backsite/*/location_detail') || request()->is('backsite/*/location_detail/*') ? 'active' : '' }} ">
            <a class="menu-item" href="{{ route('backsite.location_detail.index') }}">
              <i></i><span>Tagihan</span>
            </a>
          </li>
          {{-- @endcan --}}
        </ul>
      </li>
      {{-- END Administrasi --}}

      {{-- SI --}}
      <li class=" nav-item"><a href="{{ route('backsite.software.index') }}"><i
            class="{{ request()->is('backsite/software') || request()->is('backsite/software/*') || request()->is('backsite/*/software') || request()->is('backsite/*/software/*') ? 'la la-android bx-flashing' : 'la la-android' }}"></i><span
            class="menu-title info" data-i18n="Software"><strong>Sistem Informasi</strong></span></a>
        <ul class="menu-content">

          {{-- @can('location_detail') --}}
          <li
            class="{{ request()->is('backsite/location_detail') || request()->is('backsite/location_detail/*') || request()->is('backsite/*/location_detail') || request()->is('backsite/*/location_detail/*') ? 'active' : '' }} ">
            <a class="menu-item" href="{{ route('backsite.location_detail.index') }}">
              <i></i><span>Job Desk</span>
            </a>
          </li>
          {{-- @endcan --}}

          {{-- @can('location_detail') --}}
          <li
            class="{{ request()->is('backsite/location_detail') || request()->is('backsite/location_detail/*') || request()->is('backsite/*/location_detail') || request()->is('backsite/*/location_detail/*') ? 'active' : '' }} ">
            <a class="menu-item" href="{{ route('backsite.location_detail.index') }}">
              <i></i><span>Aplikasi Inhouse</span>
            </a>
          </li>
          {{-- @endcan --}}

          {{-- @can('location_detail') --}}
          <li
            class="{{ request()->is('backsite/location_detail') || request()->is('backsite/location_detail/*') || request()->is('backsite/*/location_detail') || request()->is('backsite/*/location_detail/*') ? 'active' : '' }} ">
            <a class="menu-item" href="{{ route('backsite.location_detail.index') }}">
              <i></i><span>Aplikasi Lisensi</span>
            </a>
          </li>
          {{-- @endcan --}}

          {{-- @can('location_detail') --}}
          <li
            class="{{ request()->is('backsite/location_detail') || request()->is('backsite/location_detail/*') || request()->is('backsite/*/location_detail') || request()->is('backsite/*/location_detail/*') ? 'active' : '' }} ">
            <a class="menu-item" href="{{ route('backsite.location_detail.index') }}">
              <i></i><span>Microsoft</span>
            </a>
          </li>
          {{-- @endcan --}}

          {{-- @can('location_detail') --}}
          <li
            class="{{ request()->is('backsite/location_detail') || request()->is('backsite/location_detail/*') || request()->is('backsite/*/location_detail') || request()->is('backsite/*/location_detail/*') ? 'active' : '' }} ">
            <a class="menu-item" href="{{ route('backsite.location_detail.index') }}">
              <i></i><span>DRC</span>
            </a>
          </li>
          {{-- @endcan --}}

          {{-- @can('location_detail') --}}
          <li
            class="{{ request()->is('backsite/location_detail') || request()->is('backsite/location_detail/*') || request()->is('backsite/*/location_detail') || request()->is('backsite/*/location_detail/*') ? 'active' : '' }} ">
            <a class="menu-item" href="{{ route('backsite.location_detail.index') }}">
              <i></i><span>Pembuatan Aplikasi</span>
            </a>
          </li>
          {{-- @endcan --}}

          {{-- @can('location_detail') --}}
          <li
            class="{{ request()->is('backsite/location_detail') || request()->is('backsite/location_detail/*') || request()->is('backsite/*/location_detail') || request()->is('backsite/*/location_detail/*') ? 'active' : '' }} ">
            <a class="menu-item" href="{{ route('backsite.location_detail.index') }}">
              <i></i><span>Maintenance Virus</span>
            </a>
          </li>
          {{-- @endcan --}}
        </ul>
      </li>
      {{-- END SI --}}

      {{-- Jaringan/Hardware --}}
      <li class=" nav-item"><a href="{{ route('backsite.software.index') }}"><i
            class="{{ request()->is('backsite/software') || request()->is('backsite/software/*') || request()->is('backsite/*/software') || request()->is('backsite/*/software/*') ? 'bx bx-network-chart bx-flashing' : 'bx bx-network-chart' }}"></i><span
            class="menu-title warning" data-i18n="Software"><strong>Jaringan/Hardware</strong></span></a>
        <ul class="menu-content">

          {{-- @can('location_detail') --}}
          <li
            class="{{ request()->is('backsite/location_detail') || request()->is('backsite/location_detail/*') || request()->is('backsite/*/location_detail') || request()->is('backsite/*/location_detail/*') ? 'active' : '' }} ">
            <a class="menu-item" href="{{ route('backsite.location_detail.index') }}">
              <i></i><span>IP</span>
            </a>
          </li>
          {{-- @endcan --}}

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
              <i></i><span>VMS</span>
            </a>
          </li>
          {{-- @endcan --}}

          {{-- @can('location_detail') --}}
          <li
            class="{{ request()->is('backsite/location_detail') || request()->is('backsite/location_detail/*') || request()->is('backsite/*/location_detail') || request()->is('backsite/*/location_detail/*') ? 'active' : '' }} ">
            <a class="menu-item" href="{{ route('backsite.location_detail.index') }}">
              <i></i><span>Maintenance VMS</span>
            </a>
          </li>
          {{-- @endcan --}}

          {{-- @can('location_detail') --}}
          <li
            class="{{ request()->is('backsite/location_detail') || request()->is('backsite/location_detail/*') || request()->is('backsite/*/location_detail') || request()->is('backsite/*/location_detail/*') ? 'active' : '' }} ">
            <a class="menu-item" href="{{ route('backsite.location_detail.index') }}">
              <i></i><span>Data CCTV</span>
            </a>
          </li>
          {{-- @endcan --}}

          {{-- @can('location_detail') --}}
          <li
            class="{{ request()->is('backsite/location_detail') || request()->is('backsite/location_detail/*') || request()->is('backsite/*/location_detail') || request()->is('backsite/*/location_detail/*') ? 'active' : '' }} ">
            <a class="menu-item" href="{{ route('backsite.location_detail.index') }}">
              <i></i><span>Maintenance CCTV</span>
            </a>
          </li>
          {{-- @endcan --}}

          {{-- @can('location_detail') --}}
          <li
            class="{{ request()->is('backsite/location_detail') || request()->is('backsite/location_detail/*') || request()->is('backsite/*/location_detail') || request()->is('backsite/*/location_detail/*') ? 'active' : '' }} ">
            <a class="menu-item" href="{{ route('backsite.location_detail.index') }}">
              <i></i><span>Maintenance Exchange</span>
            </a>
          </li>
          {{-- @endcan --}}

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
      {{-- END Jaringan --}}


      {{--     Hardware 
            <li class=" nav-item"><a href="{{ route('backsite.software.index') }}"><i
                        class="{{ request()->is('backsite/software') || request()->is('backsite/software/*') || request()->is('backsite/*/software') || request()->is('backsite/*/software/*') ? 'bx bx-desktop bx-flashing' : 'bx bx-desktop' }}"></i><span
                        class="menu-title blue-grey " data-i18n="Software"><strong>Hardware</strong></span></a>
                <ul class="menu-content">
                     @can('location_detail') -
                    <li
                        class="{{ request()->is('backsite/location_detail') || request()->is('backsite/location_detail/*') || request()->is('backsite/*/location_detail') || request()->is('backsite/*/location_detail/*') ? 'active' : '' }} ">
                        <a class="menu-item" href="{{ route('backsite.location_detail.index') }}">
                            <i></i><span>Data PPFTI</span>
                        </a>
                    </li>
                     @endcan

             @can('location_detail') 
                    <li
                        class="{{ request()->is('backsite/location_detail') || request()->is('backsite/location_detail/*') || request()->is('backsite/*/location_detail') || request()->is('backsite/*/location_detail/*') ? 'active' : '' }} ">
                        <a class="menu-item" href="{{ route('backsite.location_detail.index') }}">
                            <i></i><span>Data LK</span>
                        </a>
                    </li>
                     @endcan

             @can('location_detail') 
                    <li
                        class="{{ request()->is('backsite/location_detail') || request()->is('backsite/location_detail/*') || request()->is('backsite/*/location_detail') || request()->is('backsite/*/location_detail/*') ? 'active' : '' }} ">
                        <a class="menu-item" href="{{ route('backsite.location_detail.index') }}">
                            <i></i><span>Maintenance PC</span>
                        </a>
                    </li>
                     @endcan

             @can('location_detail') 
                    <li
                        class="{{ request()->is('backsite/location_detail') || request()->is('backsite/location_detail/*') || request()->is('backsite/*/location_detail') || request()->is('backsite/*/location_detail/*') ? 'active' : '' }} ">
                        <a class="menu-item" href="{{ route('backsite.location_detail.index') }}">
                            <i></i><span>Inventaris Hardware</span>
                        </a>
                    </li>
                     @endcan 
                </ul>
            </li>
             END Hardware --}}

      {{-- Lattol --}}
      <li class=" nav-item"><a href="{{ route('backsite.software.index') }}"><i
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
      <li class=" nav-item"><a href="{{ route('backsite.software.index') }}"><i
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
      <li class=" nav-item"><a href="{{ route('backsite.software.index') }}"><i
            class="{{ request()->is('backsite/software') || request()->is('backsite/software/*') || request()->is('backsite/*/software') || request()->is('backsite/*/software/*') ? 'la la-share-alt bx-flashing' : 'la la-share-alt' }}"></i><span
            class="menu-title pink" data-i18n="Software"><strong>Link Aplikasi</strong></span></a> </li>
      {{-- END Link Aplikasi --}}

      {{-- Kegiatan Harian --}}
      <li class=" nav-item"><a href="{{ route('backsite.act_daily.index') }}"><i
            class="{{ request()->is('backsite/act_daily') || request()->is('backsite/act_daily/*') || request()->is('backsite/*/act_daily') || request()->is('backsite/*/act_daily/*') ? 'bx bx-code-block bx-flashing' : 'bx bx-code-block' }}"></i><span
            class="menu-title cyan" data-i18n="Aktivitas Harian"><strong>Aktivitas
              Harian</strong></span></a>
        <ul class="menu-content">
      </li>
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
    </ul>

    {{-- END Kegiatan Harian --}}

    @if (Auth::user()->detail_user->type_user_id == 1)
      {{-- @can('management_access') --}}
      <li class="nav-item"><a href="#"><i
            class="{{ request()->is('backsite/user') || request()->is('backsite/user/*') || request()->is('backsite/*/user') || request()->is('backsite/*/user/*') || request()->is('backsite/type_user') || request()->is('backsite/type_user/*') || request()->is('backsite/*/type_user') || request()->is('backsite/*/type_user/*') ? 'bx bx-group bx-flashing' : 'bx bx-group' }}"></i><span
            class="menu-title" data-i18n="Management Access">Management Access</span></a>
        <ul class="menu-content">
          {{-- @can('type_user_access') --}}
          <li
            class="{{ request()->is('backsite/type_user') || request()->is('backsite/type_user/*') || request()->is('backsite/*/type_user') || request()->is('backsite/*/type_user/*') ? 'active' : '' }} ">
            <a class="menu-item" href="{{ route('backsite.type_user.index') }}">
              <i></i><span>Type User</span>
            </a>
          </li>
          {{-- @endcan --}}
          {{-- @can('user_access') --}}
          <li
            class="{{ request()->is('backsite/user') || request()->is('backsite/user/*') || request()->is('backsite/*/user') || request()->is('backsite/*/user/*') ? 'active' : '' }} ">
            <a class="menu-item" href="{{ route('backsite.user.index') }}">
              <i></i><span>User</span>
            </a>
          </li>
          {{-- @endcan --}}
        </ul>
      </li>
      {{-- @endcan --}}
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

    <ul hidden class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">

      <li class=" navigation-header"><span data-i18n="Master Data">Master Data</span><i class="la la-ellipsis-h"
          data-toggle="tooltip" data-placement="right" data-original-title="Master Data"></i></li>
      {{-- @can('location') --}}
      <li class=" nav-item"><a href="#"><i
            class="{{ request()->is('backsite/location_detail') || request()->is('backsite/location_detail/*') || request()->is('backsite/*/location_detail') || request()->is('backsite/*/location_detail/*') || request()->is('backsite/location') || request()->is('backsite/location/*') || request()->is('backsite/*/location') || request()->is('backsite/*/location/*') || request()->is('backsite/location_sub') || request()->is('backsite/location_sub/*') || request()->is('backsite/*/location_sub') || request()->is('backsite/*/location_sub/*') || request()->is('backsite/location_room') || request()->is('backsite/location_room/*') || request()->is('backsite/*/location_room') || request()->is('backsite/*/location_room/*') ? 'bx bx-current-location bx-flashing' : 'bx bx-current-location' }}"></i><span
            class="menu-title" data-i18n="Lokasi">Lokasi</span></a>
        <ul class="menu-content">
          {{-- @can('location_detail') --}}
          <li
            class="{{ request()->is('backsite/location_detail') || request()->is('backsite/location_detail/*') || request()->is('backsite/*/location_detail') || request()->is('backsite/*/location_detail/*') ? 'active' : '' }} ">
            <a class="menu-item" href="{{ route('backsite.location_detail.index') }}">
              <i></i><span>Detail Lokasi</span>
            </a>
          </li>
          {{-- @endcan --}}

          {{-- @can('location') --}}
          <li
            class="{{ request()->is('backsite/location') || request()->is('backsite/location/*') || request()->is('backsite/*/location') || request()->is('backsite/*/location/*') ? 'active' : '' }} ">
            <a class="menu-item" href="{{ route('backsite.location.index') }}">
              <i></i><span>Lokasi</span>
            </a>
          </li>
          {{-- @endcan --}}
          {{-- @can('location_sub') --}}
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
              <i></i><span>Ruangan</span>
            </a>
          </li>
          {{-- @endcan --}}
        </ul>
      </li>
      {{-- @endcan --}}

      {{-- @can('division') --}}
      <li class=" nav-item"><a href="#"><i
            class="{{ request()->is('backsite/division') || request()->is('backsite/division/*') || request()->is('backsite/*/division') || request()->is('backsite/*/division/*') || request()->is('backsite/department') || request()->is('backsite/department/*') || request()->is('backsite/*/department') || request()->is('backsite/*/department/*') || request()->is('backsite/section') || request()->is('backsite/section/*') || request()->is('backsite/*/section') || request()->is('backsite/*/section/*') ? 'bx bx-store-alt bx-flashing' : 'bx bx-store-alt' }}"></i><span
            class="menu-title" data-i18n="Divisi">Divisi</span></a>
        <ul class="menu-content">
          {{-- @can('division') --}}
          <li
            class="{{ request()->is('backsite/division') || request()->is('backsite/division/*') || request()->is('backsite/*/division') || request()->is('backsite/*/division/*') ? 'active' : '' }} ">
            <a class="menu-item" href="{{ route('backsite.division.index') }}">
              <i></i><span>Divisi</span>
            </a>
          </li>
          {{-- @endcan --}}
          {{-- @can('department') --}}
          <li
            class="{{ request()->is('backsite/department') || request()->is('backsite/department/*') || request()->is('backsite/*/department') || request()->is('backsite/*/department/*') ? 'active' : '' }} ">
            <a class="menu-item" href="{{ route('backsite.department.index') }}">
              <i></i><span>Departemen</span>
            </a>
          </li>
          {{-- @endcan --}}
          {{-- @can('section-') --}}
          <li
            class="{{ request()->is('backsite/section') || request()->is('backsite/section/*') || request()->is('backsite/*/section') || request()->is('backsite/*/section/*') ? 'active' : '' }} ">
            <a class="menu-item" href="{{ route('backsite.section.index') }}">
              <i></i><span>Seksi</span>
            </a>
          </li>
          {{-- @endcan --}}
        </ul>
      </li>
      {{-- @endcan --}}
      {{-- @can('division') --}}
      <li class=" nav-item"><a href="#"><i
            class="{{ request()->is('backsite/work_category') || request()->is('backsite/work_category/*') || request()->is('backsite/*/work_category') || request()->is('backsite/*/work_category/*') || request()->is('backsite/work_type') || request()->is('backsite/work_type/*') || request()->is('backsite/*/work_type') || request()->is('backsite/*/work_type/*') ? 'bx bx-briefcase bx-flashing' : 'bx bx-briefcase' }}"></i><span
            class="menu-title" data-i18n="Pekerjaan">Pekerjaan</span></a>
        <ul class="menu-content">
          {{-- @can('division') --}}
          <li
            class="{{ request()->is('backsite/work_category') || request()->is('backsite/work_category/*') || request()->is('backsite/*/work_category') || request()->is('backsite/*/work_category/*') ? 'active' : '' }} ">
            <a class="menu-item" href="{{ route('backsite.work_category.index') }}">
              <i></i><span>Kategori Pekerjaan</span>
            </a>
          </li>
          {{-- @endcan --}}
          {{-- @can('department') --}}
          <li
            class="{{ request()->is('backsite/work_type') || request()->is('backsite/work_type/*') || request()->is('backsite/*/work_type') || request()->is('backsite/*/work_type/*') ? 'active' : '' }} ">
            <a class="menu-item" href="{{ route('backsite.work_type.index') }}">
              <i></i><span>Jenis Pekerjaan</span>
            </a>
          </li>
          {{-- @endcan --}}
        </ul>
      </li>
      {{-- @endcan --}}

      {{-- @can('employee') --}}
      <li class=" nav-item"><a href="{{ route('backsite.employee.index') }}"><i
            class="{{ request()->is('backsite/employee') || request()->is('backsite/employee/*') || request()->is('backsite/*/employee') || request()->is('backsite/*/employee/*') ? 'bx bx-user-pin bx-flashing' : 'bx bx-user-pin' }}"></i><span
            class="menu-title" data-i18n="Karyawan">Karyawan</span></a>
      </li>
      {{-- @endcan --}}

      {{-- @can('software') --}}
      <li class=" nav-item"><a href="{{ route('backsite.software.index') }}"><i
            class="{{ request()->is('backsite/software') || request()->is('backsite/software/*') || request()->is('backsite/*/software') || request()->is('backsite/*/software/*') ? 'bx bx-code-block bx-flashing' : 'bx bx-code-block' }}"></i><span
            class="menu-title" data-i18n="Software">Software</span></a>
      </li>
      {{-- @endcan --}}

      {{-- @can('Hardware') --}}
      <li class=" nav-item"><a href="#"><i
            class="{{ request()->is('backsite/hardisk') ||request()->is('backsite/hardisk/*') ||request()->is('backsite/*/hardisk') ||request()->is('backsite/*/hardisk/*') ||request()->is('backsite/monitor') ||request()->is('backsite/monitor/*') ||request()->is('backsite/*/monitor') ||request()->is('backsite/*/monitor/*') ||request()->is('backsite/motherboard') ||request()->is('backsite/motherboard/*') ||request()->is('backsite/*/motherboard') ||request()->is('backsite/*/motherboard/*') ||request()->is('backsite/processor') ||request()->is('backsite/processor/*') ||request()->is('backsite/*/processor') ||request()->is('backsite/*/processor/*') ||request()->is('backsite/ram') ||request()->is('backsite/ram/*') ||request()->is('backsite/*/ram') ||request()->is('backsite/*/ram/*') ||request()->is('backsite/type_device') ||request()->is('backsite/type_device/*') ||request()->is('backsite/*/type_device') ||request()->is('backsite/*/type_device/*') ||request()->is('backsite/additional_device') ||request()->is('backsite/additional_device/*') ||request()->is('backsite/*/additional_device') ||request()->is('backsite/*/additional_device/*')? 'bx bx-desktop bx-flashing': 'bx bx-desktop' }}"></i><span
            class="menu-title" data-i18n="Hardware">Hardware</span></a>
        <ul class="menu-content">
          <li class=" nav-item"><a href="#"><span class="menu-title"
                data-i18n="Spesifikasi">Spesifikasi</span></a>
            <ul class="menu-content">
              {{-- @can('Hardisk') --}}
              <li
                class="{{ request()->is('backsite/hardisk') || request()->is('backsite/hardisk/*') || request()->is('backsite/*/hardisk') || request()->is('backsite/*/hardisk/*') ? 'active' : '' }} ">
                <a class="menu-item" href="{{ route('backsite.hardisk.index') }}">
                  <i></i><span>Hardisk</span>
                </a>
              </li>
              {{-- @endcan --}}
              {{-- @can('Monitor') --}}
              <li
                class="{{ request()->is('backsite/monitor') || request()->is('backsite/monitor/*') || request()->is('backsite/*/monitor') || request()->is('backsite/*/monitor/*') ? 'active' : '' }} ">
                <a class="menu-item" href="{{ route('backsite.monitor.index') }}">
                  <i></i><span>Monitor</span>
                </a>
              </li>
              {{-- @endcan --}}
              {{-- @can('Motherboard') --}}
              <li
                class="{{ request()->is('backsite/motherboard') || request()->is('backsite/motherboard/*') || request()->is('backsite/*/motherboard') || request()->is('backsite/*/motherboard/*') ? 'active' : '' }} ">
                <a class="menu-item" href="{{ route('backsite.motherboard.index') }}">
                  <i></i><span>Motherboard</span>
                </a>
              </li>
              {{-- @endcan --}}
              {{-- @can('Prosessor') --}}
              <li
                class="{{ request()->is('backsite/processor') || request()->is('backsite/processor/*') || request()->is('backsite/*/processor') || request()->is('backsite/*/processor/*') ? 'active' : '' }} ">
                <a class="menu-item" href="{{ route('backsite.processor.index') }}">
                  <i></i><span>Processor</span>
                </a>
              </li>
              {{-- @endcan --}}
              {{-- @can('Ram') --}}
              <li
                class="{{ request()->is('backsite/ram') || request()->is('backsite/ram/*') || request()->is('backsite/*/ram') || request()->is('backsite/*/ram/*') ? 'active' : '' }} ">
                <a class="menu-item" href="{{ route('backsite.ram.index') }}">
                  <i></i><span>Ram</span>
                </a>
              </li>
              {{-- @endcan --}}
              {{-- @can('additional_device') --}}
              <li
                class="{{ request()->is('backsite/additional_device') || request()->is('backsite/additional_device/*') || request()->is('backsite/*/additional_device') || request()->is('backsite/*/additional_device/*') ? 'active' : '' }} ">
                <a class="menu-item" href="{{ route('backsite.additional_device.index') }}">
                  <i></i><span>Perangkat Tambahan</span>
                </a>
              </li>
              {{-- @endcan --}}
            </ul>
          </li>
          {{-- @can('Type_Device') --}}
          <li
            class="{{ request()->is('backsite/type_device') || request()->is('backsite/type_device/*') || request()->is('backsite/*/type_device') || request()->is('backsite/*/type_device/*') ? 'active' : '' }} ">
            <a class="menu-item" href="{{ route('backsite.type_device.index') }}">
              <i></i><span>Tipe Device</span>
            </a>
          </li>
          {{-- @endcan --}}
        </ul>
      </li>

      {{-- @can('network') --}}
      <li class=" nav-item"><a href="#"><i
            class="{{ request()->is('backsite/cctv') || request()->is('backsite/cctv/*') || request()->is('backsite/*/cctv') || request()->is('backsite/*/cctv/*') ? 'bx bx-network-chart bx-flashing' : 'bx bx-network-chart' }}"></i><span
            class="menu-title" data-i18n="Jaringan">Jaringan</span></a>
        <ul class="menu-content">
          {{-- @can('cctv') --}}
          <li
            class="{{ request()->is('backsite/cctv') || request()->is('backsite/cctv/*') || request()->is('backsite/*/cctv') || request()->is('backsite/*/cctv/*') ? 'active' : '' }} ">
            <a class="menu-item" href="{{ route('backsite.cctv.index') }}">
              <i></i><span>CCTV</span>
            </a>
          </li>
          {{-- @endcan --}}
        </ul>
      </li>


      <li class=" navigation-header"><span data-i18n="Data">Data</span><i class="la la-ellipsis-h"
          data-toggle="tooltip" data-placement="right" data-original-title="Data"></i></li>
      {{-- @can('work_program') --}}
      <li class=" nav-item"><a href="{{ route('backsite.work_program.index') }}"><i
            class="{{ request()->is('backsite/work_program') || request()->is('backsite/work_program/*') || request()->is('backsite/*/work_program') || request()->is('backsite/*/work_program/*') ? 'bx bx-book-bookmark bx-flashing' : 'bx bx-book-bookmark' }}"></i><span
            class="menu-title" data-i18n="Program Kerja">Program Kerja</span></a>
      </li>
      {{-- @endcan --}}
      {{-- @can('act_daily') --}}
      <li class=" nav-item"><a href="{{ route('backsite.daily_activity.index') }}"><i
            class="{{ request()->is('backsite/daily_activity') || request()->is('backsite/daily_activity/*') || request()->is('backsite/*/daily_activity') || request()->is('backsite/*/daily_activity/*') ? 'bx bx-cycling bx-flashing' : 'bx bx-cycling' }}"></i><span
            class="menu-title" data-i18n="Aktivitas Harian">Aktivitas Harian</span></a>
      </li>
      {{-- @endcan --}}
      {{-- @can('device_hardware') --}}
      <li class=" nav-item"><a href="{{ route('backsite.device_hardware.index') }}"><i
            class="{{ request()->is('backsite/device_hardware') || request()->is('backsite/device_hardware/*') || request()->is('backsite/*/device_hardware') || request()->is('backsite/*/device_hardware/*') ? 'bx bx-laptop bx-flashing' : 'bx bx-laptop' }}"></i><span
            class="menu-title" data-i18n="Device Hardware">Device Hardware</span></a>
      </li>
      {{-- @endcan --}}


      <li class=" navigation-header"><span data-i18n="Application">Application</span><i class="la la-ellipsis-h"
          data-toggle="tooltip" data-placement="right" data-original-title="Application"></i></li>

      @if (Auth::user()->detail_user->type_user_id == 1)
        {{-- @can('management_access') --}}
        <li class=" nav-item"><a href="#"><i
              class="{{ request()->is('backsite/user') || request()->is('backsite/user/*') || request()->is('backsite/*/user') || request()->is('backsite/*/user/*') || request()->is('backsite/type_user') || request()->is('backsite/type_user/*') || request()->is('backsite/*/type_user') || request()->is('backsite/*/type_user/*') ? 'bx bx-group bx-flashing' : 'bx bx-group' }}"></i><span
              class="menu-title" data-i18n="Management Access">Management Access</span></a>
          <ul class="menu-content">
            {{-- @can('type_user_access') --}}
            <li
              class="{{ request()->is('backsite/type_user') || request()->is('backsite/type_user/*') || request()->is('backsite/*/type_user') || request()->is('backsite/*/type_user/*') ? 'active' : '' }} ">
              <a class="menu-item" href="{{ route('backsite.type_user.index') }}">
                <i></i><span>Type User</span>
              </a>
            </li>
            {{-- @endcan --}}
            {{-- @can('user_access') --}}
            <li
              class="{{ request()->is('backsite/user') || request()->is('backsite/user/*') || request()->is('backsite/*/user') || request()->is('backsite/*/user/*') ? 'active' : '' }} ">
              <a class="menu-item" href="{{ route('backsite.user.index') }}">
                <i></i><span>User</span>
              </a>
            </li>
            {{-- @endcan --}}
          </ul>
        </li>
        {{-- @endcan --}}
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
          {{-- @endcan --}}
        </ul>
      </li>
      {{-- @endcan --}}
    </ul>

    </ul>
  </div>
</div>

<!-- END: Main Menu-->
