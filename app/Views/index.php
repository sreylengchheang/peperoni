<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>
<?= $this->include('layouts/navbar') ?>

<div class="container mt-5">
		<div class="row">
			<div class="col-2"></div>
			<div class="col-8">
			<h5 class="text-center"></h5>
				<div class="text-right">

				<?php if(session()->get('role') == 1) :?>
					<a href="" class="btn btn-warning btn-sm text-white font-weight-bolder" data-toggle="modal" data-target="#createPizza">
						<i class="material-icons float-left" data-toggle="tooltip" title="Add Pizza!" data-placement="left">add</i>&nbsp;Add
					</a>
				<?php endif; ?>

				</div>
				<hr>
				<table class="table table-borderless table-hover">
					<tr>
						<th>Name</th>
						<th>Ingredients</th>
						<th>Price</th>

					<?php if(session()->get('role') == 1) :?>
						<th>Action</th>
					<?php endif; ?>

					</tr>
					
					
					<?php foreach($dataPizza as $values) :?>
					<tr>
						<td class="pizzaName"><?= $values['name']; ?></td>
						<td><?= $values['ingredients']; ?></td>
						<td class="text-success font-weight-bolder"><?= $values['prize']; ?> $</td>
						<td>

						<?php if(session()->get('role') == 1) :?>
							<a href="pizza/editPizza/<?= $values['id']; ?>" data-toggle="modal" data-target="#updatePizza"><i class="material-icons text-info" data-toggle="tooltip" title="Edit Pizza!" data-placement="left">edit</i></a>
							<a href="pizza/deletePizza/<?= $values['id']; ?>" data-toggle="tooltip" title="Delete Pizza!" data-placement="right"><i class="material-icons text-danger">delete</i></a>
						<?php endif; ?>

						</td>
					</tr>
					<?php endforeach; ?>
				
				</table>
			</div>
			<div class="col-2"></div>
		</div>
	</div>


<!-- ========================================START Model CREATE================================================ -->
	<!-- The Modal -->
	<div class="modal fade" id="createPizza">
    <div class="modal-dialog">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Create Pizza</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->

        <div class="modal-body text-right">
			<form  action="pizza/addPizza" method="post">
				<div class="form-group">
					<input type="text" name="name" class="form-control" placeholder="Pizza name">
				</div>
				<div class="form-group">
					<input type="number" name="prize" class="form-control" placeholder="Prize in dollars">
				</div>
				<div class="form-group">
					<textarea name="ingredients" placeholder="Ingredients" class="form-control"></textarea>
				</div>

			<a data-dismiss="modal" class="closeModal">DISCARD</a>
		 	 &nbsp;
		  <input type="submit" value="CREATE" class="createBtn text-warning">
        </div>
        </form>
      </div>
    </div>
  </div>
  <!-- =================================END MODEL CREATE==================================================== -->

  <!-- ========================================START Model UPDATE================================================ -->
	<!-- The Modal -->
	<div class="modal fade" id="updatePizza">
    <div class="modal-dialog">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Edit Pizza</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
		<div class="modal-body text-right">
			<form  action="" method="post">
				<div class="form-group">
					<input type="text" name="name" class="form-control">
				</div>
				<div class="form-group">
					<input type="number" name="prize" class="form-control" value="100">
				</div>
				<div class="form-group">
					<textarea name="ingredients" class="form-control"></textarea>
				</div>
				<input type="text" name="id" >
			<a data-dismiss="modal" class="closeModal"></a>
		 	 &nbsp;
		  <input type="submit" value="UPDATE" class="createBtn text-warning">
        </div>
        </form>
      </div>
    </div> 
  </div>
 
  <!-- =================================END MODEL UPDATE==================================================== -->


  <?= $this->endSection() ?>