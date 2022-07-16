<!-- File: src/Template/Articles/edit.ctp -->

<h1>Edit Article</h1>
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
		//alert('JQuery is succesfully included');
        $("#form1").validate({
            rules: {
                'title':{
                    required: true,
                },
                'body':{
                    required: true,
                },
                messages:{
                    'title':{
                        required: "Plox papu",
                    },
                    'body': {
                        required: "Plox ingresa el campo",
                    },
                },
            },
        });
        
	});
</script>