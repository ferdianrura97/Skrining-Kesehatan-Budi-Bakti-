@if(Session::has('success'))
    <script>
      swal("Berhasil", "{{ Session::get('success') }}", "success");
    </script>
@endif

@if(Session::has('error'))
    <script>
      swal("Gagal", "{{ Session::get('error') }}", "error");
    </script>
@endif

@if(Session::has('warning'))
  <script>
    swal("Ops", "{{ Session::get('warning') }}", "warning");
  </script>
@endif

@if(Session::has('info'))
  <script>
    swal("Informasi", "{{ Session::get('info') }}", "info");
  </script>
@endif
