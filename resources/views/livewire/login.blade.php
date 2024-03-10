<div class="row justify-content-center mt-5">
    <div class="col-md-8">

        <div class="card">
            <div class="card-header">Login</div>
            <div class="card-body">
                <form wire:submit="login">
                    <div class="mb-3 row">
                        <label for="email" class="col-md-4 col-form-label text-md-end text-start">Email Address</label>
                        <div class="col-md-6">
                          <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" wire:model="email">
                            @if ($errors->has('email'))
                                <span class="text-danger">{{ $errors->first('email') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="password" class="col-md-4 col-form-label text-md-end text-start">Password</label>
                        <div class="col-md-6">
                          <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" wire:model="password">
                            @if ($errors->has('password'))
                                <span class="text-danger">{{ $errors->first('password') }}</span>
                            @endif
                            @if (session()->has('error'))
                                <span class="text-danger">{{ session('error') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <button type="submit" class="col-md-3 offset-md-5 btn btn-primary">
                            Login
                       </button>
                    </div>
                    <div class="mb-3 row">
                        <span wire:loading class="col-md-3 offset-md-5 text-primary">wait...</span>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<script src="https://cdn.jsdelivr.net/npm/@laragear/webpass@1/dist/webpass.js" defer></script>

<script>
    import Webpass from "laragear-webpass"

    document.addEventListener('livewire:load', function () {
        if (Webpass.isUnsupported()) {
            return alert("Your browser doesn't support WebAuthn.")
        }
        
        // const { success } = await Webpass.attest("/webauthn/register/options", "/webauthn/register")
        const { credential, success, error } = await Webpass.attest("/webauthn/register/options", "/webauthn/register")

        const { user, success, error } = await Webpass.assert("/webauthn/login/options", "/webauthn/login")
        
        if (success) {
            window.location.replace("/dashboard")
        }
    });


</script>