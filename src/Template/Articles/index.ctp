<br>

<h1 class="display-2" >Artículos</h1>

<hr>

<p><?= $this->Html->link("Añadir artículo", ['action' => 'add'], array('class' => 'btn btn-primary')) ?></p>

<br>

<table class = "table">
    <tr>
        <th class="text-primary">Id</th>
        <th class="text-primary">Title</th>
        <th class="text-primary">Created</th>
        <th class="text-primary">Opctions</th>
    </tr>

    <!-- Aquí es donde iteramos nuestro objeto de consulta $articles, mostrando en pantalla la información del artículo -->

    <?php

    use Cake\Form\Form;

 foreach ($articles as $article): ?>
    <tr>
        <td><?= $article->id ?></td>
        <td>
            <?= $this->Html->link($article->title, ['action' => 'view', $article->id]) ?>
        </td>
        <td>
            <?= $article->created->format(DATE_RFC850) ?>
        </td>
        <td>
            <?= $this->Form->postLink(
                'Eliminar',
                ['action' => 'delete', $article->id],
                ['confirm' => '¿Estás seguro de que lo deseas eliminar?'])
            ?> | 
            <?= $this->Html->link('Editar', ['action' => 'edit', $article->id]) ?>
        </td>
    </tr>
            
    <?php endforeach; ?>

    
</table>

<br><br>


<?php
    echo $this->Form->create($comment, array('id' => 'form2', 'data-bind'=>'submit: addComment', 'class' => 'form-floating'));
    echo $this->Form->control('nombre', array('class' => 'form-control', 'id'=>'nom', 'data-bind'=>'value: newNoumText'));
?>

<label data-bind="text: NomLabel" class="text-danger"></label>


<?php
    echo $this->Form->control('comentario', array('class' => 'form-control', 'id'=>'com','data-bind'=>'value: newCommentText'), ['rows' => '3']);
?>

<label data-bind="text: ComLabel" class="text-danger"></label>

<br>

<?php
    echo $this->Form->button(__('Guardar comentario'), array('class' => 'btn btn-primary'));
    echo $this->Form->end();
?>

<br><br>

<table class = "table">
    <thead>
        <tr>
            <th class="text-primary">Nombre</th>
            <th class="text-primary">Commentario</th>
        </tr>
    </thead>

    <tbody >

        <tr data-bind="foreach: comments">

        <?php foreach ($comm as $commt): ?>

            <td > <?= $commt->nombre ?></td>
            <td ><?= $commt->comentario ?></td>
        </tr>
        <?php endforeach; ?>
    </tbody>
    
</table>

<script>


    //Knockout JS 

function Comment(data){
    this.come = ko.observable(data);

    console.log(this.come().noum);
    
}

function CommentListViewModel(){

    //Data
    var self = this;
    self.comments = ko.observableArray([]);
    self.newNoumText = ko.observable();
    self.newCommentText = ko.observable();

    self.NomLabel = ko.observable();
    self.ComLabel = ko.observable();

    //Operations

    self.addComment = function(){
        
        if( this.newNoumText() != "" && typeof this.newNoumText() !== "undefined"){
            if(this.newCommentText() != "" && typeof this.newCommentText() !== "undefined"){

                self.comments.push(new Comment({noum: this.newNoumText(), Com: this.newCommentText()}));

                

                this.saveData();

                self.newNoumText("");
                self.newCommentText("");

                self.NomLabel("");
                self.ComLabel("");
            }else{
                self.ComLabel("Ingrese un comentario valido");
                self.NomLabel("");
            }

        }else{
            self.NomLabel("Ingrese un nombre correcto");
            self.ComLabel("");
        }
    };

    self.removeComment = function(task) { self.tasks.remove(task) };

    self.saveData = function() {
        $.ajax({
                    type: $('#form2').attr('method'), 
                    url: $('#form2').attr('action'),
                    data: $('#form2').serialize(),
                    //success: function (data) { alert('Datos enviados !!!'); } 
                });
                //ev.preventDefault();
                location.reload();
    }; 

}

ko.applyBindings(new CommentListViewModel());

</script>