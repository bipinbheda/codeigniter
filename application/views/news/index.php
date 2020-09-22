<?php 
if(!empty($news)) {
	// echo $message = $this->session->message;
	$message = $this->session->flashdata('message');
	$type = $this->session->flashdata('type');
	// $this->session->remove('message');
	echo bs4_alert($message,$type??'info');
?>
<div class="d-flex justify-content-between mb-4">
<h2>News Table</h2>
<a class="btn btn-dark" href="news/create">Create <i class="fa fa-plus-circle"></i></a>
</div>
  <table class="table table-striped display" id="example" style="width:100%">
    <thead>
    <tr>
        <th>Title</th>
        <th>Slug</th>
        <th>Description</th>
        <th>Status</th>
        <th>Edit</th>
        <th>Delete</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($news as $key => $value) { ?>
	<tr>
		<td><?= $value['title']; ?></td>
		<td><?= $value['slug']; ?></td>
		<td><?= $value['text']; ?></td>
		<td>
			<select size="1" id="row-<?= $value['id']; ?>-office" class="status" data-id="<?= $value['id']; ?>" name="row-<?= $value['id']; ?>-office">
				<?php foreach ($status as $statusVal) { ?>
					<option value="<?= $statusVal; ?>" data-selected="<?= $value['status']; ?>" <?= ($value['status'] == $statusVal) ? 'selected' : ''; ?>>
	                    <?= $statusVal; ?>
	                </option>
				<?php } ?>
            </select>
        </td>
		<td class="nosort"><a class="fa fa-edit" href="news/update/<?= $value['id']; ?>"></a></td>
		<td class="nosort"><a class="fa fa-trash" href="news/delete/<?= $value['id']; ?>" onclick="return confirm('are you sure?'); window.location.href='cancel'; " ></a></td>
	</tr>
    <?php } ?>
    </tbody>
  </table>
<?php } else { ?>
<h2>No Data found</h2>
<?php } ?>