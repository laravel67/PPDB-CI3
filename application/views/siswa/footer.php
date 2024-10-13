<?php
defined('BASEPATH') or exit('No direct script access allowed');
$id = $this->db->get('tbl_user')->row_array();
?>
</div>
</div>
<!-- /main content -->
</div>
<!-- /page content -->
</div>
<!-- /page container -->
<!-- Footer -->
<div class="navbar navbar-default navbar-fixed-bottom footer" style="background-color:#275555ff;">
  <ul class="nav navbar-nav visible-xs-block">
    <li><a class="text-center collapsed" data-toggle="collapse" data-target="#footer"><i class="icon-circle-up2"></i></a></li>
  </ul>
  <div class="navbar-collapse collapse" id="footer">
    <div class="navbar-text" style="color: ivory;">
      <label class="label label-danger" style="margin-bottom: -10px;"><?php echo $id['nama_lengkap']; ?></label> Copyright &copy; <?php echo date('Y'); ?>
    </div>
  </div>
</div>
<script>
  function previewImage(inputId, previewId) {
    const fileInput = document.getElementById(inputId);
    const previewImg = document.getElementById(previewId);
    const file = fileInput.files[0];
    const reader = new FileReader();

    reader.onload = function(e) {
      previewImg.src = e.target.result;
    }

    if (file) {
      reader.readAsDataURL(file);
    } else {
      previewImg.src = '<?= base_url('/img/doc.png'); ?>';
    }
  }
</script>
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
<script type="text/javascript">
  function hanyaAngka(evt) {
    var charCode = (evt.which) ? evt.which : event.keyCode
    if (charCode > 31 && (charCode < 48 || charCode > 57))
      return false;
    return true;
  }
</script>
</body>

</html>