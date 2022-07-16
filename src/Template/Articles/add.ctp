<!-- File: src/Template/Articles/add.ctp -->
<br>
<h1>Añadir Articulos</h1>
<br>

<?php
    echo $this->Form->create($article, array('id' => 'form1', 'class' => 'form-floating'));
    echo $this->Form->control('title', array('class' => 'form-control'));
?>

<br>

<?php
    echo $this->Form->control('body', array('class' => 'form-control'), ['rows' => '3']);
?>

<br>

<?php
    echo $this->Form->button(__('Guardar artículo'), array('class' => 'btn btn-primary'));
    echo $this->Form->end();
?>

<script type="text/javascript">
	$(document).ready(function () {

        $("#form1").validate({
            rules: {
                title : { required: true },
                body  : { required: true }
            },
            messages : {
                title : "Ingresa un campo valido",
                body : "Ingresa un campo valido",
            }
        });
        
	});
</script>