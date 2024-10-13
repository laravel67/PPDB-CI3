<div class="content-wrapper">
    <div class="content">
        <div class="panel panel-flat">
            <div class="panel-body">
                <div class="panel panel-success">
                    <div class="panel-heading">
                        <h3 class="panel-title">
                            <i class="glyphicon glyphicon-upload"></i> UNGGAHAN
                        </h3>
                    </div>
                </div>
                <fieldset class="content-group">
                    <legend class="text-bold">IJAZAH, SKHU, KK & PAS FOTO 3x4</legend>
                    <?php if ($this->session->flashdata('success')) : ?>
                        <div class="alert alert-success show">
                            <strong><i class="glyphicon glyphicon-check"></i></strong> <?= $this->session->flashdata('success'); ?>.
                        </div>
                    <?php endif; ?>
                    <form method="post" action="<?= base_url('Panel_siswa/saving_file/' . $user->id_siswa); ?>" enctype="multipart/form-data" class="form-group mt-5" style="margin-top: 10px; margin-bottom: 10vh;" onsubmit="return validateForm()">
                        <div class="row" style="margin-left: 1px;">
                            <!-- Ijazah -->
                            <div class="col-md-3">
                                <label for="ijazah" class="btn btn-info btn-sm" style="width: 100%; margin-bottom:20px;"><i class="glyphicon glyphicon-upload"></i> IJAZAH</label>
                                <input type="file" class="form-control file-upload class" id="ijazah" name="ijazah" accept=".jpg, .jpeg, .png" onchange="previewImage('ijazah', 'preview_ijazah')" style="display: none;">
                                <?php if ($user->ijazah) : ?>
                                    <img src="<?= base_url('/img/ijazah/' . $user->ijazah); ?>" alt="<?= $user->ijazah; ?>" class="img-thumbnail" style="margin-bottom:5px; widht:100%; height:300px">
                                <?php else : ?>
                                    <img src="<?= base_url('/img/doc.png'); ?>" alt="" id="preview_ijazah" class="img-thumbnail" style="margin-bottom:5px; widht:100%; height:300px">
                                <?php endif; ?>
                                <div id="error-ijazah" class="error-message" style=" background:#FFBABA; color: #D8000C; width:auto; padding-left:10px; "></div>
                            </div>
                            <!-- Skhu -->
                            <div class="col-md-3">
                                <label for="skhu" class="btn btn-info btn-sm" style="width: 100%; margin-bottom:20px;"><i class="glyphicon glyphicon-upload"></i> SKHU</label>
                                <input type="file" class="form-control file-upload" id="skhu" name="skhu" accept=".jpg, .jpeg, .png" onchange="previewImage('skhu', 'preview_skhu')" style="display: none;">
                                <?php if ($user->skhu) : ?>
                                    <img src="<?= base_url('/img/skhu/' . $user->skhu); ?>" alt="<?= $user->skhu; ?>" class="img-thumbnail" style="margin-bottom:5px; widht:100%; height:300px">
                                <?php else : ?>
                                    <img src="<?= base_url('/img/doc.png'); ?>" alt="" id="preview_skhu" class="img-thumbnail" style="margin-bottom:5px; widht:100%; height:300px">
                                <?php endif; ?>
                                <div id="error-skhu" class="error-message" style=" background:#FFBABA; color: #D8000C; width:auto; padding-left:10px;"></div>
                            </div>
                            <!-- KK -->
                            <div class="col-md-3">
                                <label for="kk" class="btn btn-info btn-sm" style="width: 100%; margin-bottom:20px;"><i class="glyphicon glyphicon-upload"></i> KK</label>
                                <input type="file" class="form-control file-upload" id="kk" name="kk" accept=".jpg, .jpeg, .png" onchange="previewImage('kk', 'preview_kk')" style="display: none;">
                                <?php if ($user->kk) : ?>
                                    <img src="<?= base_url('/img/kk/' . $user->kk); ?>" alt="<?= $user->kk; ?>" class="img-thumbnail" style="margin-bottom:5px; widht:100%; height:300px">
                                <?php else : ?>
                                    <img src="<?= base_url('/img/doc.png'); ?>" alt="" id="preview_kk" class="img-thumbnail" style="margin-bottom:5px; widht:100%; height:300px">
                                <?php endif; ?>
                                <div id="error-kk" class="error-message" style=" background:#FFBABA; color: #D8000C; width:auto; padding-left:10px;"></div>
                            </div>
                            <!-- photo -->
                            <div class="col-md-3">
                                <label for="photo" class="btn btn-info btn-sm" style="width: 100%; margin-bottom:20px;"><i class="glyphicon glyphicon-upload"></i> Pas Foto (3x4)</label>
                                <input type="file" class="form-control file-upload" id="photo" name="photo" accept=".jpg, .jpeg, .png" onchange="previewImage('photo', 'preview_photo')" style="display: none;">
                                <?php if ($user->photo) : ?>
                                    <img src="<?= base_url('/img/photo/' . $user->photo); ?>" alt="<?= $user->photo; ?>" class="img-thumbnail" style="margin-bottom:5px; widht:100%; height:300px">
                                <?php else : ?>
                                    <img src="<?= base_url('/img/doc.png'); ?>" alt="" id="preview_photo" class="img-thumbnail" style="margin-bottom:5px; widht:100%; height:300px">
                                <?php endif; ?>
                                <div id="error-photo" class="error-message" style=" background:#FFBABA; color: #D8000C; width:auto; padding-left:10px;"></div>
                            </div>
                        </div>
                        <div style="text-align: center; margin-top: 2rem;">
                            <button type="submit" class="btn btn-success" style="width: 30rem;">Unggah Sekarang</button>
                        </div>
                    </form>
                </fieldset>
            </div>
        </div>
    </div>
</div>




<script>
    function validateForm() {
        var isValid = true;
        isValid = validateFile('ijazah', 'error-ijazah') && isValid;
        isValid = validateFile('skhu', 'error-skhu') && isValid;
        isValid = validateFile('kk', 'error-kk') && isValid;
        isValid = validateFile('photo', 'error-photo') && isValid;
        return isValid;
    }

    function validateFile(inputId, errorId) {
        var fileInput = document.getElementById(inputId);
        var errorElement = document.getElementById(errorId);
        errorElement.innerHTML = '';

        // // Check if a file is selected
        // if (fileInput.files.length === 0) {
        //     errorElement.innerHTML = 'Harap pilih file untuk diunggah';
        //     return false;
        // }

        var file = fileInput.files[0];
        if (!validateFileType(file, ['image/jpeg', 'image/jpg', 'image/png'])) {
            errorElement.innerHTML = 'File harus berupa gambar (jpeg, jpg, png)';
            return false;
        }
        if (file.size > 2 * 1024 * 1024) {
            errorElement.innerHTML = 'File tidak boleh lebih dari 2 MB';
            return false;
        }
        return true;
    }

    function validateFileType(file, types) {
        return types.includes(file.type);
    }
</script>