<section class="mb-5">
    <header>
        <div class="flex items-center gap-4">
            @if (session('status') === 'profile-updated')
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Berhasil Di Ubah</strong>
                </div>
            @endif
        </div>
        <h2 class="text-lg font-medium text-gray-900">
            Informasi Profil
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            Perbarui informasi profil akun dan alamat email Anda.
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <div class="form-group">
            <label for="username">User Name</label>
            <input type="text" class="form-control" id="username" placeholder="user name" name="name"
                value="{{ old('name', $user->name) }}" required>
            <x-input-error :messages="$errors->get('name')" class="mt-2 text-danger" />
        </div>


        <div>
            <div class="form-group">
                <label for="inputEmail4">Email</label>
                <input type="email" class="form-control" id="inputEmail4" placeholder="admin@gmail.com" name="email"
                    value="{{ old('email', $user->email) }}">
                <x-input-error :messages="$errors->get('email')" class="mt-2 text-danger" />
            </div>
            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && !$user->hasVerifiedEmail())
                <div>
                    <p class="text-sm mt-2 text-gray-800">
                        {{ 'Your email address is unverified.' }}

                        <button form="send-verification"
                            class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            {{ 'Click here to re-send the verification email.' }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-medium text-sm text-green-600">
                            {{ 'A new verification link has been sent to your email address.' }}
                        </p>
                    @endif
                </div>
            @endif
        </div>
        <button type="submit" class="btn btn-primary">Simpan</button>

    </form>
</section>
