<h2><?php echo $title; ?></h2>

<?php 
$test = array('Bipin','Bheda','Parth');
$random_element = random_element($test);

?>
<?php echo validation_errors(); ?>

<?php echo form_open( isset($news_id) ? 'news/update/'.$news_id : 'news/create' ); ?>

    <div class="form-group">
	    <label for="title">Title</label>
	    <input 
	    	type="text" 
	    	class="form-control" 
	    	placeholder="Enter title" 
	    	id="title" 
	    	name="title" 
	    	value="<?= $news['title'] ?? '' ; ?>" />
	</div>
	<div class="form-group">
	    <label for="text">Text</label>
    	<textarea 
    		name="text"
    		class="form-control"
    		placeholder="Enter Content"><?= $news['text'] ?? '' ; ?></textarea>
	</div>
    <input type="submit" name="submit" value="Create news item" class="btn btn-primary" />

</form>