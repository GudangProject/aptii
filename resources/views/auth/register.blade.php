<x-frontend-master>

<section class="woocommerce single page-wrapper">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 col-xl-7">

                <div class="signup-form">
                    <div class="form-header">
                        <h2 class="font-weight-bold mb-3">Registrasi Anggota</h2>
                        <p class="woocommerce-register">
                            Sudah memiliki akun ? <a href="#" class="text-decoration-underline">Log in</a>
                        </p>
                        <ul class="mt-3 list-disc list-inside text-sm text-danger">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>

                    <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data" class="woocommerce-form woocommerce-form-register register">
                        @csrf
                        <div class="row">
                            <div class="col-xl-6">
                                <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
                                    <label>Nama Lengkap&nbsp;<span class="required">*</span></label>
                                    <input type="text" class="form-control" name="name" :value="old('name')" placeholder="Jarwonozt" required autofocus>
                                </p>
                            </div>
                            <div class="col-xl-6">
                                <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
                                    <label>Email&nbsp;<span class="required">*</span></label>
                                    <input type="email" class="form-control" name="email" :value="old('email')" placeholder="jarwonozt@gmail.com" required>
                                </p>
                            </div>
                            <div class="col-xl-6">
                                <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
                                    <label>No HP&nbsp;<span class="required">*</span></label>
                                    <input type="number" class="form-control" name="phone" :value="old('phone')" placeholder="+6282145999" required>
                                </p>
                            </div>

                            <div class="col-xl-6">
                                <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
                                    <label>Afiliasi/Institusi&nbsp;<span class="required">*</span></label>
                                    <input type="text" class="form-control" name="company" :value="old('company')" placeholder="Universitas Islam" required>
                                </p>
                            </div>

                            <div class="col-xl-6">
                                <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
                                    <label>NIK&nbsp;<span class="required"></span></label>
                                    <input type="number" class="form-control" name="nik" :value="old('nik')">
                                </p>
                            </div>

                            <div class="col-xl-6">
                                <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
                                    <label>ID Sinta&nbsp;<span class="required"></span></label>
                                    <input type="text" class="form-control" name="sinta_id" :value="old('sinta_id')">
                                </p>
                            </div>

                            <div class="col-xl-6">
                                <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
                                    <label>ID GS&nbsp;<span class="required"></span></label>
                                    <input type="text" class="form-control" name="gs_id" :value="old('gs_id')">
                                </p>
                            </div>

                            <div class="col-xl-6">
                                <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
                                    <label>ID Scopus&nbsp;<span class="required"></span></label>
                                    <input type="text" class="form-control" name="scopus_id" :value="old('scopus_id')">
                                </p>
                            </div>

                            <div class="col-xl-12">
                                <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
                                    <label>Foto Profil &nbsp;<span class="required">*</span></label>
                                    <input class="form-control form-control-lg" id="formFileLg" name="image" type="file" accept="image/*">
                                </p>
                            </div>

                            <div class="col-xl-12">
                                <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
                                    <label>Jenis Kelamin&nbsp;<span class="required">*</span></label>
                                    <select name="gender" class="form-control" id="">
                                        <option selected>-- Pilih --</option>
                                        <option value="l">Laki-laki</option>
                                        <option value="p">Perempuan</option>
                                    </select>
                                </p>
                            </div>

                            <div class="col-12">
                                <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
                                    <label class="text-danger">Password harus teridir dari 8 huruf dan angka&nbsp;</label>
                                </p>
                            </div>

                            <div class="col-xl-6">
                                <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
                                    <label>Password&nbsp;<span class="required">*</span></label>
                                    <input type="password" class="form-control" type="password" name="password" required autocomplete="new-password">
                                </p>
                            </div>
                            <div class="col-xl-6">
                                <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
                                    <label>Re-Enter Password&nbsp;<span class="required">*</span></label>
                                    <input type="password" class="form-control" type="password" name="password_confirmation" required autocomplete="new-password">
                                </p>
                            </div>

                            {{-- <div class="col-xl-12">
                                <div class="d-flex align-items-center justify-content-between py-2">
                                    <p class="form-row">
                                        <label class="woocommerce-form__label woocommerce-form__label-for-checkbox woocommerce-form-login__policy">
                                            <input class="woocommerce-form__input woocommerce-form__input-checkbox" name="policy" type="checkbox" id="policy" value="forever"> <span>Accept the Terms and Privacy Policy</span>
                                        </label>
                                    </p>

                                    <p class="woocommerce-LostPassword lost_password">
                                        <a href="#">Forgot password?</a>
                                    </p>
                               </div>
                            </div> --}}
                        </div>

                        <p class="woocommerce-FormRow form-row">
                            <button type="submit" class="woocommerce-button button" name="register" value="Register">Register</button>
                        </p>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
</x-frontend-master>
