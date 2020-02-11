<?php require APPROOT . '/views/inc/header.php'; ?>

<a href="<?php echo URLROOT; ?>/posts " class="btn btn-light">
    <i class="fa fa-backward"></i>
    Back</a>
<div class="card card-body bg-linght mt-5">

    <h2 class='text-center'>Edit post</h2>
    <p>Create a post</p>
    <form action="<?php echo URLROOT; ?>/posts/edit/<?php echo $data['id']; ?>" method="POST">

        <div class="form-group">
            <label for="title">Title: <sup>*</sup></label>
            <input type="text" name="title" class="form-control form-control-lg <?php echo (!empty($data['title_err'])) ? 'is_invalid' : ''; ?>" value="<?php echo $data['title']; ?>">
            <span class="text-danger"><?php echo $data['title_err']; ?></span>
        </div>
        <div class="form-group">
            <label for="body">Body: <sup>*</sup></label>
            <textarea name="body" class="form-control form-control-lg <?php echo (!empty($data['body_err'])) ? 'is_invalid' : ''; ?>"><?php echo $data['body']; ?></textarea>
            <span class="text-danger"><?php echo $data['body_err']; ?></span>
        </div>
        <input type="submit" class="btn btn-success" value="Submit">


    </form>
</div>



<?php require APPROOT . '/views/inc/footer.php'; ?>