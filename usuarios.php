<?php include('top.php');?>

<main class="ls-main "> 
<!-- Box container geral -->
      <div class="container-fluid">
        <h1 class="ls-title-intro ls-ico-users">Usuários</h1>

<!-- Botoes de acao e campo de consulta -->
<fieldset >
<label class="ls-label row ls-float-left col-md-6 col-sm-12">
<div class="ls-prefix-group">
     <!--<b class="ls-label-text">Busca avançada</b>-->
         <input type="search" class="dataTable ls-field" data-table="order-table" placeholder="Consulte por: Nome, E-mail, Instituição, Perfil" >
         <span class="ls-label-text-prefix ls-ico-search"></span>


</div>

</label>

<!--<fieldset class="ls-label  ls-float-left  col-sm-12">
    <!-- Escolha do filtro de busca 
    <div class="ls-label ls-form-inline">
      <label class="ls-label-text ls-form-inline">
        <input type="radio" name="filtro" value="cpf" class="ls-field-radio">
        CPF
      </label>
      <label class="ls-label-text ls-form-inline">
        <input type="radio" name="filtro" value="nome" class="ls-field-radio" >
       Nome
      </label>
    </div>
  </fieldset> -->

<fieldset class="ls-label row ls-float-right col-md-6 col-sm-12">
<div class="ls-group-btn ls-float-right">

  <button onClick="location.href='novo_usuario.php'" type="button" class="ls-btn-primary ion-plus" style="background-color: green; border-color: green;"> Novo usuário</button>
 <!-- <button type="button" class="ls-btn-primary ion-close" style="background-color: #CD0000; border-color: #CD0000;"> Excluir seleção</button> -->
</div>
</fieldset>


</fieldset> <!-- Fim botoes acao e campo de consulta -->

 <!-- Filtro de Busca -->
<fieldset>
  
<!--<div class="ls-box-filter">
 <!-- <form action="" class="ls-form ls-form-inline ls-float-left">
    <label class="ls-label col-md-8 col-sm-8">
      <b class="ls-label-text">Status</b>
      <div class="ls-custom-select">
        <select name="" class="ls-select">
          <option>Todos</option>
          <option>Ativos</option>
          <option>Desativados</option>
        </select>
      </div>
    </label>
  </form> -->

 <!-- <label class="ls-label ls-float-left col-md-3 col-sm-12">
      <b class="ls-label-text">Status</b>
      <div class="ls-custom-select">
        <select name="" class="ls-select light-table-filter" data-table="order-table">
          <option value="">Todos</option>
          <option value="ON">Ativos</option>
          <option value="OFF">Desativados</option>
        </select>
      </div>
    </label>

    <label class="ls-label ls-float-left col-md-3 col-sm-12">
      <b class="ls-label-text">Status</b>
      <div class="ls-custom-select">
        <select name="" class="ls-select light-table-filter" data-table="order-table">
          <option value="">Todos</option>
          <option value="ativo">Ativos</option>
          <option value="inativo">Desativados</option>
        </select>
      </div>
    </label> -->


   <!-- <label class="ls-label col-md-6 col-sm-12">
     <!--<b class="ls-label-text">Busca avançada</b>
         <input type="search" class="dataTable ls-field" data-table="order-table" placeholder="Nome, E-mail, Perfil, Status" >

            </label>
           

  <!-- <form  action="" class="ls-form ls-form-inline ls-float-right col-md-12">
    <label class="ls-label col-md-4" role="search">

      <input type="search" class="light-table-filter ls-field" data-table="order-table" placeholder="Filtro" >

    </label>
  </form> 
</div> -->

</fieldset> <!-- Fim Filtro de Busca -->

<!-- Tabela de dados -->
 <fieldset>
  
<table class="ls-table ls-table-striped ls-bg-header order-table">
  <thead>
    <tr>
      <th class="hidden-xs">CPF</th>
      <th class="hidden-xs">Nome</th>
      <th class=""><a href="#">E-mail</a></th>
      <th class="hidden-xs">Instituição</th>
      <th class="hidden-xs "><a href="#">Perfil</a></th>
     <!-- <th class="hidden-xs">Data do Cadastro</th> -->
      <th class="hidden-xs">Status</th>
      <th>Ações</th>
      </tr>
  </thead> 


  <tbody>
    
   <?php

      require_once ('config/conexao.php');
   
     // $query = "SELECT * FROM usuario ORDER BY nome";
      $query = "SELECT u.id, u.cpf ,u.nome as nomeUsuario, u.sobrenome, u.email, u.arquivo, i.tipo, i.nome, u.perfil, u.status, u.instituicao_id, u.dataCadastro FROM usuario u, instituicao i WHERE u.instituicao_id = i.id ORDER BY u.nome";
      $resultado = mysql_query($query);
   
      while ($dados = mysql_fetch_array($resultado)) { ?>

    <tr style="text-transform: none;">

    <td style="font-weight: bold;"><?php echo $dados['cpf']; ?></td>
     <td><?php echo $dados['nomeUsuario'].' '.$dados['sobrenome']; ?></td>
      <td class="hidden-xs"><?php echo $dados['email']; ?></td>
      <td class="ls-tooltip-top" aria-label="<?php echo $dados['tipo']; ?>"><?php echo $dados['nome']; ?></td>
      <td class="hidden-xs"><?php if($dados['perfil'] == 'adm') {echo "Administrador";} if($dados['perfil'] == 'adm_instituicao') {echo "Adm. da Instituição";} if($dados['perfil'] == 'consulta') {echo "Consulta";} ?></td>
      <!-- <td class="hidden-xs"><?php //echo $dados['dataCadastro']; ?></td> -->
       <td class="hidden-xs" ><?php if($dados['status'] == '1') {echo '<a href="#" class="ls-tag-success">Online</a>';} else { echo '<a href="#" class="ls-tag-danger">Offline</a>'; }?></td>
      <td>

    <div class="row">
    <!-- BOTAO EDITAR USUARIO -->
     <a href="#" class="ls-tooltip-top ls-btn" aria-label="Editar" data-ls-module="modal" data-target="#editar_usuario_<?php echo $dados['id'];?>"><span class="ls-ico-pencil"></span></a>

     <a href="#" class="ls-tooltip-top ls-btn" aria-label="Excluir" data-ls-module="modal" data-target="#excluir_usuario_<?php echo $dados['id'];?>"><span class="ls-ico-remove"></span></a>

     <a href="#" class="ls-tooltip-left ls-btn" aria-label="Trocar senha" data-ls-module="modal" data-target="#nova_senha_<?php echo $dados['id'];?>"><span class="ls-ico-spinner"></span></a>
     </div>
      </td>
     </tr> 
    
<!-- Modal edicao de usuario -->

<div class="ls-modal" id="editar_usuario_<?php echo $dados['id'];?>">
  <div class="ls-modal-box">
    <div class="ls-modal-header">
      <button data-dismiss="modal">&times;</button>
      <h4 class="ls-modal-title">Edição do Usuário(a), <?php echo $dados['nomeUsuario']; ?></h4>
    </div>
    <div class="ls-modal-body">
      <!-- Conteudo do modal -->
<form action="config/editUsuario.php" method="POST">
<!-- o conteudo do modal esta em outro arquivo que esta sendo requisitado abaixo -->
<?php include('editar_usuario.php');?>

      <!-- Fim conteudo do modal -->
    </div>
    <div class="ls-modal-footer">
      <button class="ls-btn ls-float-right" data-dismiss="modal">Cancelar</button>
      <button type="submit" onClick="location.href='config/editUsuario.php'" value="<?php echo $dados['id']?>" name="enviar" class="ls-btn-primary">Salvar alterações</button>
    </div>
    </form>
  </div>
</div>


<!-- Aqui ficam as janelas modal chamadas pelos botoes de acao -->

   <!-- Modal Redefinicao de Senha -->
<div class="ls-modal" id="nova_senha_<?php echo $dados['id'];?>">
  <div class="ls-modal-box">
    <div class="ls-modal-header">
      <button data-dismiss="modal">&times;</button>
      <h4 class="ls-modal-title">Redefinição de senha</h4>
    </div>
    <div class="ls-modal-body">
      <!-- Conteudo do modal -->

  <form action="" class="ls-form row">
  <fieldset>
    <label class="ls-label col-md-6 col-xs-12">
      <b class="ls-label-text">Nova Senha</b>
      <div class="ls-prefix-group">
        <input type="password" maxlength="10" id="password_field" name="password" value="" >
          <a class="ls-label-text-prefix ls-toggle-pass ls-ico-eye" data-toggle-class="ls-ico-eye, ls-ico-eye-blocked" data-target="#password_field" href="#">
          </a>
      </div>
    </label>
  </fieldset>
</form>

<!-- Fim conteudo do modal -->

    </div>
    <div class="ls-modal-footer">
      <button class="ls-btn ls-float-right" data-dismiss="modal">Cancelar</button>
      <button type="submit" class="ls-btn-primary ">Salvar</button>
    </div>
  </div>
</div> <!-- Fim modal Redefinicao de senha -->   

<!-- Modal excluir usuario -->

<div class="ls-modal" id="excluir_usuario_<?php echo $dados['id'];?>">
  <div class="ls-modal-box">
    <div class="ls-modal-header">
      <button data-dismiss="modal">&times;</button>
      <h4 class="ls-modal-title">Excluir usuário</h4>
    </div>
    <div class="ls-modal-body">
      <!-- Conteudo do modal -->

<label class="ls-label">

<form action="config/excluirUsuario.php" method="post">


 <p>Deseja realmente excluir o usuário(a)?</p> 

 <h3><?php echo $dados['nomeUsuario']." ".$dados['sobrenome'] ?></h3>

</label>

      <!-- Fim conteudo do modal -->
    </div>
    <div id="barra" class="ls-modal-footer">
    
      <button class="ls-btn ls-float-right" data-dismiss="modal"  value="Cancelar" formaction="usuarios.php">Cancelar</button>
      <input type="hidden" name="foto" value="<?php echo $dados['arquivo']?>">
      <button type="submit" class="ls-btn-primary" name="var" value="<?php echo $dados['id']?>" formaction="config/excluirUsuario.php">Excluir</button>
    
    </div>

    </form>

  </div>
</div>

<!-- Fim modal excluir usuario -->

<?php } ?>

<!-- Fim modal edicao de usuario -->
  </tbody>
</table>
</fieldset>  <!-- Fim tabela dados -->
</div> <!-- Fim box Container Fluid -->

<script src="js/dataTable.js"></script>

    </main>

<?php include('footer.php');?>