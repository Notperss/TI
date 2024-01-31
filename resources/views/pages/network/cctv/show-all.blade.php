 <div class="table-responsive">
   <table class="table table-striped table-bordered text-inputs-searching default-table">
     <thead>
       <tr>
         <th style="text-align:center; width:20px;">No</th>
         <th class="text-center">Barcode</th>
         <th class="text-center">Nama Barang</th>
         <th class="text-center">User</th>
         <th class="text-center">Lokasi</th>
         <th style="text-align:center; width:50px;">Action</th>
       </tr>
     </thead>
     <tbody>
       @forelse($assetCCTV as $asset_item)
         <td class="text-center">{{ $loop->iteration }}</td>
         <td class="text-center">
           {{ $asset_item->asset->barcode }}</td>
         <td class="text-center">
           {{ $asset_item->asset->name }}</td>
         <td class="text-center">
           {{-- @php
               $employeeNames = [];
               $distributionAssets = $asset_item->distribution_asset;

               foreach ($distributionAssets as $distributionAsset) {
                   $distribution = $distributionAsset->distribution;

                   if ($distribution && ($employee = $distribution->employee)) {
                       $employeeNames[] = $employee->name;
                   }
               }

               // Concatenate employee names with a separator (e.g., comma)
               $employeeName = $employeeNames ? end($employeeNames) : 'N/A';
             @endphp --}}
           {{ $asset_item->distribution->employee->name }}
         </td>
         <td class="text-center">
           {{-- @php
               $location_roomNames = [];
               $distributionAssets = $asset_item->distribution_asset;

               foreach ($distributionAssets as $distributionAsset) {
                   $distribution = $distributionAsset->distribution;

                   if ($distribution && ($location_room = $distribution->location_room)) {
                       $location_roomNames[] = $location_room->name;
                   }
               }

               // Concatenate location_room names with a separator (e.g., comma)
               $location_roomName = $location_roomNames ? end($location_roomNames) : 'N/A';

             @endphp --}}
           {{ $asset_item->distribution->location_room->name }}
         </td>
         <td class="text-center">
           <a href="#mymodal" data-remote="{{ route('backsite.distribution.show', $asset_item->distribution->id) }}"
             data-toggle="modal" data-target="#mymodal" data-title="Detail Data" class="btn btn-sm btn-info">
             Show
           </a>
         </td>
         </tr>
       @empty
         <tr>
           <td class="text-center" colspan="5" style="color:red;">No data available in table</td>
         </tr>
       @endforelse
     </tbody>
     <tfoot hidden>
       <tr>
         <th>No</th>
         <th>Program Kerja</th>
         <th>Tahun</th>
         <th>Umum</th>
         <th>Teknis</th>
         <th>Progress</th>
       </tr>
   </table>
 </div>
 <script>
   $('.default-table').DataTable({
     "order": [],
     "paging": true,
     "lengthMenu": [
       [5, 10, 25, 50, 100, -1],
       [5, 10, 25, 50, 100, "All"]
     ],
     "pageLength": 10
   });
   $.ajaxSetup({
     headers: {
       'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
     }
   });
 </script>

 {{-- @push('after-script')
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
 @endpush --}}
