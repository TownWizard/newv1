<h2>SUBE TUS PROPIAS PHOTOS</h2>
<form id="uploadForm" action="" method="post" enctype="multipart/form-data">
  <div class="no-margin-top no-margin-bottom">
	<input type="hidden" name="MAX_FILE_SIZE" value="2000000">
    <?php if(isset($var->photo_uploaded) && $var->photo_uploaded) echo "<h4>�Gracias! La foto se ha cargado con �xito, en espera de aprobaci�n de administrador.</h4><br />"; ?>
    <h3>Elegir una imagen</h3><br />
    <label class="no-margin-top" accesskey="f" for="userfile">Nombre de archivo (l�mite de tama�o de 2 MB) :</label>
    <input class="no-margin-top" id="image" name="image" value="Vali fail" type="file" />
    <br /><br />
    <label accesskey="t" for="caption">Pie de foto (opcional):</label>
    <input class="no-margin-top" name="caption" id="caption" style="width: 90%;" />
    <br /><br />
    <label accesskey="c" for="description">Descripci�n de la foto (opcional):</label>
    <textarea class="no-margin-top" name="description" id="description" style="width: 90%;" cols="43" rows="6"></textarea>
    <br /><br />
    <label accesskey="n" for="username">Su nombre (opcional):</label>
    <input class="no-margin-top" name="username" id="username" style="width: 90%;" />
    <br /><br />
    <label accesskey="h" for="location">Su origen (opcional):</label>
    <input class="no-margin-top" name="location" id="location" style="width: 90%;" />
    <br /><br />
    <input type="hidden" name="backurl" value="<?php echo $var->http_referer; ?>" />
    <input type="hidden" name="formname" value="upload.event.photo" />
    <input class="no-margin-top" type="submit" name="submit" value="Subir" style="width:160px;" />
  </div><!-- /no-margin-top no-margin-bottom -->
  <br /><br />
  <h3><a href="<?php echo $var->http_referer; ?>" style=":left;">&laquo;&nbsp;de nuevo</a></h3>
</form>