{{-- @if (Session::has('succes'))
<div class="pt-3">
    <div class="alert alert-succes">
        {{Session::get('succes')}}
    </div>
</div>
@endif --}}
      <script>
        // Fungsi untuk menampilkan SweetAlert
        function showSuccessAlert(successMessage) {
            Swal.fire({
                icon: 'success',
                title: 'Berhasil',
                text: successMessage,
                showConfirmButton: false,
            
            });
        }
        function showErrorAlert(errorMessage) {
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: errorMessage,
        });
    }
    
        // Saat halaman dimuat, cek apakah ada parameter 'success' di URL
        // Jika ya, panggil fungsi showSuccessAlert
        document.addEventListener('DOMContentLoaded', function () {
            const urlParams = new URLSearchParams(window.location.search);
            if (urlParams.has('success')) {
            const successMessage = urlParams.get('success');
            showSuccessAlert(successMessage);
        }
            if (urlParams.has('error')) {
            const errorMessage = urlParams.get('error');
            showErrorAlert(errorMessage);
        }
        });
    </script>

@if ($errors->any())
<div class="pt-3">
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $item)
                <li>{{$item}}</li>
            @endforeach
        </ul>
    </div>
</div>
@endif