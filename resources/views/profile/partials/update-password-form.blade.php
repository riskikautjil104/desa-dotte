<section class=mb-5>
    <header>
        @if (session('status') === 'password-updated')
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Kata Sandi Berhasil Perbarui</strong>
        </div>
        @endif
        <h2 class="text-lg font-medium text-gray-900">
            Perbarui Kata Sandi
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            Pastikan akun Anda menggunakan kata sandi acak yang panjang agar tetap aman.
        </p>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('put')
        <div class="form-group">
            <label for="inputPassword5">Kata Sandi Lama</label>
            <input type="password" class="form-control" id="inputPassword5" name="current_password">
            <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2 text-danger" />
        </div>
        <div class="form-group">
            <label for="inputPassword5">Kata Sandi Baru</label>
            <input type="password" class="form-control" id="inputPassword5" name="password">
            <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2 text-danger" />
        </div>
        <div class="form-group">
            <label for="inputPassword6">Konfirmasi Kata Sandi</label>
            <input type="password" class="form-control" id="inputPassword6" name="password_confirmation">
            <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2 text-danger" />
        </div>

        <div class="flex items-center gap-4">
            <button type="submit" class="btn btn-primary">Simpan</button>


        </div>
    </form>
</section>
