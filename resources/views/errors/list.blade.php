@if ($errors->count() > 0)
          <script>
      			swal({   title: "@foreach ($errors->all() as $error){{ $error }}@endforeach",   text: "",   type: "error",   confirmButtonText: "Try Again" });
      		</script>
@endif
