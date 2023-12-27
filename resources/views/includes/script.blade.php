<!-- BEGIN: Vendor JS-->
<script src="{{ asset('/assets/app-assets/vendors/js/vendors.min.js') }}"></script>
<!-- BEGIN Vendor JS-->

<!-- BEGIN: Page Vendor JS-->
<script src="{{ asset('/assets/app-assets/vendors/js/tables/datatable/datatables.min.js') }}"></script>
<script src="{{ asset('/assets/app-assets/vendors/js/tables/datatable/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('/assets/app-assets/vendors/js/forms/select/select2.full.min.js') }}"></script>
<script src="{{ asset('/assets/app-assets/vendors/js/ui/jquery.sticky.js') }}"></script>
<script src="{{ asset('/assets/app-assets/vendors/js/charts/jquery.sparkline.min.js') }}"></script>
<script src="{{ asset('/assets/app-assets/vendors/js/forms/tags/form-field.js') }}"></script>
<script src="{{ asset('/assets/app-assets/vendors/js/pagination/jquery.twbsPagination.min.js') }}"></script>

<!-- END: Page Vendor JS-->

<!-- BEGIN: Theme JS-->
<script src="{{ asset('/assets/app-assets/js/core/app-menu.js') }}"></script>
<script src="{{ asset('/assets/app-assets/js/core/app.js') }}"></script>
<!-- END: Theme JS-->

<!-- BEGIN: Page JS-->
<script src="{{ asset('/assets/app-assets/js/scripts/forms/select/form-select2.js') }}"></script>
<script src="{{ asset('/assets/app-assets/js/scripts/tables/datatables/datatable-api.js') }}"></script>
<script src="{{ asset('/assets/app-assets/js/scripts/forms/custom-file-input.js') }}"></script>
<script src="{{ asset('/assets/app-assets/js/scripts/tooltip/tooltip.js') }}"></script>
<script src="{{ asset('/assets/app-assets/js/scripts/popover/popover.js') }}"></script>
<script src="{{ asset('/assets/app-assets/js/scripts/modal/components-modal.js') }}"></script>
<script src="{{ asset('/assets/app-assets/js/scripts/pagination/pagination.js') }}"></script>
<!-- END: Page JS-->

{{-- third party --}}
<script src="{{ url('https://unpkg.com/boxicons@latest/dist/boxicons.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.js"
  integrity="sha512-uURl+ZXMBrF4AwGaWmEetzrd+J5/8NRkWAvJx5sbPSSuOb0bZLqf+tOzniObO00BjHa/dD7gub9oCGMLPQHtQA=="
  crossorigin="anonymous" referrerpolicy="no-referrer"></script>



{{-- preview --}}
<script>
  function previewImage() {
    const file = document.querySelector('#file');
    const imgPreview = document.querySelector('.img-preview');

    imgPreview.style.display = 'block';

    const oFReader = new FileReader();
    oFReader.readAsDataURL(file.files[0]);

    oFReader.onload = function(oFREvent) {
      imgPreview.src = oFREvent.target.result;
    }
  }

  //number format
  $('input.numberformat').keyup(function(event) {

    // skip for arrow keys
    if (event.which >= 37 && event.which <= 40) return;

    // format number
    $(this).val(function(index, value) {
      return value
        .replace(/\D/g, "")
        .replace(/\B(?=(\d{3})+(?!\d))/g, ".");
    });
  });
</script>
