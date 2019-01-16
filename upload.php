<html>
<head>
<title>Processamento de Arquivos</title>
</head>
<body>
<?php

move_uploaded_file ($_FILES['arquivo'] ['tmp_name'],
       "/arquivos/{$_FILES['arquivo'] ['name']}")

?>
</body>
</html>
